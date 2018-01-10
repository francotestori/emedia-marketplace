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
            'key' => 'withdrawal',
            'min' => 50.00,
            'max' => 1000.00,
            'value' => 1
        ]);

        Configuration::create([
            'key' => 'fee_1',
            'min' => 0.01,
            'max' => 100.00,
            'value' => 0.20
        ]);

        Configuration::create([
            'key' => 'fee_2',
            'min' => 100.00,
            'max' => 200.00,
            'value' => 0.25
        ]);

        Configuration::create([
            'key' => 'fee_3',
            'min' => 200.00,
            'max' => 300.00,
            'value' => 0.30
        ]);

        Configuration::create([
            'key' => 'fee_4',
            'min' => 300.00,
            'max' => 400.00,
            'value' => 0.35
        ]);

        Configuration::create([
            'key' => 'fee_5',
            'min' => 400.00,
            'max' => 999999.00,
            'value' => 0.40
        ]);


    }
}
