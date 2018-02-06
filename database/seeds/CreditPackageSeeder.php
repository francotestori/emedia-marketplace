<?php

use App\CreditPackage;
use Illuminate\Database\Seeder;

class CreditPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreditPackage::create([
            'name' => '',
            'amount' => 50.00,
            'cost' => 50.00
        ]);

        CreditPackage::create([
            'name' => '',
            'amount' => 100.00,
            'cost' => 100.00
        ]);

        CreditPackage::create([
            'name' => '',
            'amount' => 200.00,
            'cost' => 200.00
        ]);
        CreditPackage::create([
            'name' => '',
            'amount' => 300.00,
            'cost' => 300.00
        ]);
        CreditPackage::create([
            'name' => '',
            'amount' => 500.00,
            'cost' => 500.00
        ]);
        CreditPackage::create([
            'name' => '',
            'amount' => 750.00,
            'cost' => 750.00
        ]);
        CreditPackage::create([
            'name' => '',
            'amount' => 1000.00,
            'cost' => 1000.00
        ]);
    }
}
