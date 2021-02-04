<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Booking
     */
    protected $booking;
    /**
     * @var string
     */
    protected $via;


    /**
     * BookingConfirmed constructor.
     * @param Booking $booking
     */
    public function __construct(Booking $booking)
    {

        $this->booking = $booking;
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
            ->subject('Booking Confirmed')
            ->line('You are receiving this email because your booking has been confirmed .')
            ->line('Our team member will be at your door soon.')
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

        ];
    }

    public function toDatabase($notifiable): array
    {

        return [
            'booking_id' => $this->booking->id ?? '',
            'name' => $this->booking->name ?? '',
            'email' => $this->booking->email ?? '',
        ];
    }
}
