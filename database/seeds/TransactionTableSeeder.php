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
        $advertiser = User::where('name', 'advertiser')->first();
        $a_wallet = $advertiser->getWallet();

        $editor = User::where('name', 'editor')->first();
        $e_wallet = $editor->getWallet();

        Transaction::create([
            'wallet_id' => $a_wallet->id,
            'type' => 'DEPOSIT',
            'credits' => 100,
        ]);
        $a_wallet->balance = $a_wallet->balance + 100;
        $a_wallet->save();

        $event = Event::create([
            'addspace_id' => 1,
            'state' => 'PENDING'
        ]);

        Transaction::create([
            'wallet_id' => $a_wallet->id,
            'type' => 'PAYMENT',
            'credits' => 25,
            'event_id' => $event->id
        ]);
        $a_wallet->balance = $a_wallet->balance -25;
        $a_wallet->save();

        Transaction::create([
            'wallet_id' => $e_wallet->id,
            'type' => 'CHARGE',
            'credits' => 25,
            'event_id' => $event->id
        ]);
        $e_wallet->balance = $e_wallet->balance + 25;
        $e_wallet->save();

        Transaction::create([
            'wallet_id' => $e_wallet->id,
            'type' => 'WITHDRAWAL',
            'credits' => 25,
        ]);
        $e_wallet->balance = $e_wallet->balance -25;
        $e_wallet->save();
    }
}
