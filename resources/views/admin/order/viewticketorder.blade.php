@extends('admin.template.master')

@section('content')
<div class="order-details container">
    <h3 class="text-center mb-4">Order Details</h3>
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <strong>Order ID: {{ $order->id }}</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Event Details -->
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">


                            <h5 class=""><i class="fas fa-calendar-alt"></i> Event Details</h5>
                            <hr>
                            <p><strong>Title:</strong> {{ $order->event->title }}</p>
                            <p><strong>Date:</strong>
                                {{ \Carbon\Carbon::parse($order->event->from_date_time)->format('D jS M Y, g:i a') }} -
                                {{ \Carbon\Carbon::parse($order->event->to_date_time)->format('D jS M Y, g:i a') }}
                            </p>
                            <p><strong>Location:</strong>
                                {{ ($order->event->location) }}, {{ ($order->event->city) }},
                                {{ ($order->event->state) }},
                                {{ ($order->event->country) }} </p>
                        </div>
                    </div>
                </div>

                <!-- User Details -->
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class=""><i class="fas fa-user"></i> User Details</h5>
                            <hr>
                            <p><strong>Name:</strong> {{ $order->first_name ?? $order->user->name ??  'N/A'}} </p>
                            <p><strong>Email:</strong> {{ $order->email ?? $order->user->email ??  'N/A'}} </p>
                            <p><strong>Phone:</strong> {{ $order->phone ?? $order->user->phone ??  'N/A'}} </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class=""><i class="fas fa-info-circle"></i> Order Information</h5>
                            <hr>
                            <p><strong>Comments:</strong> {{ ($order->comments) }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                            <p><strong>Order Date:</strong>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('D jS M Y, g:i a') }}</p>
                            <p><strong>Total Amount:</strong> <span
                                    class="">${{ number_format($order->total_amount, 2) }}</span>
                            <p><strong>Payment ID:</strong> <span class="">{{ ($order->payment_id) }}</span>
                            </p>
                          
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 class=""><i class="fas fa-ticket-alt"></i> Order Tickets</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Ticket Image</th>
                                    <th>Ticket Name</th>
                                    <th>Ticket Type</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderTickets as $ticket)
                                <tr>
                                    <td>
                                        <a target="_blank" href="{{ asset('storage/' . $ticket->icon) }}">
                                            <img src="{{ asset('storage/' . $ticket->icon) }}" alt="{{ $ticket->name }}"
                                                class="img-fluid rounded" style="max-width: 100px;">
                                        </a>
                                    </td>
                                    <td>{{ $ticket->ticket_name ?? 'N/A' }}</td>
                                    <td>{{ $ticket->ticket_type ?? 'N/A' }}</td>
                                    <td>${{ number_format($ticket->price, 2) }}</td>
                                    <td>{{ $ticket->quantity }}</td>
                                    <td>${{ number_format($ticket->quantity * $ticket->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
.order-details {
    background: #f8f9fa;
    border-radius: 10px;
    font-family: Arial, sans-serif;
}

.card-header {

    background-color: #007bff !important;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    padding: 15px;
}

.card-body {
    padding: 20px;
}

.card p {
    display: flex;
    color: #000;
    justify-content: space-between;
    margin-bottom: 5px;
    text-align: end;
}

.card h5 {
    color: #000;
    text-transform: uppercase;
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 20px;
}

h3,
h5 {
    font-weight: bold;
}

h5 i {
    margin-right: 10px;
    color: #007bff;
}

.table {
    border-collapse: collapse;
    background: white;
}

.card-body .card {
    height: 250px;
}

.order-details .card {
    border: none;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
    padding: 12px 15px;
    vertical-align: middle;
    text-align: left;
    border: 1px solid #ddd;
}

.table th {
    font-weight: bold;
    background-color: #007bff;
}

.table tbody tr:hover {
    background: #f1f1f1;
}



.text-success {
    color: #28a745 !important;
}

img.img-fluid {
    max-height: 80px;
    object-fit: cover;
    border: 1px solid #ddd;
    padding: 5px;
    background: #f9f9f9;
}
</style>
@endsection