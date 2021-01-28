<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function ($router) {
    $router->post('login', 'AuthController@login')->name('login');
    $router->post('register', 'AuthController@register')->name('register');
    $router->group(['middleware' => 'auth:api', 'as' => 'api.'], function ($route) {
        $route->apiResource('enquiries', 'EnquiryController');
        $route->apiResource('workers', 'WorkerController');
        $route->apiResource('campaigns', 'CampaignController');
        $route->apiResource('tasks', 'TaskController');
        $route->get('countries', 'CountryController@getAllCountries');
        $route->get('states/country/{country_id}', 'StateController@getAllStatesByCountry');
    });

});
