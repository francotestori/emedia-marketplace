<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\CreditPackage;
use App\Event;
use App\EventThreads;
use App\Mail\Rollbacked;
use App\Mail\Withdrawal;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Srmklive\PayPal\Services\ExpressCheckout;

class WalletController extends Controller
{
    protected $provider;

    public function __construct()
    {
        View::share('withdraw_min', config('marketplace.withdrawal.min'));
        View::share('withdraw_max', config('marketplace.withdrawal.max'));

        $this->provider = new ExpressCheckout();
    }

    public function index()
    {
        $user = Auth::user();
        return view('wallet.show', compact('user'));
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
            // every invoice id must be unique, else you'll get an error from paypal
            'invoice_id' => config('paypal.invoice_prefix') . '_' . $id,
            'invoice_description' => "EMediaMarket Deposit #" . $id,
            // return url is the url where PayPal returns after user confirmed the payment
            'return_url' => route('deposit.accept', ['id' =>$id]),
            'cancel_url' => route('deposit.cancel', ['id' =>$id]),
            //Must declare Total
            'total' => $price,

        ];
    }

    public function showDeposit()
    {
        return view('transaction.deposit');
    }

    /**
     * Send a request to Paypal's service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function prepareDeposit()
    {
        $amount = Input::get('amount');

        $system = User::find(1)->getWallet();
        $editor = Auth::user()->getWallet();

        $transaction = Transaction::create([
            'from_wallet' => $system->id,
            'to_wallet' => $editor->id,
            'type' => 'DEPOSIT',
            'amount' => $amount,
            'event_id' => null
        ]);

        $item = $this->buildDepositRequest($amount, $transaction->id);

        $transaction->invoice_id = $item['invoice_id'];
        $transaction->invoice_description = $item['invoice_description'];
        $transaction->save();

        $response = $this->provider->setExpressCheckout($item, false);

        // if there is no link redirect back with error message
        $link = $response['paypal_link'];
        if (!$link)
        {
            return redirect('deposit-cancel/'.$transaction->id)
                   ->with(['code' => 'danger',
                           'message' => $response['L_LONGMESSAGE0']]);
        }

        return redirect($link);
    }

    public function cancelDeposit($id, Request $request)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        Session::flash('errors', Lang::get('messages.failed_deposit'));
        return redirect('users');
    }

    public function acceptDeposit($id, Request $request)
    {
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        // Get checkout data from token
        $response = $this->provider->getExpressCheckoutDetails($token);

        // Return back with error if response ACK is not SUCCESS or SUCCESSWITHWARNING
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect('deposit-cancel/'.$id)->with(['code' => 'danger', 'message' => 'Error processing PayPal payment']);
        }

        $transaction = Transaction::find($id);

        $item = $this->buildDepositRequest($transaction->amount, $transaction->id);

        //Execute payment
        $payment_status = $this->provider->doExpressCheckoutPayment($item, $token, $PayerID);
        $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

        // Update Transaction's payment status
        $transaction->payment_status = $status;
        $transaction->save();

        // Return success or error according to Paypal's response
        if ($transaction->completed()) {
            // Update Wallet Balance
            $wallet = $transaction->getReceiver();
            $wallet->balance = $wallet->balance + $transaction->amount;
            $wallet->save();

            Session::flash('message',Lang::get('messages.paypal_success', ['transaction_id' => $transaction->id]));
            return redirect('users');
        }

        $transaction->delete();
        Session::flash('message',Lang::get('messages.paypal_failed', ['transaction_id' => $transaction->id]));
        return redirect('users');

    }

    /**
     * Sends Mail request to Marketplace owner so as to send the money back to the Editor requesting the withdrawal
     */
    public function withdraw()
    {
        $admin = env('MAIL_MANAGER_ACCOUNT');

        $sender = Auth::user();

        // Get account withdrawal data
        $cbu = Input::get('cbu');
        $alias = Input::get('alias');
        $paypal = Input::get('paypal');
        $amount = Input::get('amount');
        $comment = Input::get('comment');

        // Create associated Event
        $system = User::find(1)->getWallet();

        $event = Event::create([
            'addspace_id' => null,
            'state' => 'PENDING'
        ]);

        $transaction = Transaction::create([
            'from_wallet' => $sender->getWallet()->id,
            'to_wallet' => $system->id,
            'type' => 'WITHDRAWAL',
            'amount' => $amount,
            'event_id' => $event->id
        ]);

        $url = route('withdrawal.show', ['transaction_id' => $transaction->id]);

        // Create email
        $email = new Withdrawal($amount, $paypal, $cbu, $alias, $sender->email, $comment, $url);

        Mail::to($admin)->send($email);

        return back();
    }

    public function withdrawals()
    {
        $withdrawals = Transaction::where('type', 'WITHDRAWAL')->get();
        return view('events.withdrawals_index', compact('withdrawals'));
    }

    public function wallet()
    {
        $user = Auth::user();
        return view('wallet.show', compact('user'));
    }

    public function showWithdrawal($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        $event = $transaction->getEvent();

        if($transaction->type != 'WITHDRAWAL'){
            Session::flash('errors', Lang::get('messages.not_withdrawal'));
            return redirect('home');
        }
        elseif (!$event->pending())
        {
            Session::flash('errors', Lang::get('messages.event_is_not_pending'));
            return redirect('home');
        }
        else
            return view('events.show',compact('transaction','event'));
    }

    public function authorizeWithdrawal($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        $event = $transaction->getEvent();

        if(!$event->pending())
        {
            Session::flash('errors', Lang::get('messages.event_is_not_pending'));
            return redirect('home');
        }

        $state = Input::get('state');
        $event->state = $state;
        $event->save();

        if($event->accepted())
        {
            $editor = $transaction->getSender();
            $editor->balance = $editor->balance - $transaction->amount;
            $editor->save();
        }

        return $this->showWithdrawal($transaction_id);
    }

    /**
     * Charge advertiser user the amount of credits corresponding to and addspace Transaction
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function charge()
    {
        try
        {
            $addspace = Addspace::findOrFail(Input::get('reference'));
        }
        catch (ModelNotFoundException $e)
        {
            Session::flash('errors', 'No addspaces referenced');
            return redirect('addspaces');
        }

        if(!$addspace->isActive())
        {
            Session::flash('errors', Lang::get('messages.inactive'));
            return redirect()->route('addspaces.show', $addspace->id);
        }

        $source = Auth::user()->getWallet();
        $cost = $addspace->getCost();

        if($source->balance < $cost)
        {
            Session::flash('errors', Lang::get('messages.without_funds'));
            return redirect()->route('addspaces.show', $addspace->id);
        }

        // Get Wallets
        $system_wallet = User::find(1)->getWallet();
        $destination = $addspace->getEditor()->getWallet();

        // Get Costs
        $editor_cut = $addspace->cost;
        $fee = $cost - $editor_cut;

        $event = Event::create([
            'addspace_id' => $addspace->id,
            'state' => 'PENDING'
        ]);

        // Editor Addspace cost
        Transaction::create([
            'from_wallet' => $source->id,
            'to_wallet' => $destination->id,
            'type' => 'PAYMENT',
            'amount' => $editor_cut,
            'event_id' => $event->id
        ]);

        // System Fee
        Transaction::create([
            'from_wallet' => $source->id,
            'to_wallet' => $system_wallet->id,
            'type' => 'PAYMENT',
            'amount' => $fee,
            'event_id' => $event->id
        ]);

        $source->balance = $source->balance - $cost;
        $source->save();

        $thread = Thread::create([
            'subject' => Input::get('subject'),
        ]);

        EventThreads::create([
            'event_id' => $event->id,
            'thread_id' => $thread->id
        ]);

        // Advertiser is first participant
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Add Editor to messaging thread
        if (Input::has('recipient'))
            $thread->addParticipant(Input::get('recipient'));

        Session::flash('message', Lang::get('messages.transaction'));
        return redirect()->route('messages');
    }

    public function acceptPayment($id)
    {
        $event = Event::find($id);

        if($event->rejected() || $event->accepted())
            return redirect()->route('addspaces.index');
        else
        {
            $score = Input::get('score');
            $event->state = 'ACCEPTED';
            $event->score = $score;
            $event->save();

            $transactions = Transaction::where('event_id', $event->id)->get();

            foreach($transactions as $transaction){
                $recipient = $transaction->getReceiver();
                $recipient->balance = $recipient->balance + $transaction->amount;
                $recipient->save();
            }

            Session::flash('message', Lang::get('messages.attributed'));
            return redirect()->route('addspaces.search');
        }
    }

    public function rejectPaymentByUser($id)
    {
        $reason = Input::get('reason');

        $event = Event::find($id);

        if($event->rejected() || $event->accepted() || $event->rejectedByUser())
            return redirect()->route('addspaces.search');
        else
        {
            $event->state = 'USER_REJECTED';
            $event->score = 1;
            $event->save();

            $transactions = Transaction::where('event_id', $event->id)->get();

            $email = new Rollbacked($reason, $transactions);

            foreach($transactions as $transaction){
                $to = $transaction->getReceiver()->getUser()->email;
                Mail::to($to)->send($email);
            }

            Session::flash('message', Lang::get('messages.rollbacked'));
            return redirect()->route('addspaces.search');
        }
    }

    public function rejectPayment($id)
    {
        $reason = Input::get('reason');

        $event = Event::find($id);

        if($event->rejected() || $event->accepted())
            return redirect()->route('addspaces.search');
        else
        {
            $event->state = 'REJECTED';
            $event->score = 1;
            $event->save();

            $transactions = Transaction::where('event_id', $event->id)->get();

            $email = new Rollbacked($reason, $transactions);

            foreach($transactions as $transaction){
                $sender = $transaction->getSender();
                $sender->balance = $sender->balance + $transaction->amount;
                $sender->save();

                $to = $transaction->getReceiver()->getUser()->email;
                Mail::to($to)->send($email);
            }

            Session::flash('message', Lang::get('messages.rollbacked'));
            return redirect()->route('addspaces.search');
        }
    }

    public function revenues()
    {
        $user = Auth::user();
        return view('wallet.revenues', compact('user'));
    }

    public function transactions()
    {
        $user = Auth::user();
        return view('transaction.index', compact('user'));
    }

    public function sales()
    {
        $user = Auth::user();
        return view('wallet.sales', compact('user'));
    }

    public function packages()
    {
        $user = Auth::user();
        $packages = $user->isManager() ? CreditPackage::all() : CreditPackage::where('active', true)->get();
        $clusters = array_chunk($packages->toArray(), 3);
        return view('wallet.packages', compact('user', 'clusters'));
    }

    public function payments()
    {
        $user = Auth::user();
        return view('wallet.payments', compact('user'));
    }
}
