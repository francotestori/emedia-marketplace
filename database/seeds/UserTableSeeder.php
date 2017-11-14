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
        $role_editor = Role::where('name', 'editor')->first();
        $role_advertiser = Role::where('name', 'advertiser')->first();

        // Create Users
        $manager = new User();
        $manager->name = 'Manager';
        $manager->email = 'it@manager.com';
        $manager->password = bcrypt('secret');
        $manager->role_id = $role_manager->id;
        $manager->save();

        $editor = new User();
        $editor->name = 'Editor';
        $editor->email = 'it@editor.com';
        $editor->password = bcrypt('secret');
        $editor->role_id = $role_editor->id;
        $editor->save();

        $advertiser = new User();
        $advertiser->name = 'Advertiser';
        $advertiser->email = 'it@advertiser.com';
        $advertiser->password = bcrypt('secret');
        $advertiser->role_id = $role_advertiser->id;
        $advertiser->save();

        $advertiser2 = new User();
        $advertiser2->name = 'Advertiser 2';
        $advertiser2->email = 'it@advertiser2.com';
        $advertiser2->password = bcrypt('secret');
        $advertiser2->role_id = $role_advertiser->id;
        $advertiser2->save();

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
