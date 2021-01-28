<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Employee;
use App\Models\Task;

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

}
