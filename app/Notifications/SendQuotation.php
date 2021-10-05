<?php

namespace App\Notifications;

use App\Models\Enquiry;
use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendQuotation extends Notification implements ShouldQueue
{
    use Queueable;


    /**
     * @var Quotation
     */
    protected $quotation;
    /**
     * @var Enquiry
     */
    protected $enquiry;

    /**
     * SendQuotation constructor.
     * @param Quotation $quotation
     * @param Enquiry $enquiry
     */
    public function __construct(Quotation $quotation, Enquiry $enquiry)
    {

        $this->quotation = $quotation;
        $this->enquiry = $enquiry;
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


    public function toMail($notifiable): MailMessage
    {
        $description = $this->quotation->description ?? '';
        return (new MailMessage)
            ->subject('Review of your enquiry')
            ->line('Hello ' . $this->enquiry->getAttribute('name') ?? 'Sir/Madam')
            ->line('Our team have gone through your enquiries and we find the best suggest for you')
            ->line($description)
            ->action('For more information visit us ', config('app.url'))
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
