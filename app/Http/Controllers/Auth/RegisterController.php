<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Welcome;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use App\Wallet;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $roles = Role::where('name','<>','Manager')->get();
        View::share('roles', $roles);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return back();
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $role = Role::find($data['role']);

        $activation_code = str_random(30);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activation_code' => $activation_code,
            'role_id' => $role->id
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0
        ]);

        $email = new Welcome($activation_code);

        Mail::to($user->email)->send($email);

        return $user;
    }

    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        User::where('activation_code',$token)->firstOrFail()->verified();
        return redirect('login');
    }
}
