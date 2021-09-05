<?php

namespace App\Notifications;

use Carbon\Traits\Serialization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserInvited extends Notification implements ShouldQueue
{
    use Queueable,Serialization;

    protected $email;
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @param  $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->email = $user->email;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail', 'broadcast', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('User Invitation Notification')
            ->line('You are receiving this email because you have been invited to ' . config('app.name') . '.')
            ->line('Your login credentials are as')
            ->line('Username : ' . $this->email)
            ->line('Password : ' . $this->password)
            ->action('Go to ' . config('app.name'), config('app.url'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
