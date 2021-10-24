<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\Employee;
use App\Models\FAQ;

class FaqRepository extends Repository
{

    /**
     * @var Employee
     */
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param FAQ $model
     */
    public function __construct(FAQ $model)
    {
        $this->model = $model;
    }

    public function getAllActive()
    {
        return $this->model->where('is_active', true)
            ->get('title', 'description');
    }
}
