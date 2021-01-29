<?php


namespace App\Http\Responses\Tasks;


use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
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
     * @var int
     */
    private $id;

    /**
     * IndexResponse constructor.
     * @param string $viewPath
     * @param int $id
     */
    public function __construct(string $viewPath, int $id)
    {
        $this->viewPath = $viewPath;
        $this->model = new Task();
        $this->repository = new TaskRepository($this->model);
        $this->id = $id;
    }

    public function toResponse($request)
    {
        $task = $this->repository->getById($this->id);
        if ($request->wantsJson()) {
            return new TasksResource($task);
        }
        return view($this->viewPath . 'show', compact('task'));
    }
}
