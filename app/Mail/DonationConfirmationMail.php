<?php
namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        return $this->view('emails.donations.donation-confirmation')
                    ->subject('Donation Confirmation')
                    ->with([
                        'donation' => $this->donation,
                    ]);
    }
}

