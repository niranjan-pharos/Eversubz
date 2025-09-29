<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class VendorOrderNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $vendorEmail;
    public $items;

    public function __construct($order, $vendorEmail, $items)
    {
        if (!$order || !$vendorEmail || !$items) {
            throw new \InvalidArgumentException('Order, vendor email, and items are required.');
        }
        $this->order = $order;
        $this->vendorEmail = $vendorEmail;
        $this->items = $items;
    }

    public function build()
    {
        $orderId = $this->order->id ?? 'unknown';
        $orderUniqueId = $this->order->order_product_unique_id ?? 'unknown';

        try {
            $pdf = Pdf::loadView('pdf.vendor_order', [
                'order' => $this->order,
                'items' => $this->items,
                'vendorEmail' => $this->vendorEmail,
            ])->setOption(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            return $this->subject('New Vendor Order #' . $orderUniqueId)
                        ->view('emails.vendor_order_confirmation')
                        ->attachData($pdf->output(), 'order_' . $orderUniqueId . '.pdf', [
                            'mime' => 'application/pdf',
                        ]);
        } catch (\Exception $e) {
            Log::error('Failed to generate or attach PDF for vendor email', [
                'order_id' => $orderId,
                'vendor_email' => $this->vendorEmail,
                'error' => $e->getMessage(),
            ]);
            return $this->subject('New Vendor Order #' . $orderUniqueId)
                        ->view('emails.vendor_order_confirmation');
        }
    }
}