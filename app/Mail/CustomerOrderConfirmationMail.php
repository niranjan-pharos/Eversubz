<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class CustomerOrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $product;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $product, $user = null)
    {
        $this->order = $order;
        $this->product = $product;
        $this->user = $user ?: (object)['email' => 'customer@example.com'];
    }

    /**
     * Build the message.
     */
    public function build()
    {
        try {
            $pdf = Pdf::loadView('pdf.productorder', [
                'order' => $this->order,
                'user' => $this->user,
                'product' => $this->product,
            ])->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

            return $this->subject('Order Confirmation - #' . ($this->order->order_product_unique_id ?? $this->order->id))
                        ->view('emails.customer_order_confirmation')
                        ->with([
                            'order' => $this->order,
                            'user' => $this->user,
                            'product' => $this->product,
                        ])
                        ->attachData($pdf->output(), 'order_confirmation_' . ($this->order->id ?? 'unknown') . '.pdf', [
                            'mime' => 'application/pdf',
                        ]);
        } catch (\Exception $e) {
            Log::error('Failed to generate PDF for customer order confirmation', [
                'order_id' => $this->order->id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Fallback without PDF
            return $this->subject('Order Confirmation - #' . ($this->order->order_product_unique_id ?? $this->order->id))
                        ->view('emails.customer_order_confirmation')
                        ->with([
                            'order' => $this->order,
                            'user' => $this->user,
                            'product' => $this->product,
                        ]);
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Customer Order Confirmation - #' . ($this->order->order_product_unique_id ?? $this->order->id),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customer_order_confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
