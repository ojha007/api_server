<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\User;

class WorkerRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getSelectItems($text)
    {
        return $this->getAllWorkers()
            ->mapWithkeys(function ($worker) {
                return [$worker->id => $worker->name];
            });
    }

    public function getAllWorkers()
    {
        return User::role(User::WORKER)->get();
    }

}
