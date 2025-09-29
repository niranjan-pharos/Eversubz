<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Donation;

class AdminDonationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $donation;

    /**
     * Create a new message instance.
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Donation Confirmation')
            ->markdown('emails.donations.donation-confirmation')
            ->with([
                'donation' => $this->donation, // Pass donation data to the view
            ]);
    }
}
