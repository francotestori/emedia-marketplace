<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class WalletController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('wallet.index', compact('user'));
    }


    public function deposit()
    {
        //TODO paypal integration
    }

    public function withdraw()
    {
        //TODO mailer integration
    }

    # Addspace id
    # Charges current user for addspace transaction
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
