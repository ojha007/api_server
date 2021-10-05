<?php

namespace App\Jobs;

use App\Notifications\SendQuotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendQuotationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $enquiry;
    protected $quotations;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($enquiry, $quotations)
    {
        $this->enquiry = $enquiry;
        $this->quotations = $quotations;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::route('mail', $this->enquiry->email)
            ->notify(new SendQuotation($this->quotations, $this->enquiry));
    }
}
