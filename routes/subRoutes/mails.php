<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'mails', 'as' => 'mails.'], function ($mail) {
    $mail->match(['GET', 'POST'], '/sent', ['uses' => 'MailController@sent', 'as' => 'sent']);
    $mail->get('/compose', ['uses' => 'MailController@compose', 'as' => 'compose']);
    $mail->get('/trash', ['uses' => 'MailController@trash', 'as' => 'trash']);
    $mail->get('/draft', ['uses' => 'MailController@draft', 'as' => 'draft']);
    $mail->get('/copy/{id}', ['uses' => 'MailController@copy', 'as' => 'copy']);
    $mail->get('/edit/{id}', ['uses' => 'MailController@edit', 'as' => 'edit']);
    $mail->PATCH('/update/{id}', ['uses' => 'MailController@update', 'as' => 'update']);
});
