<?php


namespace App\Http\Controllers\Api;


class TaskController extends \App\Http\Controllers\TaskController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
