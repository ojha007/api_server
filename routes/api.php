<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function ($router) {
    $router->post('login', 'AuthController@login')->name('login');
    $router->post('register', 'AuthController@register')->name('register');
    $router->group(['middleware' => 'auth:api', 'as' => 'api.'], function ($route) {
        $route->apiResource('employees', 'EmployeeController');
        $route->apiResource('enquiries', 'EnquiryController');
        $route->get('countries', 'CountryController@getAllCountries');
        $route->get('states/country/{country_id}', 'StateController@getAllStatesByCountry');
    });

});
