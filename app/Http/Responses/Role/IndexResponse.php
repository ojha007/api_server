<?php

namespace App\Http\Responses\Role;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;

class IndexResponse implements Responsable
{
    protected $roles;

    public function __construct(Collection $roles)
    {
        $this->roles = $roles;
    }

    public function toResponse($request)
    {
        return view('roles.index')->with('roles', $this->transformRoles());
    }

    public function transformRoles()
    {
        return $this->roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        });
    }
}
