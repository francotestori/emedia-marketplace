<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::create([
            'name' => 'Sports'
        ]);

        Category::create([
            'name' => 'Camping'
        ]);

        Category::create([
            'name' => 'Entertainment'
        ]);

        Category::create([
            'name' => 'Example'
        ]);
    }
}
