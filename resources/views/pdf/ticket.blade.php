<!DOCTYPE html>
<html>

<head>
    <title>Event - Tickets</title>
</head>

<body>
    @php
    use Carbon\Carbon;
    $fromDateTime = Carbon::parse($event->from_date_time);
    $toDateTime = Carbon::parse($event->to_date_time);
    $currentDateTime = Carbon::now();
    $eventDateTime = Carbon::parse($event->from_date_time);
    $isFutureEvent = $eventDateTime->isFuture();
    $countdownDate = $isFutureEvent ? $eventDateTime->format('Y-m-d\TH:i:sP') : null;
    @endphp

    <h1
        style="font-size: 24px; color: #333; text-align: right; border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px;">
        Event Ticket
    </h1>
    <div class="event-details" style="margin-bottom: 20px; font-size: 14px;">
        <div class="event-details2" style="padding-bottom: 10px; margin-bottom: 20px; border-bottom: 1px solid #ccc;">
            <p style="text-align: right; margin: 0px;">
                <strong style="font-weight: 600; color: #000;">Order Id: {{ $order->order_event_unique_id }}</strong>
            </p>
            <p style="text-align: right; color: #000; margin: 5px 0px; font-size: 14px;">
                <strong style="font-weight: 600;">Order Date: {{ $order->created_at }}</strong>
            </p>
        </div> 
        <div class="event-details2" style="padding-bottom: 10px; margin-bottom: 20px; border-bottom: 1px solid #ccc;">
            <p style="text-align: left; margin: 0px;">
                <strong style="font-weight: 600;">Receipt to:</strong>
                <br />
                @if(isset($guestEmail))
                    <p>Guest Email: {{ $guestEmail }}</p>
                @endif
                <br> {{ $order->first_name }} {{ $order->last_name }}!
            </p>
        </div>
        <div class="event-details3" style="margin-bottom: 20px;">
            <p style="font-size: 14px; text-align: left;">
                Thank you for your purchase for <strong><i>{{ $event->title ?? 'Event' }} - {{ $fromDateTime->format('j
                        M \A\T h:i A') }} –
                        {{ $toDateTime->format('j M \A\T h:i A') }}</i></strong>. <br>
                This receipt can be used as a tax invoice.
            </p>
        </div>

        <table class="ticket-table"
            style="box-shadow: 0px 0px 1px; width: 100%; border-collapse: collapse; font-size: 13px;">
            <thead>
                <tr>
                    <th
                        style="text-align: left; width: 100%; border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; font-weight: bold;">
                        Ticket Name & Type</th>
                    <th style="text-align: left; border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; font-weight: bold;">
                        Quantity</th>
                    <th style="text-align: left; width: 100px;border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; font-weight: bold;">Unit
                        Price</th>
                    <th style="text-align: left; width: 100px;border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; font-weight: bold;">Sub
                        Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotal = 0;
                    $bookingFee = 0;
                @endphp

                @foreach ($tickets as $ticket)
                    @php
                        $subTotal = $ticket['quantity'] * $ticket['price'];
                        $grandTotal += $subTotal;

                        if ($ticket['price'] > 0) {
                            $bookingFee += $ticket['quantity'] * ($ticket['price'] * 0.025 + 0.50);
                        }
                    @endphp

                @php
                    $totalAmount = $grandTotal + $bookingFee;
                @endphp

                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        {{ $ticket['ticket_name'] }} - {{ ucfirst($ticket['ticket_type']) }}
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $ticket['quantity'] }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">${{ number_format($ticket['price'], 2) }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">${{ number_format($subTotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @php
        $grandTotalWithFee = $grandTotal + $bookingFee; 
        @endphp
        <table class="ticket-table"
            style="box-shadow: 0px 0px 1px;margin-left: auto;border-collapse: collapse;border: 1px solid #ccc;font-size: 13px;margin-top: 20px;">
            <tbody>
                <tr>
                    <td style="width: 200px; border: 1px solid #ddd; padding: 8px;">Booking Fee</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">${{ number_format($bookingFee, 2) }}</td>
                </tr>
                <tr style="background-color: #f4f4f4;">
                    <td style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Grand Total:</td>
                    <td style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">${{
                        number_format($grandTotalWithFee, 2) }}</td>
                </tr>
            </tbody> 
        </table>
        @if(isset($qrCode) && !empty($qrCode))
        <h3>Scan QR Code for Ticket Info:</h3>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 150px; height: 150px;">
        @endif
    <p>Scan this QR code to retrieve ticket details.</p>
    </div>
    <div class="event-details4" style="margin-top: 30px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; padding: 20px 0px;">
    <table style="width: 100%; border: none;">
        <tr>
            <td style="text-align: left; width: 50%;">
                <h4 style="margin: 0px;">Ticketing by</h4>
                <img loading="eager" src="https://eversabz.com/assets/images/logo.png" alt="logo" width="200">
            </td>
            <td style="text-align: right; width: 50%;">
                <p style="margin: 3px 0px;">Eversabz</p>
                <p style="margin: 3px 0px;">5/556-598, Princes Highway</p>
                <p style="margin: 3px 0px;">Noble Park. 3174</p>
                <p style="margin: 3px 0px;">Noble Park, Melbourne</p>
                <p style="margin: 3px 0px;">North VIC 3174, Australia</p>
            </td>
        </tr>
    </table>
</div>
</body>

</html>