@extends('frontend.template.master')
@section('title', 'Event Ticket - Successful')
@section('description', 'Event Ticket Buying Successful - Eversubz')
@section('content')

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
.thank-you-actions a{margin-bottom: 75px;}
.alert-success h3 {
    font-size: 1.5rem;}
    .order-summary h3{font-size: 1.5rem;}
}
</style>


@php
use Carbon\Carbon;
$fromDateTime = Carbon::parse($order->event->from_date_time);
$toDateTime = Carbon::parse($order->event->to_date_time);
$currentDateTime = Carbon::now();
$eventDateTime = Carbon::parse($order->event->from_date_time);

// Determine if the event date is in the future
$isFutureEvent = $eventDateTime->isFuture();
$countdownDate = $isFutureEvent ? $eventDateTime->format('Y-m-d\TH:i:sP') : null;
@endphp

<section class="py-5 thank-you-section">
    <div class="container">
        <div class="alert alert-success">
            <h3><i class="fas fa-check-circle"></i> Payment Completed!</h3>
            <p>Thank you for your purchase, {{ $order->first_name }} {{ $order->last_name }}.</p>
        </div>

        <div class="order-summary">

            <h3>Order Details</h3>
            <ul class="">
                <li class="mb-2"><strong>Order ID:</strong> {{ $order->order_event_unique_id }}</li>
                <li class="mb-2"><strong>Payment ID:</strong> {{ $order->payment_id }}</li>
                <li class="mb-2"><strong>Status:</strong> <span class="badge badge-success">{{ $status }}</span>
                </li>
                <li class="mb-2"><strong>Event:</strong> {{ $order->event->title }}</li>
                <li class="mb-2"><strong>Event Date:</strong> {{ $fromDateTime->format('j M Y, H:i') }} -
                    {{ $toDateTime->format('j M Y, H:i') }}</li>
                <li class="mb-2"><strong>Event Location:</strong> {{ $order->event->location }},
                    {{ $order->event->city }}</li>
            </ul>

        </div>
        <div class="thank-you-actions">
            <p>Check your email for the receipt or visit your account dashboard for more information.</p> <a href="/">Go
                to Homepage</a>
        </div>


    </div>
</section>

@endsection