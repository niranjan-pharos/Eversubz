<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Milon\Barcode\Facades\DNS2DFacade;


class GenerateTicketBarcode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket;
    public $url;

    /**
     * Create a new job instance.
     */
    public function __construct($ticket, $url)
    {
        $this->ticket = $ticket;
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            \Log::info('Starting barcode generation for ticket ID: ' . $this->ticket->ticket_id);

            $filePath = public_path('storage/api/tickets/' . $this->ticket->ticket_id . '.png');
            if (!is_dir(dirname($filePath))) {
                mkdir(dirname($filePath), 0755, true);
                \Log::info('Directory created for barcode file: ' . dirname($filePath));
            }

            \Log::info('Generating barcode for ticket ID: ' . $this->ticket->ticket_id);
            \Milon\Barcode\Facades\DNS2DFacade::getBarcodePNGToFile($filePath, $this->url, 'QRCODE', 1, 1);

            \Log::info('Barcode successfully saved for ticket ID: ' . $this->ticket->ticket_id);
        } catch (\Exception $e) {
            \Log::error('Failed to generate barcode:', [
                'ticket_id' => $this->ticket->ticket_id,
                'error' => $e->getMessage(),
            ]);
        }
    }

}