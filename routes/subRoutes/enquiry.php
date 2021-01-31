<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'enquiries.', 'prefix' => 'enquiries'], function ($router) {
    $router->get('/', 'EnquiryController@index')->name('index');
    $router->get('/show/{id}', 'EnquiryController@show')->name('show');
    $router->post('/enquiries/send-quotations', 'EnquiryController@sendQuotations')->name('send-quotations');
});;


