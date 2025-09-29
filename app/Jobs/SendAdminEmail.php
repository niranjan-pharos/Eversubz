<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminOrderNotificationMail;

class SendAdminEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipientEmail;
    protected $adminData;

    public function __construct($recipientEmail, $adminData)
    {
        $this->recipientEmail = $recipientEmail;
        $this->adminData = $adminData;
    }

    public function handle()
    {
        try {
            Mail::to($this->recipientEmail)
                ->send(new AdminOrderNotificationMail(
                    $this->adminData['firstOrder'],
                    $this->adminData['user'],
                    $this->adminData['allItems']
                ));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin email', [
                'email' => $this->recipientEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }
}