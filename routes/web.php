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
    return view('welcome');
});

Route::get('/logout', function(){
   Auth::logout();

   return redirect('/');
});

Auth::routes();

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
    });

    # Advertiser specific routes
    Route::group(['middleware' => ['advertiser']], function(){
        Route::post('addspace/{id}/charge', ['as' => 'addspaces.charge', 'uses' => 'WalletController@charge']);
    });
});

