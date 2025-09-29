<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;


class TicketConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $event, $tickets, $successUrl, $qrCodeSvg;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $event, $tickets)
    {
        $this->order = $order;
        $this->event = $event;
        $this->tickets = $tickets;

        $this->successUrl = route('event.success', [
            'encryptedOrderId' => Crypt::encryptString($order->id),
            'guest_email' => $order->guest_email ?? '',
        ]);

        $this->qrCodeSvg = QrCode::size(300) 
            ->generate($this->successUrl);
    }

    public function build()
    {
        $pdf = PDF::loadView('pdf.ticket', [
            'order' => $this->order,
            'event' => $this->event,
            'tickets' => $this->tickets,
            'qrCode' => $this->qrCodeSvg,
        ]);

        $successUrl = $this->successUrl;

        $qrResult = QrCode::size(300)
            ->format('png')
            ->generate($successUrl);

        $qrTempPath = sys_get_temp_dir() . '/' . Str::uuid() . '.png';
        file_put_contents($qrTempPath, $qrResult);

        return $this->subject('Your Event Ticket Confirmation')
            ->view('emails.ticket-confirmation') 
            ->with([
                'order' => $this->order,
                'event' => $this->event,
                'tickets' => $this->tickets,
                'successUrl' => $successUrl,
            ])
            ->attachData($pdf->output(), 'ticket.pdf', [
                'mime' => 'application/pdf',
            ])
            ->attach($qrTempPath, [
                'as' => 'qrcode.png',
                'mime' => 'image/png',
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Confirmation Mail',
        );
    }

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

