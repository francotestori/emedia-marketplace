<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Role;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        $withdrawal_config = Configuration::where('key', 'withdrawal')->first();
        View::share('min', $withdrawal_config->min);
        View::share('max', $withdrawal_config->max);

        View::share('users', User::all());
        View::share('advertisers', User::where('role_id', 2)->get());
        View::share('editors', User::where('role_id', 1)->get());
        View::share('roles', Role::all());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->isManager()){
            $type = request('type');
            return view('user.index', compact('type'));
        }
        else
            return redirect()->route('users.show',[$user->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->isManager())
            return view('user.create');

        return redirect()->route('users.show',[$user->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return redirect()->route('users.create')
                             ->withErrors($validator)
                             ->withInput(Input::all());
        }
        else
        {
            $role = Role::find(Input::get('role'));

            $user = User::create([
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'password' => bcrypt(Input::get('password')),
                'role_id' => $role->id
            ]);

            Wallet::create([
                'user_id' => $user->id,
                'balance' => 0
            ]);

            // redirect
            Session::flash('message', Lang::get('messages.created', ['item' =>'User']));
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if("create" == $id)
            return $this->create();

        $user = Auth::user();

        if($user->isManager())
            return view('user.show')->with('user', User::find($id));
        elseif ($user->id == $id)
            return view('user.show')->with('user', $user);
        else
            return redirect()->route('users.show',[$user->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if(Auth::user()->isManager() || Auth::id() == $id)
            return view('user.edit', compact('user'));

        Session::flash('message', Lang::get('messages.forbidden'));
        return redirect()->route('users.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return redirect()->route('users.edit', [$id])
                             ->withErrors($validator)
                             ->withInput(Input::all());
        }
        else
        {
            $user = User::find($id);

            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = bcrypt(Input::get('password'));
            $user->save();

            // redirect
            Session::flash('message', Lang::get('messages.updated', ['item' =>'User']));
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
