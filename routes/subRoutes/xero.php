<?php
Route::get('/manage/xero', 'XeroController@index')->name('xero.auth.success');
Route::get('/xero/auth/logout', 'XeroController@logout')->name('xero.auth.logout');
Route::get('/invoices/xero', 'XeroController@invoices')->name('xero.invoices');
Route::get('/invoices/xero/{invoiceId}', 'XeroController@getInvoice');
Route::get('/manage/xero/invoices/create', 'XeroController@create')->name('xero.invoice.create');
Route::get('/manage/xero/invoices/{invoiceId}', 'XeroController@show');
Route::get('/api/manage/xero/contacts', 'XeroController@getContacts');
Route::get('/api/manage/xero/taxRates', 'XeroController@TaxRates');
Route::get('/api/manage/xero/accounts', 'XeroController@getAccounts');
Route::post('/api/manage/xero/save-invoice', 'XeroController@saveInvoice');
Route::get('/api/manage/xero/downloadPdf/{invoiceId}', 'XeroController@downloadPdf')->name('xero.invoice.pdf');
Route::get('/api/manage/xero/email/{invoiceId}', 'XeroController@emailInvoice')->name('xero.invoice.email');
Route::get('/manage/xero/invoice/payment/{invoiceId}', 'XeroController@payment')->name('xero.invoice.payment');

