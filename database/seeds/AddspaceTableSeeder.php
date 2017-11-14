<?php

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

        $addspace = new Addspace();
        $addspace->url = 'http://www.example.com';
        $addspace->description = 'Example Addspace';
        $addspace->visits = 1200;
        $addspace->cost = 350.00;
        $addspace->editor_id = $user->id;
        $addspace->save();

        $category = Category::where('name','Example')->first();
        $category1 = Category::where('name','Sports')->first();
        $addspace->categories()->attach($category);
        $addspace->categories()->attach($category1);


    }
}
