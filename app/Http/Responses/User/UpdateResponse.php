<?php

namespace App\Http\Responses\User;

use App\Models\User;
use App\Notifications\UserUpdated;
use Illuminate\Contracts\Support\Responsable;

class UpdateResponse implements Responsable
{

    /**
     * @var User
     */
    protected $user;

    /**
     * UpdateResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function toResponse($request)
    {
        $attribute = [
            'is_reloadable' => true
        ];
        $this->user->notify(new UserUpdated($this->user));
        $request->session()->flash('success', 'User updated successfully.');
        return response()->json(['status' => '200', 'data' => $attribute]);
    }
}
