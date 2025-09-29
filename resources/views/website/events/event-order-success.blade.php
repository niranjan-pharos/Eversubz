@extends('frontend.template.master')
@section('title', 'Event Ticket - Successful')
@section('description', 'Event Ticket Buying Successful - Eversubz')
@section('content')
@php use SimpleSoftwareIO\QrCode\Facades\QrCode; @endphp
<style>



    .alert-success {
        background: transparent;
        color: #fff;
        text-align: center;
    }
    .alert-success h3 {
        font-size: 2.5rem;
        font-weight: 800;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 2;
        position: relative;
    }
    .alert-success p {
        font-size: 1.3rem;
        margin-top: 10px;
        z-index: 2;
        position: relative;
    }
    .order-summary {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        margin: 30px auto;
        color: #333;
        max-width: 800px;
        z-index: 2;
        position: relative;
    }

    .order-summary h3 {
        font-size: 2rem;
        color: #4caf50;
        margin-bottom: 20px;
        text-align: center;
    }

    .order-summary ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .order-summary li {
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 10px;
    }

    .badge-success {
        background: linear-gradient(135deg, #28a745, #218838);
        color: #fff;
        padding: 6px 12px;
        font-size: 1rem;
        border-radius: 20px;
    }



    .thank-you-section {
        background: linear-gradient(135deg, #4caf50, #81c784);
        padding: 100px 20px;
        color: #fff;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .thank-you-section::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -150px;
        background: rgba(255, 255, 255, 0.1);
        width: 400px;
        height: 400px;
        border-radius: 50%;
        z-index: 1;
        animation: pulse 8s infinite ease-in-out;
    }

    .thank-you-section::after {
        content: "";
        position: absolute;
        bottom: -150px;
        left: -150px;
        background: rgba(255, 255, 255, 0.1);
        width: 400px;
        height: 400px;
        border-radius: 50%;
        z-index: 1;
        animation: pulse 10s infinite ease-in-out;
    }
    .thank-you-actions a {
        background: linear-gradient(135deg, #4caf50, #81c784);
        color: #fff;
        padding: 15px 40px;
        border-radius: 30px;
        font-size: 1.2rem;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: transform 0.3s ease, background 0.3s ease;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }.thank-you-actions a:hover {
        transform: scale(1.1);
        background: linear-gradient(135deg, #388e3c, #66bb6a);
    }

    @media only screen and (max-width: 767px){
        
    .order-summary li {
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 10px;    display: inline-block;
        max-width: 100%;
        word-wrap: break-word;
    }

    .mobileadjustqr{
        margin-left: 70px;
    }
    .thank-you-actions a{margin-bottom: 75px;}
    .alert-success h3 {
        font-size: 1.5rem;}
        .order-summary h3{font-size: 1.5rem;}
    }


    @media print {
        body * {
            visibility: hidden !important;
        }
        .thank-you-section, .thank-you-section * {
            visibility: visible !important;
        }
        .thank-you-section {
            position: absolute !important;
            left: 0; top: 0; width: 100%;
            background: white !important;
            color: #222 !important;
            z-index: 9999 !important;
            box-shadow: none !important;
        }
        .btn, .thank-you-actions, .alert, .text-right, .mt-2, .mb-3.text-right, .btn-outline-secondary {
            display: none !important;
        }
        
        .order-summary > .border {
            page-break-inside: avoid;
        }
        a[href]:after {
            content: "";
        }
    }
</style>


@php
use Carbon\Carbon;
$event = $orderEvent->event;
@endphp

<section class="py-5 thank-you-section">
    <div class="container">
        <div class="mb-3 text-right">
            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="fas fa-print"></i> Print Ticket(s)
            </button>
        </div>
        
        <div class="alert alert-success">
            <h3><i class="fas fa-check-circle"></i> Payment Completed!</h3>
            <p>Thank you for your purchase, {{ $orderEvent->first_name }} {{ $orderEvent->last_name }}.</p>
        </div>
        
        <div class="order-summary">
            <h3>Event Order Details</h3>
            <ul>
                <li><strong>Order Number:</strong> {{ $orderEvent->order_event_unique_id }}</li>
                <li><strong>Event:</strong> {{ $event->title ?? '' }}</li>
                <li><strong>Event Location:</strong> {{ $event->location }}, {{ $event->city }}</li>
                <li>
                    <strong>Date:</strong>
                    @if($event->from_date_time && $event->to_date_time)
                        {{ \Carbon\Carbon::parse($event->from_date_time)->format('d F Y') }}
                        –
                        {{ \Carbon\Carbon::parse($event->to_date_time)->format('d F Y') }}
                    @elseif($event->from_date_time)
                        {{ \Carbon\Carbon::parse($event->from_date_time)->format('d F Y') }}
                    @endif
                </li>                                
                <li><strong>Name:</strong> {{ $orderEvent->first_name }} {{ $orderEvent->last_name }}</li>
                <li><strong>Email:</strong> {{ $orderEvent->email }}</li>
            </ul>
            <hr>
            <h4>Your Tickets</h4>
            @foreach($orderEvent->orderTickets as $ticket)
            
                <div class="border rounded mb-4 p-3 bg-light">
                    <div class="row align-items-center">
                        <div class="col-auto pr-0">
                            <img src="{{ $ticket->icon 
                                ? asset('storage/' . $ticket->icon) 
                                : ($ticket->ticketType && $ticket->ticketType->icon 
                                    ? asset('storage/' . $ticket->ticketType->icon) 
                                    : asset('storage/no-image.jpg')) 
                                }}" 
                                alt="{{ $ticket->ticket_name }}" 
                                style="width:50px;height:50px;object-fit:cover;" 
                                class="rounded">
                        </div>
                        <div class="col d-flex flex-column">
                            <span class="font-weight-bold" style="font-size: 1.2rem;">
                                {{ $orderEvent->event->title ?? '' }}
                            </span>
                            <span>
                                <b>{{ $ticket->ticket_name }}</b>
                                <span class="text-muted">{{ !empty($ticket->ticket_type) ? ucfirst($ticket->ticket_type) : '' }}</span>
                            </span>
                            <span>Qty: <b>{{ $ticket->quantity }}</b> @ <b>{{ config('constants.CURRENCY_SYMBOL') . number_format($ticket->price, 2) }}</b></span>
                        </div>
                        <div class="col-auto text-right mobileadjustqr">
                            {!! QrCode::size(100)->generate(route('ticket.verify', ['hash' => $ticket->hash])) !!}
                        </div>
                        
                    </div>
                    @if($ticket->attendees && $ticket->attendees->count())
                    <div class="mt-3">
                        <div class="font-weight-bold mb-2">Attendees:</div>
                        @foreach($ticket->attendees as $i => $attendee)
                            @if(!empty($attendee->attendee_fields))
                                <div class="border rounded p-3 mb-2 bg-white w-100">
                                    <div class="row">
                                        @foreach($attendee->attendee_fields as $field => $value)
                                            <div class="col-md-4 mb-2">
                                                <span class="font-weight-bold">{{ ucfirst(str_replace('_',' ',$field)) }}:</span>
                                                {{ $value }}
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="mt-2">
                                        @if($attendee->is_present)
                                            <span class="badge badge-success">Attendee Present</span>
                                        @else
                                            <span class="badge badge-secondary">Attendee Not Present</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif


                </div>
            @endforeach

            <div class="mt-4">
                <strong>Total Paid: {{ config('constants.CURRENCY_SYMBOL') . number_format($orderEvent->total_amount, 2) }}</strong>
            </div>
            @if($orderEvent->receipt_url)
                <div class="mt-2">
                    <a href="{{ $orderEvent->receipt_url }}" target="_blank" class="btn btn-primary btn-sm">View Payment Receipt</a>
                </div>
            @endif
        </div>
        <div class="thank-you-actions">
            <p>Check your email for the receipt or visit your account dashboard for more information.</p>
            <a href="/">Go to Homepage</a>
        </div>
    </div>
</section>

@endsection