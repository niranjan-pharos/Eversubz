<?php
namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationFailureMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $donation;

    /**
     * Create a new message instance.
     *
     * @param Donation $donation
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Donation Payment Failed')
            ->markdown('emails.donations.donation-failed')
            ->with([
                'donation' => $this->donation, // Pass donation data to the view
            ]);
    }
}
