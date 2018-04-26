<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\SendPassword;
use App\Role;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        //Sharing withdrawal limits
        View::share('withdraw_min', config('marketplace.withdrawal.min'));
        View::share('withdraw_max', config('marketplace.withdrawal.max'));

        //Sharing roles and users by role.
        View::share('users', User::all());
        View::share('managers', User::where('role_id', 3)->get());
        View::share('advertisers', User::where('role_id', 2)->get());
        View::share('editors', User::where('role_id', 1)->get());
        View::share('roles', Role::all());

        //Sharing countries
        View::share('countries', config('countries.enabled'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if(!$user->isManager())
            return redirect()->route('users.show',[$user->id]);

        $type = request('type');
        return view('user.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requested_role = request('role', 1);
        $user = Auth::user();

        if($user->isManager())
            return view('user.create', compact('requested_role'));

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
            return redirect()->route('users.create')
                             ->withErrors($validator)
                             ->withInput(Input::all());
        else
        {
            $role = Role::find(Input::get('role'));

            $user = User::create([
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'password' => bcrypt(Input::get('password')),
                'role_id' => $role->id,
                'country' => Input::get('country', 'ARG')
            ]);

            Wallet::create([
                'user_id' => $user->id,
                'balance' => 0
            ]);

            //Redirecting to index
            Session::flash('status', Lang::get('messages.created', ['item' =>'User']));
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

        $user = User::find($id);
        $transactions= $user->isAdvertiser() ? $this->getAdvertiserTransactions($user) : [];

        if(Auth::user()->isManager())
            return view('user.show', compact('user', 'transactions'));
        elseif (Auth::user()->id == $id)
            return view('user.show', compact('user', 'transactions'));
        else
            return redirect()->route('users.show',[Auth::user()->id]);
    }

    private function getAdvertiserTransactions($user)
    {

        $system_transaction = $user->getWallet()->getTransactions()
            ->filter(function($transaction){
                return $transaction->getEvent() == null && $transaction->payment_status != null;
            })
            ->map(function($transaction) use ($user){
                return [
                    'type' => $transaction['from_wallet'] == $user->getWallet()->id ? 'DEBIT'  : 'CREDIT',
                    'action' => $transaction->type,
                    'date' => Carbon::parse($transaction->created_at),
                    'state' => 'SYSTEM',
                    'url' => '',
                    'amount' => $transaction->amount,
                ];
            });

        $event_transaction = collect($user->getWallet()->getTransactions())
            ->filter(function($transaction){
                return $transaction->getEvent() != null && !$transaction->getEvent()->rejected();
            })
            ->groupBy('event_id')
            ->map(function ($group) use ($user){
                $data = $group[0];
                $event_id = $data['event_id'];
                $event = Event::find($event_id);
                $amount = collect($group)->reduce(function($sum, $transaction){return $sum + $transaction['amount'];});
                return [
                    'type' => $data['from_wallet'] == $user->getWallet()->id ? 'DEBIT'  : 'CREDIT',
                    'action' => $data->type,
                    'date' => Carbon::parse($data->created_at),
                    'state' => $event->state,
                    'url' => $event->getAddspace() == null ? '' : $event->getAddspace()->url,
                    'amount' => $amount,
                ];
            });

        return collect($system_transaction)->merge(collect($event_transaction));
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

        Session::flash('status', Lang::get('messages.forbidden'));
        return redirect()->route('users.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return redirect()->route('users.edit', [$id])
                ->withErrors($validator)
                ->withInput(Input::all());
        else
        {
            $user = User::find($id);

            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->country = Input::get('country');
            $user->save();

            // redirect
            Session::flash('status', Lang::get('messages.updated', ['item' =>'User']));
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

    public function showPasswordForm($id)
    {
        $user = User::find($id);

        if(Auth::user()->isManager() || Auth::id() == $id)
            return view('user.password', compact('user'));

        Session::flash('status', Lang::get('messages.forbidden'));
        return redirect()->back();
    }

    public function changePassword($id)
    {
        $user = User::find($id);

        if($user == null)
        {
            Session::flash('errors', 'User not found for '.$id);
            return redirect()->route('users.index');
        }

        if(!Hash::check(Input::get('old'), $user->password))
        {
            Session::flash('error_status', 'Unauthorized: Wrong password. Please try again.');
            return redirect()->route('users.password', [$id]);
        }

        if(strcmp(Input::get('old'), Input::get('password')) == 0)
        {
            Session::flash('error_status', 'New password cannot be same as current');
            return redirect()->route('users.password', [$id]);
        }

        $rules = array(
            'old' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        );

        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails())
            return redirect()->route('users.password', [$id])
                ->withErrors($validator)
                ->withInput(Input::all());

        $user->password = bcrypt(Input::get('password'));
        $user->save();

        Session::flash('status', 'Password changed successfully !');
        return redirect()->route('users.show',[$id]);
    }

    public function activate($user_id)
    {
        $user = User::find($user_id);
        if(!$user->activated){
            $user->activated=true;
            $user->save();

            Session::flash('status', 'User was activated !');
        }

        return redirect()->back();
    }

    public function deactivate($user_id)
    {
        $user = User::find($user_id);
        if($user->activated){
            $user->activated=false;
            $user->save();

            Session::flash('status', 'User was deactivated !');
        }

        return redirect()->back();
    }

    public function sendPassword($user_id)
    {
        $user = User::find($user_id);
        $random_pass = str_random(12);

        $user->password = bcrypt($random_pass);
        $user->activated=true;
        $user->save();

        $email = new SendPassword($random_pass);

        Mail::to($user->email)->send($email);

        Session::flash('status', 'Password was sent !');

        return redirect()->back();
    }
}
