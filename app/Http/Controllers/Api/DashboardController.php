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
            ->select('task_id')
            ->where('status', '=', TaskStatus::COMPLETED)
            ->groupBy('task_id');
        return DB::table('users')
            ->join('task_status as taskStatus', 'users.id', '=', 'taskStatus.user_id')
            ->joinSub($sub, 'completedTask', 'completedTask.task_id', '=', 'taskStatus.id')
            ->where('users.id', '=', auth()->id())
            ->count('taskStatus.id');

    }

    private function rejectedTask(): int
    {
        $sub = DB::table('task_status')
            ->select('task_id')
            ->where('status', '=', TaskStatus::REJECTED)
            ->groupBy('task_id');
        return DB::table('users')
            ->join('task_status as taskStatus', 'users.id', '=', 'taskStatus.user_id')
            ->joinSub($sub, 'rejectedTask', 'rejectedTask.task_id', '=', 'taskStatus.id')
            ->where('users.id', '=', auth()->id())
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
}
