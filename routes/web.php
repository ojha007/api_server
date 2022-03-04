<?php

use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function ($router) {
    $router->get('/', 'DashboardController@dashboard')->name('dashboard');
    $router->get('/home', 'DashboardController@dashboard')->name('dashboard');
    $router->get('/gmailOauthCallback', function () {
        LaravelGmail::makeToken();
        return redirect()->to('/home');

    });
    $router->resource('schedules', 'ScheduleController');
    include 'subRoutes/enquiry.php';
    $router->resource('quotations', 'QuotationController');
    $router->resource('faqs', 'FaqController');
    include 'subRoutes/booking.php';
    $router->resource('workers', 'WorkerController');
    $router->resource('campaigns', 'CampaignController');
    $router->get('tasks/calendar', 'TaskController@calendar')->name('tasks.calendar');
    $router->post('tasks/assigned', 'TaskController@assigned')->name('tasks.assigned');
    $router->resource('tasks', 'TaskController');
//    $router->resource('invoices', 'InvoiceController');
    include 'subRoutes/mails.php';

    Route::get('/myob/callback', 'InvoiceController@setTokenAfterCallback');
    Route::get('/myob/getAccessCode', 'InvoiceController@getAccessTokenCode');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    include 'subRoutes/xero.php';
    $router->get('developers', function () {
        return view('developers.index');
    })->name('developer.index');
    $router->post('/chat', 'ChatController@replyToChat');
    $router->get('/getAllChats', 'ChatController@getAllChats');
    $router->get('/getOldChats', 'ChatController@getOldChats');

});

Auth::routes();


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('privacy-policy', function () {

    return view('privacy');
});
