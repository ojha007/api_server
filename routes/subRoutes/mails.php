<?php

use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'mails', 'as' => 'mails.'], function ($mail) {
    $mail->match(['GET', 'POST'], '/sent', ['uses' => 'MailController@sent', 'as' => 'sent']);
    $mail->get('/compose', ['uses' => 'MailController@compose', 'as' => 'compose']);
    $mail->get('/trash', ['uses' => 'MailController@trash', 'as' => 'trash']);
    $mail->get('/inbox', ['uses' => 'MailController@inbox', 'as' => 'inbox']);
    $mail->get('/index', ['uses' => 'MailController@index', 'as' => 'index']);
    $mail->get('/draft', ['uses' => 'MailController@draft', 'as' => 'draft']);
    $mail->get('/view/{id}', ['uses' => 'MailController@view', 'as' => 'view']);

});

Route::get('/oauth/gmail', function () {
    return LaravelGmail::redirect();
});

Route::get('/oauth/gmail/callback', function () {
    LaravelGmail::makeToken();
    return redirect()->to('/home');
});

Route::get('/oauth/gmail/logout', function () {
    LaravelGmail::logout(); //It returns exception if fails
    return redirect()->to('/home');
});

Route::get('gmailOauthCallback',function(){
  LaravelGmail::makeToken();
    return redirect()->to('/home');
});
