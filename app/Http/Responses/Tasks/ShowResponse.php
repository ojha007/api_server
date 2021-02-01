<?php


namespace App\Http\Responses\Tasks;


use App\Http\Resources\TasksResource;
use App\Models\Task;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    protected $viewPath;

    protected $task;


    /**
     * IndexResponse constructor.
     * @param string $viewPath
     * @param Task $task
     */
    public function __construct(string $viewPath, Task $task)
    {
        $this->viewPath = $viewPath;
        $this->task = $task;
    }

    public function toResponse($request)
    {
        $task = $this->task;
        if ($request->wantsJson() || $request->ajax()) {
            return new TasksResource($task);
        }
        return view($this->viewPath . 'show', compact('task'));
    }
}
