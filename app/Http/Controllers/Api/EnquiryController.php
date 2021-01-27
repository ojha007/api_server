<?php


namespace App\Http\Controllers\Api;


class EnquiryController extends \App\Http\Controllers\EnquiryController
{

    protected $model;
    protected $repository;

    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
