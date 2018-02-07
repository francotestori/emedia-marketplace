<?php

namespace App\Http\Controllers;

use App\CreditPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CreditPackageController extends Controller
{
    public function create()
    {
        return view('wallet.package.create');
    }

    public function store()
    {
        CreditPackage::create([
            'name' => Input::get('name'),
            'cost' => Input::get('cost'),
            'amount' => Input::get('amount')
        ]);
        return redirect()->route('packages');
    }

    public function edit($id)
    {
        $package = CreditPackage::find($id);
        return view('wallet.package.edit', compact('package'));
    }

    public function update($id)
    {
        $package = CreditPackage::find($id);
        $package->name = Input::get('name');
        $package->cost = Input::get('cost');
        $package->amount = Input::get('amount');
        $package->save();
        return redirect()->route('packages');
    }

    public function activate($id)
    {
        $package = CreditPackage::find($id);
        $package->active = true;
        $package->save();
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $package = CreditPackage::find($id);
        $package->active = false;
        $package->save();
        return redirect()->back();
    }
}
