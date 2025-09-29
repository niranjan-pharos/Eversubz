<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminOrderNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $product;

    public function __construct($order, $user, $product)
    {
        $this->order = $order;
        $this->user = $user;
        $this->product = $product;
     
    }

    public function build()
    {

        $pdf = Pdf::loadView('pdf.productorder', [
            'order' => $this->order,
            'user' => $this->user,
            'product' => $this->product,
        ]); 
        return $this->subject('Order Confirmation')
                    ->view('emails.admin_order_confirmation')
                    ->with([
                        'order' => $this->order,
                        'user' => $this->user,
                        'product' => $this->product,
                    ])

                    ->attachData($pdf->output(), 'productorder.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
