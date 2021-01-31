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
            ->select('b.moving_date as start','t.title as title')
            ->join('bookings as b', 'b.id', '=', 't.booking_id')
            ->orderByDesc('t.id')
            ->get();
    }

}
