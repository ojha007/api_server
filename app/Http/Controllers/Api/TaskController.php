<?php


namespace App\Http\Controllers\Api;


use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController extends \App\Http\Controllers\TaskController
{
    /**
     * @var TaskRepository
     */
    protected $repository;

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->repository = new TaskRepository(new Task());
    }
}
