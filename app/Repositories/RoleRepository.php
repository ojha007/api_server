<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use Spatie\Permission\Models\Role;

class RoleRepository extends Repository
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function allRolesByGuard($guardName)
    {
        return $this->model->where('guard_name', $guardName)->get();
    }
}
