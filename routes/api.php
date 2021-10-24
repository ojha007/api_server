<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function ($router) {
    $router->post('login', 'AuthController@login')->name('login');
    $router->post('change-password','AuthController@changePassword');
    $router->post('register', 'AuthController@register')->name('register');
    $router->group(['middleware' => 'auth:api', 'as' => 'api.'], function ($route) {
        $route->get('user/detail', 'AuthController@getLoggedInUser');
        $route->get('faqs','FaqController@index');
        $route->apiResource('enquiries', 'EnquiryController');
        $route->apiResource('workers', 'WorkerController');
        $route->apiResource('campaigns', 'CampaignController');
        $route->put('tasks/changeStatus/{id}', 'TaskController@changeStatus');
        $route->post('tasks/storeImage/{id}', 'TaskController@storeImage');
        $route->apiResource('tasks', 'TaskController', ['only' => ['index', 'update', 'show']]);
        $route->apiResource('bookings', 'BookingController');
        $route->get('countries', 'CountryController@getAllCountries');
        $route->get('states/country/{country_id}', 'StateController@getAllStatesByCountry');
    });

});
