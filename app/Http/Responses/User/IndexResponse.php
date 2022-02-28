<?php

namespace App\Http\Responses\User;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class IndexResponse implements Responsable
{
    protected $users, $roles, $routePrefix;


    public function __construct(Collection $users, $routePrefix)
    {
        if (Auth::user()->isSuper())
            $this->users = $users;
        else
            $this->users = $users->filter(function ($user) {
                return $user->super = 1;
            });
        $this->routePrefix = $routePrefix;
    }

    public function toResponse($request)
    {
        return view('users.index')->with('users', $this->transformUsers());
    }

    public function transformUsers(): Collection
    {
        return $this->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'roles' => $user->roles->where('guard_name', $this->routePrefix)->pluck('name')->toArray()
            ];
        });
    }

}
