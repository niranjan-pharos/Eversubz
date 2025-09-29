<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorOrderNotificationMail;

class SendVendorEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipientEmail;
    protected $vendorData;

    public function __construct($recipientEmail, $vendorData)
    {
        $this->recipientEmail = $recipientEmail;
        $this->vendorData = $vendorData;
    }

    public function handle()
    {
        try {
            Mail::to($this->recipientEmail)
                ->send(new VendorOrderNotificationMail(
                    $this->vendorData['order'],
                    $this->vendorData['email'],
                    $this->vendorData['items']
                ));
        } catch (\Exception $e) {
            \Log::error('Failed to send vendor email', [
                'email' => $this->recipientEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }
}