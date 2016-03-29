<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
    return view('terms-of-use');
});
//backend

//Route::group(['middleware' => 'auth'], function()
//{
    Route::resource('admin/advertisement', 'AdvertisementController');
    Route::post('admin/advertisement/sorting', 'AdvertisementController@sorting');
//});


Route::get('admin', function () {
    return redirect('admin/login');
});
Route::get('admin/login',function(){ return view('admin.login');});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//frontend
Route::resource('index', 'HomeController');
Route::resource('cloudtraxauth', 'CloudtraxController');
Route::post('fetch/{sorting}', 'HomeController@fetch');
