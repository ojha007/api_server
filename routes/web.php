<?php

use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::any('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function ($router) {
    $router->get('/home', 'DashboardController@dashboard')->name('dashboard');
    $router->get('/gmailOauthCallback', function () {
        LaravelGmail::makeToken();
        return redirect()->to('/home');

    });
    $router->resource('schedules', 'ScheduleController');
    include 'subRoutes/enquiry.php';
    $router->resource('quotations', 'QuotationController');
    include 'subRoutes/booking.php';
    $router->resource('workers', 'WorkerController');
    $router->resource('campaigns', 'CampaignController');
    $router->get('tasks/calendar', 'TaskController@calendar')->name('tasks.calendar');
    $router->post('tasks/assigned', 'TaskController@assigned')->name('tasks.assigned');
    $router->resource('tasks', 'TaskController');
    include 'subRoutes/mails.php';

    Route::resource('users', 'UserController')->except(['edit', 'create']);
    Route::resource('roles', 'RoleController');
//    $router->get('countries', 'CountryController@getAllCountries');
//    $router->get('states/country/{country_id}', 'StateController@getAllStatesByCountry');
    $router->get('developers', function () {
        return view('developers.index');
    })->name('developer.index');
    $router->get('/inbox', 'DashboardController@inbox')->name('inbox');

});

Auth::routes();
Route::get('/oauth/gmail', function () {
    return LaravelGmail::redirect();
});

Route::get('/oauth/gmail/callback', function () {
    LaravelGmail::makeToken();
    return redirect()->to('/home');
});

Route::get('/oauth/gmail/logout', function () {
    LaravelGmail::logout(); //It returns exception if fails
    return redirect()->to('/home');
});
