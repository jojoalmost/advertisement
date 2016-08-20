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

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\UserActive;


Route::get('/api/{key}', 'HomeController@apiKey');
Route::get('/suspended',function(){
    return view('errors/503suspended');
});
//backend

Route::group(['middleware' => Authenticate::class], function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('admin/advertisement', 'AdvertisementController');
    Route::post('admin/advertisement/sorting', 'AdvertisementController@sorting');
    Route::post('admin/advertisement/skipduration', 'AdvertisementController@skipDuration');
    Route::resource('admin/log', 'LogController');
    Route::get('admin/bandwith', 'BandwithController@index');
    Route::put('admin/bandwith/update', 'BandwithController@update');
    Route::get('admin/radius', 'RadiusController@index');
    Route::put('admin/radius/update', 'RadiusController@update');
    Route::get('admin/terms', 'TermsController@index');
    Route::put('admin/terms/update', 'TermsController@update');
    Route::get('admin/report', 'LogController@report');
    Route::get('admin/report/viewreport/{id}', 'LogController@viewreport');
    Route::get('admin/adstest/{id}', 'AdvertisementController@adsTest');
    Route::get('admin/portal_mode', 'PortalModeController@index');
    Route::put('admin/portal_mode/update', 'PortalModeController@update');
    Route::resource('admin/default_packages', 'DefaultPackagesController');
    Route::resource('admin/customer_settings', 'CustomerSettingsController');
    Route::resource('admin/rates_price', 'RatesPriceController');
    Route::resource('admin/billing_entries', 'BillingEntriesController');
    Route::resource('admin/user_manager', 'UserController');
});


Route::get('admin', function () {
    return redirect('admin/login');
});
Route::get('admin/login', function () {
    return view('admin.login');
});

// Authentication routes...
Route::post('auth/login', 'LoginController@authenticate');
Route::get('auth/logout', 'LoginController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//frontend
Route::group(['middleware' => Useractive::class], function () {
    Route::get('/', 'HomeController@termsOfUse');
    Route::resource('ads', 'HomeController');
    Route::resource('cloudtraxauth', 'CloudtraxController');
    Route::get('cloudtraxres', 'AuthResponseController@response');
    Route::post('fetch/{sorting}', 'HomeController@fetch');
    Route::get('redirect', 'CloudtraxController@redirect');
});

