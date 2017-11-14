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
        $category = new Category();
        $category->name = 'Sports';
        $category->save();

        $category1 = new Category();
        $category1->name = 'Camping';
        $category1->save();

        $category2 = new Category();
        $category2->name = 'Entertainment';
        $category2->save();

        $category3 = new Category();
        $category3->name = 'Example';
        $category3->save();

    }
}
