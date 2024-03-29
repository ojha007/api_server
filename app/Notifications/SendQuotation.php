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


    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->view('mails.quotation',['quotation'=>$this->quotation]);
    }


//    public function build()
//    {
//        return $this->view('mails.quotation');
//    }

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
