<?php

use App\Addspace;
use App\Event;
use App\Transaction;
use App\User;
use App\Wallet;
use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = User::where('name', 'manager')->first();
        $m_wallet = $manager->getWallet();

        $advertiser = User::where('name', 'advertiser')->first();
        $a_wallet = $advertiser->getWallet();

        $editor = User::where('name', 'editor')->first();
        $e_wallet = $editor->getWallet();

        $deposit = Transaction::create([
            'from_wallet' => $m_wallet->id,
            'to_wallet' => $a_wallet->id,
            'type' => 'DEPOSIT',
            'amount' => 100,
        ]);
        $deposit->payment_status = 'Completed';
        $deposit->save();
        $a_wallet->balance = $a_wallet->balance + $deposit->amount;
        $a_wallet->save();


        $addspace = Addspace::find(1);

        $event = Event::create([
            'addspace_id' => $addspace->id,
            'state' => 'PENDING'
        ]);


        Transaction::create([
            'from_wallet' => $a_wallet->id,
            'to_wallet' => $e_wallet->id,
            'type' => 'PAYMENT',
            'amount' => $addspace->cost,
            'event_id' => $event->id
        ]);

        $a_wallet->balance = $a_wallet->balance - $addspace->cost;
        $a_wallet->save();
    }
}
