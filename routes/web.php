<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function ($router) {
    $router->any('/home', 'DashboardController@dashboard')->name('dashboard');
    $router->resource('upcoming-schedule', 'UpcomingScheduleController');
    $router->resource('enquiries', 'EnquiryController');
    $router->resource('quotations', 'QuotationController');
    $router->get('enquiries/{id}/quotations', 'EnquiryController@sendQuotations')->name('enquiries.quotations');
//    $router->get('countries', 'CountryController@getAllCountries');
//    $router->get('states/country/{country_id}', 'StateController@getAllStatesByCountry');

});

Auth::routes();

