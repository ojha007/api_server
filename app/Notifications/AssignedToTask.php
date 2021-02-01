<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignedToTask extends Notification implements ShouldQueue
{
    use Queueable;


    /**
     * @var User
     */
    protected $user;
    /**
     * @var Task
     */
    protected $task;

    public function __construct(User $user, Task $task)
    {

        $this->user = $user;
        $this->task = $task;
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
        $booking = $this->task->getRelation('booking');
        return (new MailMessage)
            ->subject('Task Assigned')
            ->line('Hello ' . $this->user->getAttribute('name') ?? '')
            ->line('You are receiving this email because you have been assigned to the task.')
            ->line('Client Information :')
            ->line("Name: " . $booking->name)
            ->line("Email: " . $booking->email)
            ->line("Phone: " . $booking->phone)
            ->line("Pickup Address: " . $booking->pickup_address)
            ->line("Size of moving: " . Booking::allSizeOfMoving()[$booking->size_of_moving] ?? '')
            ->action('Confirmed your task on ' . config('app.name'), config('app.url'))
            ->line('Thank you');
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
