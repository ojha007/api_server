<?php


namespace App\Http\Controllers\Api;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\Tasks\IndexResponse;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;

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

    public function index()
    {
        try {
            $latestStatus = DB::table('task_status')
                ->select('task_id', 'status', 'id')
                ->where('user_id', auth()->id())
                ->whereIn('id',
                    DB::table('task_status')
                        ->selectRaw('max(id) as id')
                        ->groupBy('task_id')
                        ->pluck('id')
                );
            $tasks = DB::table('tasks')
                ->select('tasks.code', 'tasks.id', 'tasks.title', 'taskStatus.status', 'tasks.description')
                ->join('task_workers', 'tasks.id', '=', 'task_workers.task_id')
                ->join('bookings', 'bookings.id', '=', 'tasks.booking_id')
                ->joinSub($latestStatus, 'taskStatus', 'taskStatus.task_id', '=', 'tasks.id')
                ->where('bookings.is_verified', true)
                ->orderByDesc('moving_date')
                ->get();
            return new SuccessResponse($tasks);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }
}
