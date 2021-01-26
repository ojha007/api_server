<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Employee;

class EmployeeRepository extends Repository
{

    /**
     * @var Employee
     */
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param Employee $model
     */
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

}
