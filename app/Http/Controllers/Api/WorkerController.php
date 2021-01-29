<?php


namespace App\Http\Controllers\Api;


class WorkerController extends \App\Http\Controllers\WorkerController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

}
