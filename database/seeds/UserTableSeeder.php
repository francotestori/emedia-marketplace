<?php

use App\User;
use App\Role;
use App\Wallet;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_manager = Role::where('name', 'manager')->first();
        $role_advertiser = Role::where('name', 'advertiser')->first();

        // Create Users
        $manager = User::create([
            'name' => 'eMediaMarket Manager',
            'email' => 'pagos@emediamarket.com',
            'password' => bcrypt('eMM4321'),
            'role_id' => $role_manager->id,
            'country' => 'ARG'
        ]);
        $manager->activated = true;
        $manager->save();

        $advertiser = User::create([
            'name' => 'Advertiser',
            'email' => 'it@advertiser.com',
            'password' => bcrypt('secret'),
            'role_id' => $role_advertiser->id,
            'country' => 'ARG'
        ]);
        $advertiser->activated = true;
        $advertiser->save();

        // Create User wallets
        $users = User::all();
        foreach ($users as $user){
            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->balance = 0;
            $wallet->save();
        }

    }
}
