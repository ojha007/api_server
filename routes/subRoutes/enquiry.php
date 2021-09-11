<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'enquiries.', 'prefix' => 'enquiries'], function ($router) {
    $router->get('/', 'EnquiryController@index')->name('index');
    $router->post('/enquiries/send-quotations', 'EnquiryController@sendQuotation')->name('send-quotations');
    $router->get('/show/{id}', 'EnquiryController@show')->name('show');
    $router->get('{id}/show-quotations/', 'EnquiryController@showQuotations')->name('show-quotations');
    $router->get('{id}/quotations', 'EnquiryController@sendQuotation')->name('quotations');
});;


