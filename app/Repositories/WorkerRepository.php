<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Worker;

class WorkerRepository extends Repository
{
    protected $model;

    public function __construct(Worker $model)
    {
        $this->model = $model;
    }

    public function getSelectItems($text)
    {
        return $this->model->all()->mapWithKeys(function ($worker) {
            return [
                $worker->id => $worker->code . '-' . $worker->name
            ];
        });
    }

}
