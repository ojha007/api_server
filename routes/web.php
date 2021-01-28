<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::any('/', function (){
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function ($router) {
    $router->get('/home', 'DashboardController@dashboard')->name('dashboard');
    $router->resource('upcoming-schedule', 'UpcomingScheduleController');
    $router->resource('enquiries', 'EnquiryController');
    $router->resource('quotations', 'QuotationController');
    $router->resource('workers', 'WorkerController');
    $router->resource('campaigns', 'CampaignController');
    $router->get('enquiries/{id}/quotations', 'EnquiryController@sendQuotations')->name('enquiries.quotations');
//    $router->get('countries', 'CountryController@getAllCountries');
//    $router->get('states/country/{country_id}', 'StateController@getAllStatesByCountry');

});

Auth::routes();

