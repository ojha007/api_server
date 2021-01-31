<?php


namespace App\Http\Responses\UpcomingSchedule;


use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{

    /**
     * @var string
     */
    private $viewPath;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public function toResponse($request)
    {
        if ($request->wantsJson()) {

        }
        $tasks = (new TaskRepository(new Task()))->getTaskForCalendar();
        return view($this->viewPath . 'index', compact('tasks'));

    }
}
