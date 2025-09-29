<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerOrderConfirmationMail;

class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipientEmail;
    protected $orderDetails;

    public function __construct($recipientEmail, $orderDetails)
    {
        $this->recipientEmail = $recipientEmail;
        $this->orderDetails = $orderDetails;
    }

    public function handle()
    {
        try {
            Mail::to($this->recipientEmail)
                ->send(new CustomerOrderConfirmationMail(
                    $this->orderDetails['firstOrder'],
                    $this->orderDetails['allItems'],
                    $this->orderDetails['user']
                ));
        } catch (\Exception $e) {
            \Log::error('Failed to send email', [
                'email' => $this->recipientEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }
}