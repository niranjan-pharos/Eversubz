<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
</head>
<body>

    <h2>🎟️ Ticket Details</h2>

    <p><strong>Order ID:</strong> {{ $order->order_event_unique_id }}</p>
    <p><strong>User Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
    <p><strong>Event Name:</strong> {{ $order->event->title }}</p>
    <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($order->event->from_date_time)->format('F j, Y - h:i A') }}</p>

    <h3>🎫 Tickets</h3>
    <ul>
        @foreach ($order->orderTickets as $ticket)
            <li>{{ $ticket->quantity }}x {{ $ticket->ticket_name }} ({{ ucfirst($ticket->ticket_type) }}) - ${{ number_format($ticket->price, 2) }}</li>
        @endforeach
    </ul>

</body>
</html>
