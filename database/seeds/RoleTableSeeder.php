<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Editor',
            'description' => 'Manage own addspaces'
        ]);

        Role::create([
            'name' => 'Advertiser',
            'description' => 'Buys addspace for it\'s media'
        ]);

        Role::create([
            'name' => 'Manager',
            'description' => 'Superuser'
        ]);
    }
}
