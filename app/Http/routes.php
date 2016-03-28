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

Route::resource('admin/advertisement', 'AdvertisementController');
Route::post('admin/advertisement/sorting', 'AdvertisementController@sorting');
Route::get('/', function()
{
    return view('terms-of-use');
});
Route::resource('/index', 'HomeController');
Route::resource('/cloudtraxauth', 'CloudtraxController');
Route::get('/fetch/{sorting}', 'HomeController@fetch');
