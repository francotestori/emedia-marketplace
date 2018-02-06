<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function config()
    {
        $config = Configuration::all();
        return view('manager.config', compact('config'));
    }

    public function profits()
    {
        $profits = Configuration::where('key', '<>', 'withdrawal')->get();
        return view('manager.profits', compact('profits'));

    }
}
