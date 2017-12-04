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
            'key' => 'credit_ratio',
            'value' => '1'
        ]);

        Configuration::create([
            'key' => 'max_withdrawal',
            'value' => '1000'
        ]);

        Configuration::create([
            'key' => 'min_withdrawal',
            'value' => '50'
        ]);

    }
}
