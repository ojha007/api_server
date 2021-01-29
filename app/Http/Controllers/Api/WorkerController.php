<?php


namespace App\Http\Controllers\Api;


class WorkerController extends \App\Http\Controllers\WorkerController
{

    protected $repository;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

}
