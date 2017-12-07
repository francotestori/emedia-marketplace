<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('emediamarket');
});

Route::get('/logout', function(){
   Auth::logout();

   return redirect('/');
});

Route::get('/register/verify/{token}','Auth\RegisterController@verify');

Auth::routes();


Route::get('login-advertiser', ['as' => 'login.advertiser', 'uses' => 'Auth\LoginController@loginAdvertiser']);
Route::get('register-advertiser', ['as' => 'register.advertiser', 'uses' => 'Auth\RegisterController@registerAdvertiser']);
Route::get('reset-advertiser', ['as' => 'password.reset-advertiser', 'uses' => 'Auth\ResetPasswordController@resetAdvertiser']);

Route::get('login-editor', ['as' => 'login.editor', 'uses' => 'Auth\LoginController@loginEditor']);
Route::get('register-editor', ['as' => 'register.editor', 'uses' => 'Auth\RegisterController@registerEditor']);
Route::get('reset-editor', ['as' => 'password.reset-editor', 'uses' => 'Auth\ResetPasswordController@resetEditor']);

# Auth enabled routes
Route::group(['middleware' => ['auth']], function(){

    Route::get('/home', 'HomeController@index')->name('home');

    # Users routes
    Route::group(['prefix' => 'users'], function (){
        Route::get('/',['as' => 'users', 'uses' => 'UserController@index']);
        Route::get('{id}',['as' => 'users.show', 'uses' => 'UserController@show']);
        Route::get('{id}/edit',['as' => 'users.edit', 'uses' => 'UserController@edit']);
        Route::post('{id}',['as' => 'users.update', 'uses' => 'UserController@update']);
    });

    # Messages routes
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });

    # Addspaces access
    Route::resource('addspaces', 'AddspaceController', ['only' => ['index', 'show']]);

    # Manager specific routes
    Route::group(['middleware' => ['manager']], function(){
        Route::get('/config',['as' => 'config', 'uses' => 'HomeController@config']);
        # User creation
        Route::group(['prefix' => 'users'], function () {
            Route::get('create',['as' => 'users.create', 'uses' => 'UserController@create']);
            Route::post('/',['as' => 'users.store', 'uses' => 'UserController@store']);
        });

    });

    # Editor specific routes
    Route::group(['middleware' => ['editor']], function(){
        Route::resource('addspaces', 'AddspaceController', ['except' => ['index', 'show']]);

        Route::post('withdraw', ['as' => 'withdraw','uses' => 'WalletController@withdraw']);
    });

    # Advertiser specific routes
    Route::group(['middleware' => ['advertiser']], function(){
        Route::post('addspace/{id}/charge', ['as' => 'addspaces.charge', 'uses' => 'WalletController@charge']);

        Route::get('deposit', ['as' => 'deposit', 'uses' => 'WalletController@showDepositForm']);
        Route::post('deposit', ['as' => 'deposit.prepare', 'uses' => 'WalletController@deposit']);
        Route::get('deposit-success', ['uses' => 'WalletController@depositSuccess']);
    });
});

