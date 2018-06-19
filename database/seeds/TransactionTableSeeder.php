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
        $manager = User::where('email', 'pagos@emediamarket.com')->first();
        $manager_wallet = $manager->getWallet();

        $advertiser = User::where('name', 'advertiser')->first();
        $advertiser_wallet = $advertiser->getWallet();

        $deposit = Transaction::create([
            'from_wallet' => $manager_wallet->id,
            'to_wallet' => $advertiser_wallet->id,
            'type' => 'DEPOSIT',
            'amount' => 2000,
        ]);

        $deposit->payment_status = 'Completed';
        $deposit->save();

        $advertiser_wallet->balance = $advertiser_wallet->balance + $deposit->amount;
        $advertiser_wallet->save();
    }
}
