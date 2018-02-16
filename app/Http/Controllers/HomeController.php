<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\Profit;
use App\User;
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

    public function profits()
    {
        $profits = Profit::all();

        $clusters = array_chunk(Addspace::all()->toArray(), 3);

        return view('profits.index', compact('profits', 'clusters'));

    }
}
