<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share('advertisers', User::where('role_id', 2)->get());
        View::share('editors', User::where('role_id', 1)->get());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
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
