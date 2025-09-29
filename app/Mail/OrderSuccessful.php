<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $ticketBarcodes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $username,$ticketBarcodes)
    {
        $this->order = $order;
        $this->username = $username;
        $this->ticketBarcodes = $ticketBarcodes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation - Eversabz')
                    ->view('emails.order_successful')
                    ->with([
                        'order' => $this->order,
                        'username' => $this->username,
                        'ticketBarcodes' => $this->ticketBarcodes
                    ]);
    }
}
