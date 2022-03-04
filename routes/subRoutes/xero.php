<?php
Route::get('/manage/xero', 'XeroController@index')->name('xero.auth.success');
Route::get('/xero/auth/logout', 'XeroController@logout')->name('xero.auth.logout');
Route::get('/invoices/xero', 'XeroController@invoices')->name('xero.invoices');
Route::get('/invoices/xero/{invoiceId}', 'XeroController@getInvoice');
Route::get('manage/xero/invoices/{invoiceId}','XeroController@show');
