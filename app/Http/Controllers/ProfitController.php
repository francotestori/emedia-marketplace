<?php

namespace App\Http\Controllers;

use App\Addspace;
use App\Profit;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ProfitController extends Controller
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
        $profits = Profit::all();

        $clusters = array_chunk(Addspace::all()->toArray(), 3);

        return view('profits.index', compact('profits', 'clusters'));
    }

    public function change($id)
    {
        $addspace = Addspace::find($id);
        $addspace->profit = Input::get('profit');
        $addspace->save();
        return redirect()->back();
    }

    public function applyDefault($id)
    {
        $addspace = Addspace::find($id);
        $addspace->profit = $this->getProfit($addspace->cost);
        $addspace->save();
        return redirect()->back();

    }

    private function getProfit($price)
    {
        $profit = Profit::where([
            ['from_range', '<', $price],
            ['to_range', '>=', $price]
        ])->first();

        return empty($profit) ? 0 : $profit->value;
    }

    function store()
    {
        $validation = Profit::where('to_range', '>=', Input::get('from') )->count();

        if(!$validation && (Input::get('from') < Input::get('to')))
        {
            Profit::create([
                'from_range' => Input::get('from'),
                'to_range' => Input::get('to'),
                'value' => Input::get('profit')
            ]);
            Session::flash('status', 'Profit added successfully');
        }
        else
            Session::flash('errors', 'Invalid profit');

        return redirect()->back();
    }

    function edit()
    {
        $profits = Profit::all();
        return view('profits.edit', compact('profits'));
    }

    function update()
    {
        $profits = Profit::all();

        foreach ($profits as $profit){
            $profit->from_range = Input::get('from-'.$profit->id, 0);
            $profit->to_range = Input::get('to-'.$profit->id, 0);
            $profit->value = Input::get('value-'.$profit->id, 0);
            $profit->save();
        }

        Session::flash('status', 'Default profits updated!');
        return redirect()->route('profits.index');
    }

}
