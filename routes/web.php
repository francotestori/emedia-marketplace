<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

# Index route
Route::get('/', function () {
    if(Auth::user() != null)
        return redirect('/home');
    return view('emediamarket');
});

# Logout route
Route::get('/logout', function(){
   Auth::logout();

   return redirect('/');
});

# Auth routes for all users
Auth::routes();

# Token Verification route
Route::get('/register/verify/{token}','Auth\RegisterController@verify');

#TODO update login model
# Advertiser login routes
Route::get('login-advertiser', ['as' => 'login.advertiser', 'uses' => 'Auth\LoginController@loginAdvertiser']);
Route::get('register-advertiser', ['as' => 'register.advertiser', 'uses' => 'Auth\RegisterController@registerAdvertiser']);
Route::get('reset-advertiser', ['as' => 'password.reset-advertiser', 'uses' => 'Auth\ResetPasswordController@resetAdvertiser']);

# Editor login routes
Route::get('login-editor', ['as' => 'login.editor', 'uses' => 'Auth\LoginController@loginEditor']);
Route::get('register-editor', ['as' => 'register.editor', 'uses' => 'Auth\RegisterController@registerEditor']);
Route::get('reset-editor', ['as' => 'password.reset-editor', 'uses' => 'Auth\ResetPasswordController@resetEditor']);

# Auth enabled routes
Route::group(['middleware' => ['auth']], function(){

    # Home
    Route::get('/home', 'HomeController@index')->name('home');

    # Users routes
    Route::group(['prefix' => 'users'], function (){
        Route::get('/',['as' => 'users.index', 'uses' => 'UserController@index']);
        Route::get('{id}',['as' => 'users.show', 'uses' => 'UserController@show']);
        Route::get('{id}/edit',['as' => 'users.edit', 'uses' => 'UserController@edit']);
        Route::post('{id}',['as' => 'users.update', 'uses' => 'UserController@update']);
    });

    # Messaging routes
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });

    # Addspaces access for everyone
    Route::resource('addspaces', 'AddspaceController', ['only' => ['index', 'show']]);

    # Manager specific routes
    Route::group(['middleware' => ['manager']], function(){

        # Addspaces routes
        Route::resource('addspaces', 'AddspaceController', ['except' => ['index', 'create' ,'show', 'delete']]);
        Route::get('addspaces/{id}/activate', ['as' => 'addspaces.activate', 'uses' => 'AddspaceController@activate']);
        Route::get('addspaces/{id}/pause', ['as' => 'addspaces.pause', 'uses' => 'AddspaceController@pause']);
        Route::get('addspaces/{id}/close', ['as' => 'addspaces.close', 'uses' => 'AddspaceController@close']);

        # Configuration data route
        Route::get('/config',['as' => 'config', 'uses' => 'HomeController@config']);

        # User management routes
        Route::group(['prefix' => 'users'], function () {
            Route::post('/',['as' => 'users.store', 'uses' => 'UserController@store']);
            Route::get('create',['as' => 'users.create', 'uses' => 'UserController@create']);
        });

        # Withdrawal flow routes
        Route::get('withdrawal', ['as' => 'withdrawal.index','uses' => 'WalletController@withdrawals',]);
        Route::get('withdrawal/{transaction_id}/authorize', ['as' => 'withdrawal.show','uses' => 'WalletController@showWithdrawal',]);
        Route::post('withdrawal/{transaction_id}/authorize', ['as' => 'withdrawal.authorize','uses' => 'WalletController@authorizeWithdrawal',]);
    });

    # Editor specific routes
    Route::group(['middleware' => ['editor']], function(){

        # Addspaces routes
        Route::resource('addspaces', 'AddspaceController', ['except' => ['index', 'show']]);
        Route::get('addspaces/{id}/activate', ['as' => 'addspaces.activate', 'uses' => 'AddspaceController@activate']);
        Route::get('addspaces/{id}/pause', ['as' => 'addspaces.pause', 'uses' => 'AddspaceController@pause']);
        Route::get('addspaces/{id}/close', ['as' => 'addspaces.close', 'uses' => 'AddspaceController@close']);

        # Withdrawal request routes
        Route::post('withdraw', ['as' => 'withdraw','uses' => 'WalletController@withdraw']);
    });

    # Advertiser specific routes
    Route::group(['middleware' => ['advertiser']], function(){

        # Payment routes
        Route::post('addspace/{id}/charge', ['as' => 'addspaces.charge', 'uses' => 'WalletController@charge']);
        Route::post('addspace/{id}/reject', ['as' => 'addspaces.reject', 'uses' => 'WalletController@rejectPayment']);
        Route::post('addspace/{id}/accept', ['as' => 'addspaces.accept', 'uses' => 'WalletController@acceptPayment']);

        # Deposit request routes
        Route::get('deposit', ['as' => 'deposit', 'uses' => 'WalletController@showDeposit']);
        Route::post('deposit', ['as' => 'deposit.prepare', 'uses' => 'WalletController@prepareDeposit']);

        # Deposit flow routes
        Route::get('deposit-cancel/{id}', ['as' => 'deposit.cancel', 'uses' => 'WalletController@cancelDeposit']);
        Route::get('deposit-accept/{id}', ['as' => 'deposit.accept', 'uses' => 'WalletController@acceptDeposit']);
    });
});

