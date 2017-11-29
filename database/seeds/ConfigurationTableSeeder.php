<?php

use App\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'key' => 'transaction_fee',
            'value' => '0.05'
        ]);
        Configuration::create([
            'key' => 'dolar_to_credit',
            'value' => '1'
        ]);
    }
}
