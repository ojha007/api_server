<?php

namespace App\Http\Responses\User;

use App\Jobs\SendUserInvitedEmail;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;
use App\Notifications\UserInvited;

class StoreResponse implements Responsable
{

    protected $user, $password_generated;

    public function __construct(User $user, $password_generated)
    {
        $this->user = $user;
        $this->password_generated = $password_generated;
    }

    public function toResponse($request)
    {
        Log::info($this->user);
        dispatch(new SendUserInvitedEmail($this->user, $this->password_generated));
        $request->session()->flash('success', 'New user added successfully.');
        return redirect()->route('users.index');
    }
}
