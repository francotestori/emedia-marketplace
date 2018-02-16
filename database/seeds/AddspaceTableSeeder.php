<?php

use App\Profit;
use Illuminate\Database\Seeder;
use App\Addspace;
use App\Category;
use App\User;

class AddspaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','it@editor.com')->first();

        $price = 350.00;

        $profit = Profit::where([
            ['from_range', '<', $price],
            ['to_range', '>=', $price],
        ])->first();

        $addspace = Addspace::create([
            'url' =>'http://www.example.com',
            'description' => 'Example Addspace',
            'visits' => 1200,
            'cost' => $price,
            'profit' => $profit->value,
            'editor_id' => $user->id,
        ]);

        $category = Category::where('name','Example')->first();
        $category1 = Category::where('name','Sports')->first();

        $addspace->categories()->attach($category);
        $addspace->categories()->attach($category1);


    }
}
