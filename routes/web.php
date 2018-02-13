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
   return view('emediamarket');
});

# Auth routes for all users
Auth::routes();
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset','Auth\ResetPasswordController@reset');

# Token Verification route
Route::get('/register/verify/{token}','Auth\RegisterController@verify');

# Auth enabled routes
Route::group(['middleware' => ['auth']], function(){

    # Home
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

    # Users routes
    Route::group(['prefix' => 'users'], function (){
        Route::get('/', ['as' => 'users.index', 'uses' => 'UserController@index']);
        Route::get('{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
        Route::get('{id}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
        Route::post('{id}', ['as' => 'users.update', 'uses' => 'UserController@update']);
    });

    # Messaging routes
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });

    # Addspaces access for everyone
    Route::resource('addspaces', 'AddspaceController', ['only' => ['index', 'show']]);

    Route::get('wallet', ['as' => 'wallet', 'uses' => 'WalletController@wallet']);

    # Manager specific routes
    Route::group(['middleware' => ['manager']], function(){

        # Addspaces routes
        Route::resource('addspaces', 'AddspaceController', ['except' => ['index', 'create' ,'show', 'delete']]);
        Route::get('addspaces/{id}/pause', ['as' => 'addspaces.pause', 'uses' => 'AddspaceController@pause']);
        Route::get('addspaces/{id}/close', ['as' => 'addspaces.close', 'uses' => 'AddspaceController@close']);
        Route::get('addspaces/{id}/activate', ['as' => 'addspaces.activate', 'uses' => 'AddspaceController@activate']);

        Route::post('addspace/{id}/reject', ['as' => 'addspaces.reject', 'uses' => 'WalletController@rejectPayment']);
        Route::post('addspace/{id}/accept', ['as' => 'addspaces.accept', 'uses' => 'WalletController@acceptPayment']);

        # Configuration data route
        Route::get('/config',['as' => 'config', 'uses' => 'HomeController@config']);

        # User management routes
        Route::group(['prefix' => 'users'], function () {
            Route::get('create',['as' => 'users.create', 'uses' => 'UserController@create']);
            Route::post('/',['as' => 'users.store', 'uses' => 'UserController@store']);
        });

        Route::get('transactions', ['as' => 'transactions', 'uses' => 'WalletController@transactions']);
        Route::get('profits', ['as' => 'profits', 'uses' => 'HomeController@profits']);
        Route::get('revenues', ['as' => 'revenues', 'uses' => 'WalletController@revenues']);

        Route::get('packages', ['as' => 'packages', 'uses' => 'WalletController@packages']);
        Route::get('packages/create', ['as' => 'package.create', 'uses' => 'CreditPackageController@create']);
        Route::post('packages/create', ['as' => 'package.store', 'uses' => 'CreditPackageController@store']);
        Route::get('packages/{id}/edit', ['as' => 'package.edit', 'uses' => 'CreditPackageController@edit']);
        Route::post('packages/{id}/edit', ['as' => 'package.update', 'uses' => 'CreditPackageController@update']);
        Route::get('packages/{id}/activate', ['as' => 'package.activate', 'uses' => 'CreditPackageController@activate']);
        Route::get('packages/{id}/deactivate', ['as' => 'package.deactivate', 'uses' => 'CreditPackageController@deactivate']);

        # Withdrawal flow routes
        Route::get('withdrawal', ['as' => 'withdrawal.index','uses' => 'WalletController@withdrawals',]);
        Route::get('withdrawal/{transaction_id}/authorize', ['as' => 'withdrawal.show','uses' => 'WalletController@showWithdrawal',]);
        Route::post('withdrawal/{transaction_id}/authorize', ['as' => 'withdrawal.authorize','uses' => 'WalletController@authorizeWithdrawal',]);
    });

    # Editor specific routes
    Route::group(['middleware' => ['editor']], function(){

        # Addspaces routes
        Route::resource('addspaces', 'AddspaceController', ['except' => ['index', 'show']]);
        Route::get('addspaces/{id}/pause', ['as' => 'addspaces.pause', 'uses' => 'AddspaceController@pause']);
        Route::get('addspaces/{id}/close', ['as' => 'addspaces.close', 'uses' => 'AddspaceController@close']);
        Route::get('addspaces/{id}/activate', ['as' => 'addspaces.activate', 'uses' => 'AddspaceController@activate']);

        Route::get('sales', ['as' => 'sales', 'uses' => 'WalletController@sales']);

        Route::get('packages', ['as' => 'packages', 'uses' => 'WalletController@packages']);

        # Withdrawal request routes
        Route::post('withdraw', ['as' => 'withdraw','uses' => 'WalletController@withdraw']);
    });

    # Advertiser specific routes
    Route::group(['middleware' => ['advertiser']], function(){

        Route::get('/addspaces/search', ['as' => 'addspaces.search', 'uses' => 'AddspaceController@search']);
        Route::post('/addspaces/search', ['as' => 'addspaces.filter', 'uses' => 'AddspaceController@filter']);

        Route::get('packages', ['as' => 'packages', 'uses' => 'WalletController@packages']);
        Route::get('payments', ['as' => 'payments', 'uses' => 'WalletController@payments']);

        # Payment routes
        Route::post('addspace/{id}/charge', ['as' => 'addspaces.charge', 'uses' => 'WalletController@charge']);
        Route::post('addspace/{id}/user-reject', ['as' => 'addspaces.user_reject', 'uses' => 'WalletController@rejectPaymentByUser']);
        Route::post('addspace/{id}/accept', ['as' => 'addspaces.accept', 'uses' => 'WalletController@acceptPayment']);

        # Deposit request routes
        Route::get('deposit', ['as' => 'deposit', 'uses' => 'WalletController@showDeposit']);
        Route::post('deposit', ['as' => 'deposit.prepare', 'uses' => 'WalletController@prepareDeposit']);

        # Deposit flow routes
        Route::get('deposit-cancel/{id}', ['as' => 'deposit.cancel', 'uses' => 'WalletController@cancelDeposit']);
        Route::get('deposit-accept/{id}', ['as' => 'deposit.accept', 'uses' => 'WalletController@acceptDeposit']);
    });
});

