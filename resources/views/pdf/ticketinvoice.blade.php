<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .event-details {
            text-align: center;
            margin-bottom: 20px;
        }
        .ticket-list {
            list-style-type: none;
            padding: 0;
        }
        .ticket-list li {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .ticket-list img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
        }
        .ticket-info {
            flex: 1;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        } 
    </style>
</head>
<body>
    <h1>Event Ticket</h1>
    <div class="event-details">
        <p>Thank you, {{ $order->first_name }} {{ $order->last_name }}!</p>
        <p>Your ticket for the event <strong>{{ $event->title }}</strong> is confirmed.</p>
        <p>Order ID: {{ (!empty($order->payment_id) ? $order->payment_id : $order->id) }}</p>
    </div>
    <h2>Ticket Details:</h2>
    <ul class="ticket-list">
        @foreach($tickets as $ticket)
            <li>
                <img src="{{ asset('storage/'.$ticket['icon']) }}" alt="{{ $ticket['name'] }} Ticket Image">
                <div class="ticket-info">
                    <strong>{{ $ticket['name'] }} ({{ $ticket['type'] }})</strong><br>
                    Quantity: {{ $ticket['quantity'] }}<br>
                    Price: ${{ $ticket['price'] }}
                </div>
            </li>
        @endforeach
    </ul>
    <div class="footer">
        <p>Thank you for your purchase! Enjoy the event.</p>
        <small>-Eversabz</small>
    </div>
</body>
</html>
