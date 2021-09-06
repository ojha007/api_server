<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        $attributes['password'] = $this->encryptPassword($attributes['password_generated']);
        return $this->model->create($attributes);
    }

    public function encryptPassword($password_generated)
    {
        return Hash::make($password_generated);
    }


    public function getUsersByPermissionGuard($permission, $guard)
    {
        return Permission::findByName($permission, $guard)->users;
    }

    public function selectUsers($users): array
    {
        $selectUsers = [];
        foreach ($users as $user) {
            $selectUsers[$user->id] = $user->name;
        }
        return $selectUsers;
    }

    public function deleteFomApplication($id, $roles, $routePrefix)
    {
        $user = $this->getById($id);
        if ($routePrefix) {
            $roles = $roles->where('guard_name', $routePrefix);
            foreach ($roles as $role) {
                $user->removeRole($role);
            }
            $user->revokePermissionTo($routePrefix . '-permission');
        }
    }

    public function getUsersByRole($roles, $guard = null)
    {
        return Role::findByName(User::WORKER)->users;
    }
}
