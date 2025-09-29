<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTicket;
use App\Models\TicketType;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\website\CouponController;
use Square\SquareClient;
use Square\Environment;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Exceptions\ApiException;
use Square\Models\CreateCheckoutRequest;
use Square\Models\CreateOrderRequest;
use Square\Models\OrderLineItem;
use Square\Models\Order as SquareOrder;
use Square\Models\CreatePaymentLinkRequest;
use Square\Models\CheckoutOptions;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\TicketConfirmationMail;
use App\Mail\TicketConfirmationMailToVendor;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessful;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use DNS1D;
use DNS2D;
use Milon\Barcode\Facades\DNS2DFacade;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        
        DB::beginTransaction();
        try {
            // Validate the request
            $request->validate([
                'event_id' => 'required|exists:events,id',
                'tickets' => 'required|array',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:50',
                'comments' => 'nullable|string',
                'payment_method' => 'required|string|max:50'
            ]);

            $totalAmount = 0;
            $ticketsData = [];

            foreach ($request->tickets as $ticket) {
                \Log::info('Searching for TicketType ID: ' . $ticket['id']);

                $ticketType = TicketType::find($ticket['id']);

                if (!$ticketType) {
                    throw new \Exception('TicketType with ID ' . $ticket['id'] . ' not found.');
                }

                $quantity = $ticket['quantity'];
                $price = $ticket['type'] === 'adult' ? $ticketType->adult_price : $ticketType->children_price;
                $totalPrice = $price * $quantity;
                $totalAmount += $totalPrice;

                $ticketsData[] = [
                    'ticket_type_id' => $ticketType->id,
                    'quantity' => $quantity,
                    'price' => $price
                ];
            }

            // Apply discount if applicable using the CouponController
            $discount = 0;
            if ($request->has('coupon_code')) {
                $couponRequest = new Request([
                    'coupon' => $request->coupon_code,
                    'module' => 'event'
                ]);

                $couponController = new CouponController();
                $response = $couponController->validateCoupon($couponRequest);

                $responseData = $response->getData();

                if (isset($responseData->valid) && $responseData->valid) {
                    $discount = $responseData->discount;
                } else {
                    return response()->json(['error' => 'Invalid coupon code.'], 400);
                }
            }

            // Create the order with an initial status of 'pending'
            $order = Order::create([
                'event_id' => $request->event_id,
                'total_amount' => $totalAmount - $discount,
                'status' => 'pending',
                'coupon_code' => $request->coupon_code,
                'discount' => $discount,
                'payment_method' => $request->payment_method,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'comments' => $request->comments,
                'type' => 'Event',
            ]);

            foreach ($ticketsData as $ticketData) {
                $ticketData['order_id'] = $order->id;
                OrderTicket::create([
                    'order_id' => $ticketData['order_id'],
                    'ticket_type_id' => $ticketData['ticket_type_id'],
                    'quantity' => $ticketData['quantity'],
                    'price' => $ticketData['price'],
                ]);
            }

            DB::commit();

            return response()->json(['order_id' => $order->id, 'message' => 'Order created successfully. Proceed to payment.'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function processPayment(Request $request)
    {
        $client = new SquareClient([
            'accessToken' => config('services.square.access_token'),
            'environment' => config('services.square.environment'),
        ]);

        \Log::info('Square Client Configuration', [
            'accessToken' => config('services.square.access_token'),
            'environment' => config('services.square.environment'),
        ]);

        $paymentsApi = $client->getPaymentsApi();

        $nonce = $request->input('nonce');
        $amount = $request->input('amount_money.amount');
        $currency = $request->input('amount_money.currency');
        $orderId = $request->input('order_id');
        $idempotencyKey = uniqid();

        $amountMoney = new Money();
        $amountMoney->setAmount((int)$amount);
        $amountMoney->setCurrency($currency);

        $paymentRequest = new CreatePaymentRequest(
            $nonce,
            $idempotencyKey
        );

        $paymentRequest->setAmountMoney($amountMoney);
        $paymentRequest->setNote('Event Ticket Purchase for Order #' . $orderId);

        try {
            DB::beginTransaction();

            $paymentResponse = $paymentsApi->createPayment($paymentRequest);

            if ($paymentResponse->isSuccess()) {
                $payment = $paymentResponse->getResult()->getPayment();
                $paymentId = $payment->getId();

                $order = Order::find($orderId);
                if ($order) {
                    $order->status = 'completed';
                    $order->payment_id = $paymentId;
                    $order->save();

                    $event = Event::find($order->event_id);
                    $tickets = $order->orderTickets()->with('ticketType')->get();

                    $ticketDetails = [];
                    foreach ($tickets as $ticket) {
                        $ticketType = $ticket->ticketType;

                        if ($ticketType) {
                            $type = 'unknown';
                            if ($ticket->price == $ticketType->adult_price) {
                                $type = 'adult';
                            } elseif ($ticket->price == $ticketType->children_price) {
                                $type = 'children';
                            }

                            $ticketDetails[] = [
                                'name' => $ticketType->name,
                                'quantity' => $ticket->quantity,
                                'price' => $ticket->price,
                                'type' => $type,
                                'icon' => $ticketType->icon,
                            ];
                        } else {
                            \Log::warning("TicketType not found for order ticket ID: {$ticket->id}");
                        }
                    }

                    Mail::to($order->email)->send(new TicketConfirmationMail($order, $event, $ticketDetails));
                    Mail::to($order->email)->send(new TicketConfirmationMailToVendor($order, $event, $ticketDetails));
                }

                DB::commit();

                return response()->json(['success' => true, 'orderId'=>$orderId,'message' => 'Payment processed successfully!']);
            } else {
                DB::rollBack();
                $errors = $paymentResponse->getErrors();
                return response()->json(['success' => false, 'message' => 'Payment failed.', 'errors' => $errors]);
            }
        } catch (ApiException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred during payment.', 'error' => $e->getMessage()]);
        }
    }

    public function redirectToSquareCheckout(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'nullable|string',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'comments' => 'nullable',
            'tickets' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $eventId = decrypt($validatedData['event_id']);
            $userId = auth()->check() ? auth()->id() : null;

            // Create order in the database
            $order = new Order();
            $order->user_id = $userId;
            $order->event_id = $eventId;
            $order->first_name = $validatedData['first_name'];
            $order->last_name = $validatedData['last_name'];
            $order->email = $validatedData['email'];
            $order->comments = $validatedData['comments'];
            $order->phone = $validatedData['phone'];
            $order->status = 'pending';
            $order->currency = 'AUD';
            $order->type = 'event';
            $order->total_amount = 0;
            $order->save();

            $totalAmount = 0;
            $lineItems = [];

            foreach ($validatedData['tickets'] as $ticket) {
                $ticketId = decrypt($ticket['id']);
                $ticketType = TicketType::find($ticketId);

                if (!$ticketType) {
                    \Log::error('Invalid ticket ID after decryption:', ['ticket' => $ticket]);
                    continue;
                }

                $price = $ticket['type'] === 'adult' ? $ticketType->adult_price : $ticketType->children_price;

                $totalAmount += $price * $ticket['quantity'];

                // Save tickets in the database
                $orderTicket = new OrderTicket();
                $orderTicket->order_id = $order->id;
                $orderTicket->ticket_type_id = $ticketType->id;
                $orderTicket->ticket_name = $ticketType->name;
                $orderTicket->icon = $ticketType->icon;
                $orderTicket->quantity = $ticket['quantity'];
                $orderTicket->price = $price * $ticket['quantity'];
                $orderTicket->save();

                $lineItems[] = [
                    'name' => $ticketType->name . ' (' . ucfirst($ticket['type']) . ')',
                    'quantity' => (string)$ticket['quantity'],
                    'base_price_money' => [
                        'amount' => (int)($price * 100),
                        'currency' => 'AUD',
                    ],
                    'note' => 'Ticket purchase for event',
                ];
            }

            if (empty($lineItems)) {
                throw new \Exception('No valid tickets found to process payment.');
            }

            // Update total amount in order
            $order->total_amount = $totalAmount;
            $order->save();

            // Create Square Order and Payment Link
            $httpClient = new \GuzzleHttp\Client();
            $response = $httpClient->post('https://connect.squareupsandbox.com/v2/online-checkout/payment-links', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.square.access_token'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'idempotency_key' => uniqid(),
                    'order' => [
                        'location_id' => config('services.square.location_id'),
                        'line_items' => $lineItems,
                    ],
                    'checkout_options' => [
                        'redirect_url' => route('payment.success', ['order_id' => $order->id]),
                        'cancel_url' => route('payment.cancel', ['order_id' => $order->id]),
                    ],
                ],
            ]);

            $responseBody = json_decode($response->getBody(), true);

            if (isset($responseBody['payment_link']['url'])) {
                DB::commit();
                return response()->json(['success' => true, 'redirect_url' => $responseBody['payment_link']['url']]);
            }

            throw new \Exception('Failed to create payment link.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in redirectToSquareCheckout:', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }



    public function paymentCancel(Request $request)
    {
        try {
            $orderId = $request->query('order_id');

            if (!$orderId) {
                \Log::warning('Payment cancellation attempted without order ID.');
                return redirect()->route('home')->withErrors(['message' => 'No order found to cancel.']);
            }

            $order = Order::find($orderId);

            if (!$order) {
                \Log::warning('Order not found for cancellation.', ['orderId' => $orderId]);
                return redirect()->route('home')->withErrors(['message' => 'Order not found.']);
            }

            $order->status = 'cancelled';
            $order->save();

            return redirect()->route('home')->with('info', 'Your payment was cancelled successfully.');
        } catch (\Exception $e) {
            \Log::error('Error in paymentCancel:', ['exception' => $e->getMessage()]);
            return redirect()->route('home')->withErrors(['message' => 'An error occurred while cancelling your payment.']);
        }
    }


    public function paymentSuccess(Request $request)
    {
        try {
            $orderId = $request->query('order_id');
            $transactionId = $request->query('transactionId');

            if (!$orderId || !$transactionId) {
                \Log::error('Payment callback missing required parameters.', $request->all());
                return redirect()->route('home')->withErrors(['message' => 'Invalid payment callback.']);
            }

            $order = Order::find($orderId);

            if (!$order) {
                \Log::error('Order not found for payment callback', ['orderId' => $orderId]);
                return redirect()->route('home')->withErrors(['message' => 'Order not found.']);
            }

            // Retrieve payment details from Square
            $client = new \Square\SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment'),
            ]);

            $paymentsApi = $client->getPaymentsApi();
            $response = $paymentsApi->getPayment($transactionId);

            if ($response->isSuccess()) {
                $payment = $response->getResult()->getPayment();

                $order->payment_id = $payment->getId();
                $order->payment_method = $payment->getCardDetails()->getCard()->getBrand();
                $order->receipt_number = $payment->getReceiptNumber();
                $order->receipt_url = $payment->getReceiptUrl();
                $order->status = 'completed';
                $order->save();

                return redirect()->route('website.payment-success', ['order_id' => $orderId])
                    ->with('success', 'Your payment was processed successfully!');
            }

            \Log::error('Failed to retrieve payment details from Square.', $response->getErrors());
            return redirect()->route('home')->withErrors(['message' => 'Failed to process payment.']);
        } catch (\Exception $e) {
            \Log::error('Error in paymentSuccess:', ['exception' => $e->getMessage()]);
            return redirect()->route('home')->withErrors(['message' => 'An error occurred while processing your payment.']);
        }
    }

 


    
    public function cartPayment(Request $request)
    {
        $request->validate([
            'nonce' => 'required|string',
            'amount_money.amount' => 'required|numeric|min:1',
            'amount_money.currency' => 'required|string|in:AUD',
            'amount_money.type' => 'required|string|in:event',
            'orderData.first_name' => 'required|string|max:50',
            'orderData.last_name' => 'required|string|max:50',
            'orderData.email' => 'required|email|max:255',
            'orderData.tickets' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Authentication and Order Details
            $userId = auth()->id();
            $email = auth()->user()->email ?? $request->input('orderData.email');
            $tickets = $request->input('orderData.tickets');

            if (!$email || empty($tickets)) {
                throw new \Exception('Email or tickets missing.');
            }

            // Process Payment
            $squareClient = new SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment'),
            ]);

            $paymentRequest = new CreatePaymentRequest(
                $request->input('nonce'),
                uniqid(),
                new Money([
                    'amount' => $request->input('amount_money.amount') * 100,
                    'currency' => $request->input('amount_money.currency'),
                ])
            );

            $paymentResponse = $squareClient->getPaymentsApi()->createPayment($paymentRequest);

            if (!$paymentResponse->isSuccess()) {
                throw new \Exception('Square payment failed.');
            }

            // Save Order
            $order = new Order([
                'user_id' => $userId,
                'event_id' => $request->input('orderData.event_id'),
                'email' => $email,
                'total_amount' => $request->input('amount_money.amount'),
                'currency' => $request->input('amount_money.currency'),
            ]);
            $order->save();

            DB::commit();

            return response()->json(['success' => true, 'orderId' => $order->id, 'message' => 'Payment successful!']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Payment Error:', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Payment failed. Please try again.'], 500);
        }
    }


    public function getEventTicketListing()
    {
        $user = Auth::user();
        $userId = Auth::id();

        $orderTickets = OrderTicket::with(['order', 'order.event', 'ticketType'])
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('status', 'completed')
                    ->where('user_id', $userId); 
            })
            ->get()
            ->map(function ($orderTicket) {
                $ticketType = $orderTicket->ticketType;
                $order = $orderTicket->order;
                $event = $order->event;

                return [
                    'order_id' => $order->id,
                    'event_id' => $event->id,
                    'event_title' => $event->title, 
                    'event_date' => $event->date,
                    'event_time' => $event->time,
                    'event_location' => $event->location,
                    'quantity' => $orderTicket->quantity,
                    'price' => $orderTicket->price,
                    'ticket_name' => $ticketType->name,
                    'adult_price' => $ticketType->adult_price,
                    'children_price' => $ticketType->children_price,
                    'icon' => $ticketType->icon,
                    'ticket_type' => $this->determineTicketType($orderTicket->price, $ticketType),
                ];
            });

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0;

        return view('frontend.orders.sold_event_tickets', compact('orderTickets', 'is_approved'));
    }



    private function determineTicketType($price, $ticketType)
    {
        if ($price == $ticketType->adult_price) {
            return 'adult';
        } elseif ($price == $ticketType->children_price) {
            return 'children';
        }

        return 'unknown';
    }



}