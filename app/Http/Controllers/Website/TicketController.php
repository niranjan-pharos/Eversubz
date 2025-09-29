<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\UserTicket;
use App\Models\TicketType;
use App\Models\OrderEvent;
use App\Models\OrderEventTicket;
use App\Models\OrderEventAttendee;
use App\Models\EventTicketType;
use App\Mail\TicketEmail;
use App\Mail\TicketConfirmationMailToVendor;
use App\Mail\TicketConfirmationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; 
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    
    public function purchaseTicket(Request $request, $encryptedEventId)
    {
        Log::info('Raw Request Data:', $request->all());

        try {
            $eventId = Crypt::decryptString($encryptedEventId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Event ID decryption failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Invalid event ID.'], 400);
        }

        $event = Event::with('ticketTypes')->findOrFail($eventId);
        $vendor = User::find($event->user_id);

        if (!$vendor || !$vendor->email) {
            Log::error('Vendor email not found for event ID: ' . $eventId);
            return response()->json(['status' => 'error', 'message' => 'Vendor email not found.'], 404);
        }

        // Validation (nonce is not required initially)
        $rules = [
            'guest_email' => 'nullable|string|email|max:255',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:25',
            'comments' => 'nullable|string',
            'tickets' => 'required|array|min:1',
            'tickets.*.id' => 'required|string',
            'tickets.*.quantity' => 'required|integer|min:1',
            'tickets.*.icon' => 'nullable|string',
            'tickets.*.attendees' => 'nullable|array',
            'tickets.*.attendees.*' => 'array',
            'nonce' => 'required_if:tickets.*.price,>,0|string',
        ];
        if (!auth()->check()) {
            $rules['guest_email'] = 'required|email|max:255';
        }
        try {
            $validatedData = $request->validate($rules);
            Log::info('Validated Data:', $validatedData);
        } catch (ValidationException $ex) {
            Log::error('Validation failed', [
                'errors' => $ex->errors(),
                'input' => $request->all()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $ex->errors()
            ], 422);
        }

        // Check if ALL tickets are free
        $isAllFree = true;
        foreach ($validatedData['tickets'] as $ticket) {
            $ticketId = Crypt::decryptString($ticket['id']);
            $ticketType = EventTicketType::findOrFail($ticketId);
            Log::info('Ticket type details:', ['id' => $ticketId, 'price' => $ticketType->price]);
            if ($ticketType->price > 0) {
                $isAllFree = false;
                break;
            }
        }

        // If not all free, require nonce (do this *after* initial validation, so error message is correct)
        if (!$isAllFree) {
            $request->validate(['nonce' => 'required|string']);
        }

        DB::beginTransaction();

        try {
            $userId = auth()->id();
            $guestEmail = $userId ? null : $validatedData['guest_email'];

            $orderEvent = OrderEvent::create([
                'event_id' => $eventId,
                'user_id' => $userId,
                'guest_email' => $guestEmail,
                'total_amount' => 0,
                'status' => 'pending',
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'] ?? null,
                'comments' => $validatedData['comments'] ?? null,
            ]);
            Log::info('OrderEvent created: ', $orderEvent->toArray());

            $uniqueOrderId = strtoupper(Str::random(5)) . $orderEvent->id;
            $orderEvent->update(['order_event_unique_id' => $uniqueOrderId]);

            $totalAmount = 0;
            $orderTickets = [];

            foreach ($validatedData['tickets'] as $ticket) {
                $ticketId = Crypt::decryptString($ticket['id']);
                $ticketType = EventTicketType::findOrFail($ticketId);
                $price = $ticketType->price;
                $categoryId = $ticketType['ticket_type_category'];

                // Check ticket availability
                if ($ticketType->max_quantity > 0) {
                    $available = $ticketType->max_quantity - $ticketType->sold_quantity;
                    if ($ticket['quantity'] > $available) {
                        Log::warning("Ticket over-purchase attempt: ticket_type_id {$ticketType->id}, requested {$ticket['quantity']}, available {$available}");
                        DB::rollBack();
                        return response()->json([
                            'status' => 'error',
                            'message' => "Only $available tickets are available for '{$ticketType->name}' ({$ticketType->ticket_type})."
                        ]);
                    }
                }

                $totalAmount += $ticket['quantity'] * $price;

                $ticketType->sold_quantity += $ticket['quantity'];
                $ticketType->save();
                Log::info("Updated sold_quantity for ticket_type_id {$ticketType->id}: now {$ticketType->sold_quantity}");

                $orderEventTicket = OrderEventTicket::create([
                    'order_event_id' => $orderEvent->id,
                    'event_id' => $ticketType['event_id'],
                    'ticket_type_id' => $ticketType->id,
                    'ticket_category_id' => $categoryId,
                    'ticket_name' => $ticketType->name,
                    'quantity' => $ticket['quantity'],
                    'price' => $price,
                    'ticket_type' => $ticketType->ticket_type,
                    'icon' => $ticketType->icon,
                    'hash' => Str::random(16),
                ]);
                Log::info('OrderEventTicket created: ', $orderEventTicket->toArray());

                $orderTickets[] = $orderEventTicket;

                if (!empty($ticket['attendees']) && is_array($ticket['attendees'])) {
                    foreach ($ticket['attendees'] as $attendee) {
                        if (!empty($attendee)) {
                            $attendeeRow = OrderEventAttendee::create([
                                'order_event_id' => $orderEvent->id,
                                'order_event_ticket_id' => $orderEventTicket->id,
                                'event_id' => $ticketType['event_id'], 
                                'ticket_type_id' => $ticketType->id,
                                'attendee_fields' => $attendee,
                            ]);
                            Log::info('OrderEventAttendee created: ', $attendeeRow->toArray());
                        }
                    }
                }
            }

            // Calculate booking fee for paid tickets
            $bookingFee = 0;
            foreach ($validatedData['tickets'] as $ticket) {
                $ticketId = Crypt::decryptString($ticket['id']);
                $ticketType = EventTicketType::findOrFail($ticketId);
                $price = $ticketType->price;
                $quantity = $ticket['quantity'];

                if ($price > 0) {
                    $bookingFee += $quantity * ($price * 0.025 + 0.50);
                }
            }
            $totalAmount += $bookingFee;

            // For free bookings, mark as completed and SKIP payment
            if ($isAllFree) {
                $orderEvent->update([
                    'total_amount' => $totalAmount,
                    'status' => 'completed',
                ]);

                DB::commit();

                $recipientEmail = $userId ? auth()->user()->email : $guestEmail;

                try {
                    Mail::to($recipientEmail)->send(new TicketConfirmationMail($orderEvent, $event, $orderTickets));
                    Mail::to($vendor->email)->send(new TicketConfirmationMailToVendor($orderEvent, $event, $orderTickets));
                } catch (\Exception $mailEx) {
                    Log::error('Mail sending error: ' . $mailEx->getMessage());
                }

                return response()->json([
                    'success' => true, 
                    'payment_id' => null,
                    'payment_url' => '',
                    'guest_email' => $guestEmail,
                    'order_event_unique_id' => $uniqueOrderId,
                    'encryptedOrderId' => Crypt::encryptString($orderEvent->id), 
                ]);
            }

            // PAID: Process payment via Square
            $orderEvent->update(['total_amount' => $totalAmount]);
            Log::info("Initiating Square payment. Amount: $totalAmount, Nonce: " . $validatedData['nonce']);
            $paymentResponse = $this->createSquarePayment($validatedData['nonce'], $totalAmount, $orderEvent->id);
            Log::info('Square payment response:', $paymentResponse);

            if ($paymentResponse['success']) {
                $orderEvent->update([
                    'payment_id' => $paymentResponse['payment_id'],
                    'payment_method' => $paymentResponse['payment_method'],
                    'receipt_number' => $paymentResponse['receipt_number'],
                    'receipt_url' => $paymentResponse['receipt_url'],
                    'card_fingerprint' => $paymentResponse['card_fingerprint'],
                    'card_last_four' => $paymentResponse['card_last_four'],
                    'status' => 'completed',
                ]);

                DB::commit();

                $recipientEmail = $userId ? auth()->user()->email : $guestEmail;

                try {
                    Mail::to($recipientEmail)->send(new TicketConfirmationMail($orderEvent, $event, $orderTickets));
                    Mail::to($vendor->email)->send(new TicketConfirmationMailToVendor($orderEvent, $event, $orderTickets));
                } catch (\Exception $mailEx) {
                    Log::error('Mail sending error: ' . $mailEx->getMessage());
                }

                return response()->json([
                    'success' => true, 
                    'payment_id' => $paymentResponse['payment_id'],
                    'payment_url' => '',
                    'guest_email' => $guestEmail,
                    'order_event_unique_id' => $uniqueOrderId,
                    'encryptedOrderId' => Crypt::encryptString($orderEvent->id), 
                ]);
                
            } else {
                Log::error('Payment failure: ' . $paymentResponse['message']);
                throw new \Exception($paymentResponse['message']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Exception in purchaseTicket: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function createSquarePayment($nonce, $totalAmount, $orderId)
    {
        try {
            $client = new \Square\SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment'),
            ]);
            Log::info('Square client initialized', ['environment' => config('services.square.environment')]);

            $money = new \Square\Models\Money();
            $money->setAmount((int) round($totalAmount * 100));
            $money->setCurrency('AUD');

            $paymentRequest = new \Square\Models\CreatePaymentRequest($nonce, uniqid());
            $paymentRequest->setAmountMoney($money);
            $paymentRequest->setReferenceId((string) $orderId);

            $paymentsApi = $client->getPaymentsApi();
            $response = $paymentsApi->createPayment($paymentRequest);

            if ($response->isSuccess()) {
                $payment = $response->getResult()->getPayment();

                $receiptUrl = $payment->getReceiptUrl();
                // if (config('services.square.environment') === 'sandbox') {
                //     $receiptUrl = str_replace('squareup.com', 'squareupsandbox.com', $receiptUrl);
                // }
                if (config('services.square.environment') === 'sandbox') {
                    $receiptUrl = str_replace('squareup.com', 'squareupsandbox.com', $receiptUrl);
                }
                
                

                $paymentMethod = $payment->getCardDetails()->getCard()->getCardBrand();

                return [
                    'success' => true,
                    'payment_id' => $payment->getId(),
                    'receipt_url' => $receiptUrl,
                    'payment_method' => $paymentMethod,
                    'receipt_number' => $payment->getReceiptNumber(),
                    'card_fingerprint' => $payment->getCardDetails()->getCard()->getFingerprint(),
                    'card_last_four' => $payment->getCardDetails()->getCard()->getLast4(),
                ];
            } else {
                $errors = $response->getErrors();

                return [
                    'success' => false,
                    'message' => $errors ? $errors[0]->getDetail() : 'Payment failed.',
                ];
            }
        } catch (\Square\Exceptions\ApiException $e) {
            Log::error('Square API error:', ['message' => $e->getMessage(), 'errors' => $e->getErrors()]);
            return [
                'success' => false,
                'message' => 'Square API error: ' . $e->getMessage(),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ];
        }
    }

    public function showSuccess($encryptedOrderId)
    {
        try {
            $orderId = Crypt::decryptString($encryptedOrderId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid Ticket');
        }

        $orderEvent = OrderEvent::with([
            'event',
            'orderTickets.ticketType',
            'orderTickets.attendees',
        ])->findOrFail($orderId);

        $user = auth()->user();

        if ($user) {
            $isBuyer = $orderEvent->user_id === $user->id;
            $isHost = $orderEvent->event && $orderEvent->event->user_id === $user->id;

            if (!($isBuyer || $isHost)) {
                abort(403, 'You are not authorized to view this ticket.');
            }
        }
        
        else {
            $guestEmail = request()->query('guest_email');

            if (!$guestEmail || $orderEvent->guest_email !== $guestEmail) {
                abort(403, 'You are not authorized to view this ticket.');
            }
        }

        Log::info('Ticket accessed successfully', [
            'order_event_id' => $orderEvent->id,
            'user_id' => $user ? $user->id : 'guest',
            'guest_email' => $user ? 'N/A' : $guestEmail,
        ]);

        return view('website.events.event-order-success', compact('orderEvent'));
    }




    public function verifyTicket($hash)
    {
        $ticket = \App\Models\OrderEventTicket::with(['order', 'event', 'attendees'])
                                            ->where('hash', $hash)
                                            ->first();

        if (!$ticket) {
            Log::warning("Ticket not found for hash: $hash");
            return view('website.events.invalid', ['message' => 'Ticket not found or invalid.']);
        }

        $event = $ticket->event;
        $now = now();

        Log::info("Verifying ticket for event: {$event->title}, ticket hash: $hash");

        $this->authorize('markAttendeePresent', $event);

        $from = $event->from_date_time ?? $event->event_date ?? null;
        $to   = $event->to_date_time ?? null;

        $fromDate = $from ? \Carbon\Carbon::parse($from) : null;
        $toDate = $to ? \Carbon\Carbon::parse($to) : null;

        $eventStatus = '';
        if ($fromDate && $toDate) {
            if ($now->lt($fromDate)) {
                $eventStatus = 'Event has not started yet.';
            } elseif ($now->between($fromDate, $toDate)) {
                $eventStatus = 'Event is ongoing.';
            } elseif ($now->gt($toDate)) {
                $eventStatus = 'Event has ended.';
            }
        } elseif ($fromDate) {
            $eventStatus = $now->lt($fromDate) ? 'Event has not started yet.' : 'Event date has passed.';
        } else {
            $eventStatus = 'Event date not available.';
        }

        if (auth()->check()) {
            $user = auth()->user();
            Log::info("Logged-in user access: {$user->id}");

            $isBuyer = $ticket->order->user_id === $user->id;
            $isHost = $ticket->order->event && $ticket->order->event->user_id === $user->id;

            Log::info("Is this user the buyer? " . ($isBuyer ? 'Yes' : 'No'));
            Log::info("Is this user the host? " . ($isHost ? 'Yes' : 'No'));

            if (!($isBuyer || $isHost)) {
                Log::warning("Unauthorized access attempt by user {$user->id}. Not the buyer or host.");
                abort(403, 'You are not authorized to view this ticket.');
            }
        } else {
            // Guest access handling
            $guestEmail = request()->query('guest_email');
            Log::info("Guest access attempt, guest_email: $guestEmail");

            if (!$guestEmail) {
                Log::warning("Guest email is missing for ticket hash: $hash");
                abort(403, 'Guest email is required to view this ticket.');
            }

            Log::info("Comparing guest_email: $guestEmail with orderEvent->guest_email: " . $ticket->order->guest_email);

            if ($ticket->order->guest_email !== $guestEmail) {
                Log::warning("Unauthorized guest access attempt. Provided guest email: $guestEmail does not match the order's guest email.");
                abort(403, 'You are not authorized to view this ticket.');
            }
        }

        $encryptedOrderId = Crypt::encryptString($ticket->order_event_id);

        Log::info('Ticket accessed successfully', [
            'order_event_id' => $ticket->order_event_id,
            'user_id' => auth()->user() ? auth()->user()->id : 'guest',
            'guest_email' => $guestEmail ?? 'N/A',
        ]);

        return view('website.events.valid-ticket', [
            'ticket' => $ticket,
            'attendees' => $ticket->attendees,
            'eventStatus' => $eventStatus,
            'from' => $fromDate,
            'to' => $toDate,
            'encryptedOrderId' => $encryptedOrderId,
        ]);
    }








    public function toggleAttendeePresence(Request $request)
    {
        $request->validate([
            'encrypted_attendee_id' => 'required',
            'is_present' => 'required|boolean',
        ]);

        try {
            $attendeeId = Crypt::decrypt($request->encrypted_attendee_id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['success' => false, 'message' => 'Invalid attendee ID.'], 400);
        }

        $attendee = \App\Models\OrderEventAttendee::with('orderEventTicket.event')->findOrFail($attendeeId);

        $event = $attendee->orderEventTicket->event;

        $this->authorize('markAttendeePresent', $event);

        $attendee->is_present = $request->is_present;
        $attendee->save();

        return response()->json([
            'success' => true,
            'is_present' => $attendee->is_present
        ]);
    }




    public function PaymentSuccess(Request $request)
    {
        // Retrieve payment details from query parameters
        $paymentId = $request->query('payment_id');
        $status = $request->query('status');

        // Validate if the payment ID exists in the database
        $orderEvent = OrderEvent::where('payment_id', $paymentId)
        ->with(['event', 'orderTickets.ticketType'])
        ->first();

        if (!$orderEvent) {
            return redirect()->route('home')->with('error', 'Invalid payment details.');
        }
        // Pass payment details to the view
        return view('website.events.success', [
            'payment_id' => $paymentId,
            'status' => ucfirst($status),
            'order' => $orderEvent,
        ]);
    } 

    public function paymentStatus(Request $request)
    {
        // Handle payment status and update ticket status accordingly
        $status = 'success'; // Example status, should be retrieved from payment gateway
        $userTicket = UserTicket::where('id', $request->ticket_id)->first();
        $userTicket->status = $status;
        $userTicket->save();

        return view('payment_status', ['status' => $status]);
    }

    public function show($encryptedEvent)
    {
        try {
            $eventId = Crypt::decryptString($encryptedEvent);
            $event = Event::findOrFail($eventId);
            $accountType = $event->charitable;
            
            
            $ticketTypes = $event->ticketTypes()->with('ticket_category')->get()->map(function ($ticket) use ($accountType) {
                // Add accountType to each ticket
                if ($ticket->ticket_category) {
                    $categoryName = $ticket->ticket_category->name;
                } else {
                    $categoryName = 'No Category';
                }
            
                $attendeeFields = json_decode($ticket->attendee_fields, true);
                return [
                    'id' => $ticket->id,
                    'name' => $ticket->name,
                    'ticket_type' => $ticket->ticket_type,
                    'category_name' => $categoryName, 
                    'price' => $ticket->price,
                    'is_free' => $ticket->is_free,
                    'max_quantity' => $ticket->max_quantity,
                    'sold_quantity' => $ticket->sold_quantity,
                    'children_price' => $ticket->children_price ?? 0,
                    'status' => $ticket->status,
                    'description' => $ticket->description,
                    'icon' => asset('storage/' . $ticket->icon),
                    'attendee_fields' => $attendeeFields,
                    'account_type' => $accountType, 
                ];
            });
            
            // Optionally encrypt the ticket ID
            $ticketTypes = $ticketTypes->map(function ($ticket) {
                $ticket['encrypted_id'] = Crypt::encryptString($ticket['id']);
                return $ticket;
            });

            

            $days = collect(CarbonPeriod::create($event->from_date_time, $event->to_date_time)->toArray());

            $formattedDays = $days->map(function ($day) {
                return $day->toDateString();
            });

            $userId = auth()->id();

            $order = OrderEvent::firstOrCreate(
                ['user_id' => $userId, 'event_id' => $event->id, 'status' => 'pending'],
                ['total' => 0]
            );

            $orderId = $order->id;

            return view('website.events.ticket-details', compact('event', 'ticketTypes', 'orderId', 'formattedDays'));

        } catch (DecryptException $e) {
            abort(404, 'Invalid event.');
        }
    }




    private function getTicketData(Request $request)
    {
        // Example logic to extract ticket data from the request
        return [
            ['type' => 'adult', 'quantity' => $request->input('adult_quantity')],
            ['type' => 'children', 'quantity' => $request->input('children_quantity')],
        ];
    } 


    public function viewticket()
    {
        return view('website.events.viewticket');
    }
 

    
    public function downloadTicket($order_event_unique_id)
    {
        if (ob_get_contents()) ob_end_clean();
        
        set_time_limit(300);
        ini_set('memory_limit', '256M');
        
        $order = OrderEvent::where('order_event_unique_id', $order_event_unique_id)
                            ->with('user', 'orderTickets', 'event')
                            ->first();
        
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        $user = $order->user;
        $event = $order->event ?? (object)['title' => 'Default Event Title'];
        $tickets = $order->orderTickets;

        $successUrl = route('event.success', [
            'encryptedOrderId' => \Crypt::encryptString($order->id),
            'guest_email' => $order->guest_email, 
        ]);

        $qrCode = base64_encode(
            QrCode::size(150) 
                ->margin(1) 
                ->errorCorrection('H') 
                ->generate($successUrl) 
        );

       $pdf = PDF::loadView('pdf.ticket', compact('order', 'user', 'event', 'tickets', 'qrCode'))
                    ->setPaper('a4', 'portrait');

        $filePath = storage_path('app/public/ticket_' . $order_event_unique_id . '.pdf');
        $pdf->save($filePath);

        $uniqueFileName = 'ticket_' . $order_event_unique_id . '.pdf';

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $uniqueFileName . '"'
        ]);
    }

     
    
    

    public function getTicketInfo($hash)
    {
        $ticket = OrderTicket::with(['order', 'order.event'])->where('hash', $hash)->first();

        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        $encryptedOrderId = Crypt::encryptString($ticket->order_event_id);
        $guestEmail = $ticket->order->guest_email;

        $successUrl = route('event.success', [
            'encryptedOrderId' => $encryptedOrderId,
            'guest_email' => $guestEmail,
        ]);

        $qrCode = new QrCode($successUrl);
        $qrCode->setSize(300);
        $writer = new PngWriter();
        $qrCodeDataUri = $writer->writeDataUri($qrCode);

        return response()->json([
            'ticket_id' => $ticket->ticket_id,
            'ticket_name' => $ticket->ticket_name,
            'quantity' => $ticket->quantity,
            'price' => $ticket->price,
            'event' => [
                'title' => $ticket->order->event->title,
                'date' => $ticket->order->event->from_date_time,
                'location' => $ticket->order->event->location,
            ],
            'qr_code' => $qrCodeDataUri,
        ]);
    }




}
