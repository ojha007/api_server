<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Repositories\WorkerRepository;

class WorkerController extends \App\Http\Controllers\WorkerController
{

    protected $repository;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->repository = new WorkerRepository(new User());
    }

}
