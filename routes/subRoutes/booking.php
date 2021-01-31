<?php

use Illuminate\Support\Facades\Route;

Route::resource('bookings', 'BookingController');
Route::get('bookings/confirmed/{id}', 'BookingController@confirmed')->name('bookings.confirmed');
