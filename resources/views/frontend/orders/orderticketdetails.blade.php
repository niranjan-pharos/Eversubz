@extends('frontend.template.master')
@section('title', "Order Details")

@section('content')
@include('frontend.template.usermenu')
<style>
    .order-details .card {
    margin-top: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.order-details h4 {
    margin-bottom: 10px;
    font-size: 24px;
}
.order-details p {
    margin: 5px 0;
}

</style>
<section class="inner-section order-details">
    <div class="container">
        <h2>Order Details</h2>

        <div class="card">
            <div class="card-body">
                <h4>Event: {{ $order->event->title }}</h4>
                <p><strong>Host:</strong> {{ $order->event->host_name }}</p>
                <p><strong>Date:</strong> 
                    {{ \Carbon\Carbon::parse($order->event->from_date_time)->format('d M Y, H:i') }} -
                    {{ \Carbon\Carbon::parse($order->event->to_date_time)->format('d M Y, H:i') }}
                </p>
                <p><strong>Location:</strong> {{ $order->event->location }}, {{ $order->event->city }},
                    {{ $order->event->state }}, {{ $order->event->country }}</p>

                <h5>Buyer Information:</h5>
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>

                <h5>Tickets:</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ticket Name</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderEventTickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_name }}</td>
                            <td>{{ $ticket->ticket_type }}</td>
                            <td>{{ $ticket->quantity }}</td>
                            <td>${{ number_format($ticket->price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5>Total Amount:</h5>
                <p>${{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
