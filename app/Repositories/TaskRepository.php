<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository extends Repository
{

    /**
     * @var Employee
     */
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getTaskForCalendar(): \Illuminate\Support\Collection
    {
        return DB::table('tasks as t')
            ->select('t.title as title', 't.id as id', 'b.moving_date', 'b.time')
            ->selectRaw('concat(b.moving_date," ",IFNULL(b.time,"")) as start')
            ->join('bookings as b', 'b.id', '=', 't.booking_id')
            ->when(auth()->user()->super === 0, function ($query) {
                $query->join('task_workers as tw', 'tw.task_id', '=', 't.id')
                    ->where('tw.worker_id', '=', auth()->id());
            })
            ->orderByDesc('t.id')
            ->get()->map(function ($task) {
                return [
                    'start' => $task->moving_date . ($task->time ? ' ' . $task->time : ''),
                    'id' => $task->id,
                    'title' => $task->title
                ];
            });
    }

    public function getAssignedTask()
    {
        $taskIds = DB::table('task_workers')
            ->when(auth()->user()->super === 0, function ($q) {
                $q->where('worker_id', '=', auth()->id());
            })
            ->groupBy('task_id')
            ->pluck('task_id')
            ->toArray();
        return $this->getModel()
            ->with(['status', 'booking', 'workers'])
            ->whereIn('tasks.id', $taskIds)
            ->orderByDesc('tasks.id')
            ->get();
    }

}
