<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    private function totalWorker(): int
    {
        return DB::table('users')
            ->join('model_has_roles', 'model_id', '=', 'users.id')
            ->where('model_type', '=', 'App\\Models\\User')
            ->count('users.id');

    }

    private function totalTask(): int
    {

        return DB::table('users')
            ->join('task_workers as task', 'users.id', '=', 'task.worker_id')
            ->count('task.id');
    }

    private function completedTask(): int
    {
        $sub = DB::table('task_status')
            ->selectRaw('MAX(id) as id')
            ->groupBy('task_id');
        return DB::table('users')
            ->join('task_status as taskStatus', 'users.id', '=', 'taskStatus.user_id')
            ->joinSub($sub, 'completedTask', 'completedTask.id', '=', 'taskStatus.id')
            ->where('taskStatus.status', '=', TaskStatus::COMPLETED)
            ->where('users.id', '=', auth()->id())
            ->count('taskStatus.id');

    }

    private function rejectedTask(): int
    {
        $sub = DB::table('task_status')
            ->selectRaw('MAX(id) as id')
            ->groupBy('task_id');
        return DB::table('users')
            ->join('task_status as taskStatus', 'users.id', '=', 'taskStatus.user_id')
            ->joinSub($sub, 'rejectedTask', 'rejectedTask.id', '=', 'taskStatus.id')
            ->where('users.id', '=', auth()->id())
            ->where('taskStatus.status', '=', TaskStatus::REJECTED)
            ->count('taskStatus.id');

    }

    public function index(): SuccessResponse
    {
        $data = [
            'totalWorker' => $this->totalWorker(),
            'totalTask' => $this->totalTask(),
            'completedTask' => $this->completedTask(),
            'rejectedTask' => $this->rejectedTask(),
        ];
        return new SuccessResponse($data);
    }


    public function workerHistory(): SuccessResponse
    {
        $limit = request()->get('limit') ?? 10;
        $offset = request()->get('offset') ?? 0;
        $sub = DB::table('task_status')
            ->selectRaw('MAX(id) as id')
            ->where('user_id', '=', auth()->id())
            ->groupBy('task_id');
        $data = DB::table('users as u')
            ->select('ts.status', 'ts.reason', 't.description', 't.code', 'b.pickup_address', 'b.dropoff_address', 'b.moving_date', 'b.time', 't.id')
            ->join('task_workers as tw', 'tw.worker_id', '=', 'u.id')
            ->join('task_status as ts', 'ts.task_id', '=', 'tw.task_id')
            ->joinSub($sub, 'currentTaskStatus', 'currentTaskStatus.id', '=', 'ts.id')
            ->join('tasks as t', 't.id', '=', 'ts.task_id')
            ->join('bookings as b', 'b.id', '=', 't.booking_id')
            ->where('u.id', '=', auth()->id())
            ->orderByDesc('b.moving_date')
            ->limit($limit)
            ->offset($offset)
            ->get();
        return new SuccessResponse($data);
    }
}
