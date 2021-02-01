<?php


namespace App\Http\Responses\UpcomingSchedule;


use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
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
        $workers = (new UserRepository(new User()))
            ->getUsersByRole(User::WORKER)
            ->pluck('name', 'id');
        return view($this->viewPath . 'index', compact('tasks', 'workers'));

    }
}
