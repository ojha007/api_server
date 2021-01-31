<?php

use Illuminate\Support\Facades\Route;

Route::resource('bookings', 'BookingController');
Route::post('bookings/confirmed', 'BookingController@confirmed')->name('bookings.confirmed');
Route::post('bookings/assigned', 'BookingController@assigned')->name('bookings.assigned');
