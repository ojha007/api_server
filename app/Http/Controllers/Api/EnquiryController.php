<?php


namespace App\Http\Controllers\Api;


class EnquiryController extends \App\Http\Controllers\EnquiryController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
