<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Repositories\XeroRepository;

class WorkerController extends \App\Http\Controllers\WorkerController
{

    protected $repository;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->repository = new XeroRepository(new User());
    }

}
