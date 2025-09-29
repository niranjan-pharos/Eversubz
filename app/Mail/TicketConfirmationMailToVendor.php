<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;



class TicketConfirmationMailToVendor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $event, $tickets)
    {
        $this->order = $order;
        $this->event = $event;
        $this->tickets = $tickets;
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.ticket', [
            'order' => $this->order,
            'event' => $this->event,
            'tickets' => $this->tickets,
        ]);

        return $this->subject('Your Event Ticket Confirmation')
            ->markdown('emails.ticket-confirmation')
            ->with([
                'order' => $this->order, // Pass order to the view
                'event' => $this->event, // Pass event to the view
                'tickets' => $this->tickets, // Pass tickets to the view
            ])
            ->attachData($pdf->output(), 'ticket.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ticket-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
