<?php


namespace App\Http\Controllers\Api;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;

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


    public function show($id)
    {
        try {
            $latestStatus = DB::table('task_status')
                ->select('task_id', 'status', 'id')
                ->where('task_id', '=', $id)
                ->orderByDesc('created_at')
                ->limit(1);
            $task = DB::table('tasks as t')
                ->select(['t.title', 't.code', 'ts.status', 'ts.id as taskId',
                    'b.name', 'email', 'phone', 'moving_date',
                    'moving_from_suburb', 'moving_to_suburb',
                    'pickup_address','comments','b.description',
                    'quotes','size_of_moving','additional_service',
                    'access_parking','dropoff_address','pickup_address',
                    'inventory','b.id as bookingId','t.created_at as taskTime'])
                ->join('bookings as  b', 'b.id', '=', 't.booking_id')
                ->join('task_workers as tw','tw.task_id','=','t.id')
                ->joinSub($latestStatus, 'ts', 'ts.task_id', '=', 't.id')
                ->where('b.is_verified',true)
                ->where('tw.worker_id',auth()->id())
                ->get();
            return new SuccessResponse($task);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

}
