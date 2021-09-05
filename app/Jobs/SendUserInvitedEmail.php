<?php

namespace App\Jobs;

use App\Notifications\UserInvited;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendUserInvitedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $password_generated;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $password_generated)
    {
        $this->user = $user;
        $this->password_generated = $password_generated;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new UserInvited($this->user, $this->password_generated));
    }
}
