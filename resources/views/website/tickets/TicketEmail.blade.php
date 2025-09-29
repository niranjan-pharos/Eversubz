<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .ticket { border: 1px solid #000; padding: 10px; margin-bottom: 10px; }
        .ticket-header { text-align: center; font-size: 18px; font-weight: bold; }
        .ticket-body { margin-top: 10px; }
        .ticket-body div { margin-bottom: 5px; }
    </style>
</head>
<body>
    @foreach ($data['booking']['ticketItems'] as $ticket)
        <div class="ticket">
            <div class="ticket-header">{{ $event['title'] }}</div>
            <div class="ticket-body">
                <div><strong>Ticket ID:</strong> {{ $ticket['ticket_id'] }}</div>
                <div><strong>Event Date:</strong> {{ $event['from_date_time'] }} - {{ $event['to_date_time'] }}</div>
                <div><strong>Location:</strong> {{ $event['city'] }}, {{ $event['state'] }}</div>
                <div><strong>Attendee:</strong> {{ $booking['name'] }}</div>
            </div>
        </div>
    @endforeach
</body>
</html>