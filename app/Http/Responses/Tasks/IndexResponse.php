<?php


namespace App\Http\Responses\Tasks;


use App\Http\Collection\TasksCollection;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    protected $viewPath;
    /**
     * @var Task
     */
    protected $model;
    /**
     * @var TaskRepository
     */
    protected $repository;

    /**
     * IndexResponse constructor.
     * @param $viewPath
     */
    public function __construct($viewPath)
    {
        $this->viewPath = $viewPath;
        $this->model = new Task();
        $this->repository = new TaskRepository($this->model);
    }

    public function toResponse($request)
    {


        $tasks = $this->repository->paginateWith(15, 'workers', 'status', 'booking');
        if ($request->wantsJson()) {
            return new TasksCollection($tasks);
        }
        return view($this->viewPath . 'index', compact('tasks'));
    }
}
