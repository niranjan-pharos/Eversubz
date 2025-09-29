@extends('frontend.template.master')
@section('title', "Ticket Order Details")

@section('content')
@include('frontend.template.usermenu')

<style>
    h3,
    h4 {
        margin-bottom: 20px;
        color: #007bff;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 1px;
    }

    section {
        padding: 30px 0;
    }

    .order-details {
        margin-bottom: 30px;
    }

    .order-details .card {
        border: none;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .card p {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .badge {
        color: #fff;
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .table th {
        background-color: #007bff;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
        padding: 10px;
    }
</style>

<section class="inner-section category-part myads-part">
    <div class="container">
        <div class="row">
            <div class="order-details">
                <h3>Ticket Order Details</h3>
                <div class="card">
                    <div class="card-header">
                        Order ID: {{ $order->id }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- Event Details -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Event Details</h5>
                                        <hr>
                                        <p><strong>Event Name:</strong> {{ $order->event->title ?? 'N/A' }}</p>
                                        <p><strong>Date:</strong>
                                            {{ $order->event->from_date_time . '- ' . $order->event->to_date_time ?? 'N/A' }}
                                        </p>
                                        <p><strong>Location:</strong>
                                            {{ $order->event->location . ', ' . $order->event->city . ', ' . $order->event->state . ', ' . $order->event->country ?? 'N/A' }}
                                        </p>


                                    </div>
                                </div>
                            </div>

                            <!-- User Details -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">User Details</h5>
                                        <hr>
                                        <p><strong>Full Name:</strong>
                                            {{ $order->first_name . ' ' . $order->last_name ?? $order->user->name ?? 'N/A' }}
                                        </p>

                                        <p><strong>Email:</strong>{{ $order->email ?? $order->user->email ??  'N/A'}}
                                        </p>
                                        <p><strong>Phone Number:</strong> {{ $order->user->phone_number ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Ticket Information -->
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <!-- Ticket Info: 60% width -->
                                            <div class="col-md-7 col-12">
                                                <h5 class="card-title">Ticket Information</h5>
                                                <hr>
                                                <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                                                <p><strong>Payment Status:</strong>
                                                    <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                                </p>
                                                <p><strong>Payment ID:</strong> {{ $order->payment_id }}</p>
                                                <a style="text-align: center;font-size:14px;text-decoration: none;display: flex;border: 1px solid;width: 200px;justify-content: center;margin: 10px auto;padding: 10px 20px;color: #ffffff;background: #2a6eb5;"
                                                    href="{{ route('downloadOrderPdf', ['order_event_unique_id' => $order->order_event_unique_id]) }}" target="_blank">
                                                    View & Download Ticket
                                                </a>
                                            </div>
                                            
                                            @if($order->orderTickets->count())
                                                @php
                                                    $ticket = $order->orderTickets->first();
                                                @endphp
                                                <div class="col-md-5 col-12 d-flex flex-column align-items-center justify-content-center">
                                                    {!! QrCode::size(140)->generate(route('ticket.verify', ['hash' => $ticket->hash])) !!}
                                                    <div class="mt-2 text-muted">{{ $ticket->ticket_name }}<br><strong>Quantity:</strong> {{ $ticket->quantity }}</div>
                                                </div>
                                                
                                            @endif

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>

                        <!-- Tickets -->
                        <h4>Tickets</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Icon </th>
                                        <th>Ticket Name</th>
                                        <th>Ticket Type</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderTickets as $ticket)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . $ticket->icon) }}" alt=""
                                                class="img-fluid rounded" style="width: 100px;" />
                                        </td>
                                        <td>
                                            {{ \Illuminate\Support\Str::limit($ticket->ticket_name, 30) }}
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($ticket->ticket_type, 30) }}</td>
                                        <td>{{ $ticket->quantity }}</td>
                                        <td>${{ number_format($ticket->price, 2) }}</td>
                                        <td>${{ number_format($ticket->price * $ticket->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                        
                                    @php
                                        $orderTotal = $order->orderTickets->sum(function ($ticket) {
                                            return $ticket->price * $ticket->quantity;
                                        });
                                        // Store fee calculation (2.5% + $0.50 per paid ticket, for each quantity)
                                        $storeFee = $order->orderTickets->sum(function ($ticket) {
                                            if ($ticket->price > 0) {
                                                return $ticket->quantity * ($ticket->price * 0.025 + 0.50);
                                            }
                                            return 0;
                                        });
                                        $grandTotal = $orderTotal + $storeFee;
                                    @endphp

                        
                                    {{-- Subtotal Row --}}
                                    <tr>
                                        <td colspan="5" class="text-right font-weight-bold">Subtotal:</td>
                                        <td>${{ number_format($orderTotal, 2) }}</td>
                                    </tr>
                                    {{-- Store Fee Row --}}
                                    <tr>
                                        <td colspan="5" class="text-right font-weight-bold">Store Fee:</td>
                                        <td>${{ number_format($storeFee, 2) }}</td>
                                    </tr>
                                    {{-- Total Amount Row --}}
                                    <tr>
                                        <td colspan="5" class="text-right font-weight-bold">Total Amount:</td>
                                        <td><strong>${{ number_format($grandTotal, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection