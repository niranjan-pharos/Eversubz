<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $cartItems;

    public function __construct($order, $cartItems)
    {
        $this->order = $order;
        $this->cartItems = $cartItems;
    }

    public function build()
    {
        return $this->subject('Order Confirmation')
                    ->view('emails.store-order-confirmation')
                    ->with([
                        'order' => $this->order,
                        'cartItems' => $this->cartItems,
                    ]);
    }
}