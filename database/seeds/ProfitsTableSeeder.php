<?php

use App\Profit;
use Illuminate\Database\Seeder;

class ProfitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profit::create([
            'from_range' => 0,
            'to_range' => 100,
            'value' => 5,
        ]);

        Profit::create([
            'from_range' => 101,
            'to_range' => 200,
            'value' => 20,
        ]);

        Profit::create([
            'from_range' => 201,
            'to_range' => 500,
            'value' => 25,
        ]);

    }
}
