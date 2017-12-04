<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Event;
use App\Mail\Withdrawal;
use App\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Srmklive\PayPal\Services\ExpressCheckout;

class WalletController extends Controller
{
    protected $provider;

    public function __construct() {
        $this->provider = new ExpressCheckout();
    }

    public function index()
    {
        $user = Auth::user();
        return view('wallet.index', compact('user'));
    }

    public function showDepositForm()
    {
        return view('transaction.deposit');
    }


    /**
     * Build the deposit Paypal request
     * @param $price
     * @param $id
     * @return array
     */
    private function buildDepositRequest($price, $id)
    {
        return [
            'items' => [
                [
                'name' => 'Marketplace Deposit',
                'price' => $price,
                'qty' => 1
                ],
            ],
            // return url is the url where PayPal returns after user confirmed the payment
            'return_url' => url('/deposit-success'),
            // every invoice id must be unique, else you'll get an error from paypal
            'invoice_id' => config('paypal.invoice_prefix') . '_' . $id,
            'invoice_description' => "EMediaMarket Deposit #" . $id,
            'cancel_url' => url('users'),
            'total' => $price,

        ];
    }

    private function applyFee($price)
    {
        $fee = Configuration::where('key', 'transaction_fee')->first()->value;
        $ratio = Configuration::where('key', 'credit_ratio')->first()->value;

        $credits = ($price * $ratio) * (1 - $fee);
        return $credits;
    }


    /**
     * Send a request to Paypal's service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deposit()
    {
        $price = Input::get('price');

        $wallet = Auth::user()->getWallet();

        $transaction = Transaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'DEPOSIT',
            'credits' => $this->applyFee($price),
        ]);

        $item = $this->buildDepositRequest($price, $transaction->id);

        $transaction->invoice_id = $item['invoice_id'];
        $transaction->invoice_description = $item['invoice_description'];
        $transaction->price = $price;
        $transaction->save();

        $response = $this->provider->setExpressCheckout($item, false);

        // if there is no link redirect back with error message
        if (!$response['paypal_link']) {
            return redirect('users')->with(['code' => 'danger', 'message' => $response['L_LONGMESSAGE0']]);
        }

        return redirect($response['paypal_link']);
    }

    /**
     * Paypal's payment acknowledge response
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function depositSuccess(Request $request)
    {
        $token = $request->get('token');

        $PayerID = $request->get('PayerID');

        // Get checkout data from token
        $response = $this->provider->getExpressCheckoutDetails($token);

        // Return back with error if response ACK is not SUCCESS or SUCCESSWITHWARNING
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect('/users')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment']);
        }

        // invoice id is stored in INVNUM
        // because we set our invoice to be xxxx_id
        // we need to explode the string and get the second element of array
        // witch will be the id of the invoice
        $invoice_id = explode('_', $response['INVNUM'])[1];

        $transaction = Transaction::where('invoice_id', $response['INVNUM'])->first();

        $item = $this->buildDepositRequest($transaction->price, $invoice_id);

        //Execute payment
        $payment_status = $this->provider->doExpressCheckoutPayment($item, $token, $PayerID);
        $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

        // Update Transaction's payment status
        $transaction->payment_status = $status;
        $transaction->save();

        // Return success or error according to Paypal's response
        if ($transaction->completed()) {
            // Update Wallet Balance
            $wallet = $transaction->getWallet();
            $wallet->balance = $wallet->balance + $transaction->credits;
            $wallet->save();

            Session::flash('message', 'Order ' . $transaction->id . ' has been paid successfully!');
            return redirect('users');
        }

        $transaction->delete();
        Session::flash('error_message', 'Error processing PayPal payment for Order ' . $transaction->id . '!');
        return redirect('users');

    }

    //TODO chequear si es necesario (pagos recurrentes php)
    public function notifyIPN(Request $request)
    {

        // add _notify-validate cmd to request,
        // we need that to validate with PayPal that it was realy
        // PayPal who sent the request
        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();

        // send the data to PayPal for validation
        $response = (string) $this->provider->verifyIPN($post);

        //if PayPal responds with VERIFIED we are good to go
        if ($response === 'VERIFIED') {

            // I leave this code here so you can log IPN data if you want
            // PayPal provides a lot of IPN data that you should save in real world scenarios

            $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
            Storage::disk('local')->put($logFile, print_r($post, true));


        }
    }


    /**
     * Sends Mail request to Marketplace owner so as to send the money back to the Editor requesting the withdrawal
     */
    public function withdraw()
    {
        $admin = env('MAIL_MANAGER_ACCOUNT');

        $sender = Auth::user()->email;

        $paypal = Input::get('paypal');
        $cbu = Input::get('cbu');
        $alias = Input::get('alias');
        $comment = Input::get('comment');
        $amount = Input::get('amount');

        $email = new Withdrawal($amount, $paypal, $cbu, $alias, $sender, $comment);

        Mail::to($admin)->send($email);

        return back();
    }

    /**
     * Charge advertiser user the amount of credits corresponding to and addspace Transaction
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function charge($id)
    {
        try{
            $event = Event::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'No addspaces referenced');
            return redirect('addspaces');
        }
        $addspace = $event->getAddspace();

        $cost = $addspace->getAddspace()->cost;

        $source = Auth::user()->getWallet();
        $destination = $addspace->getEditor()->getWallet();

        if($source->balance < $cost){
            Session::flash('error_message', Lang::get('messages.no_funds'));
            return redirect()->route('addspaces.show', $id);
        }

        Transaction::create([
            'wallet_id' => $source->id,
            'type' => 'PAYMENT',
            'credits' => $cost,
            'event_id' => $id
        ]);
        $source->balance = $source->balance - $cost;
        $source->save();

        Transaction::create([
            'wallet_id' => $destination->id,
            'type' => 'CHARGE',
            'credits' => $cost,
            'event_id' => $id
        ]);
        $destination->balance = $destination->balance + $cost;
        $destination->save();

        Session::flash('message', Lang::get('messages.transaction'));
        redirect()->route('addspaces.show', $id);

    }
}
