@php
    use Milon\Barcode\Facades\DNS2DFacade;
@endphp
<table class="body-wrap" style="width:97% !important;margin:0 auto;height:100%;background-color:#efefef;">
    <tr>
        <td class="container"
            style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
            <!-- Message start -->
            <table style="width:100% !important; border-collapse:collapse;">
                <tr>
                    <td class="masthead" style="text-align:center; padding:40px 0 30px; background-color: #0071c1; color: white; border-radius: 10px 10px 0 0;">
                        <img class="email-logo" src="{{ asset('assets/images/logo.png') }}" alt="logo" style="width: 100px; background: #fff; border-radius: 10px; padding: 5px;">
                        <h1 style="line-height: 1.25; font-size: 32px; margin: 0;">Order Confirmation - Eversabz</h1>
                    </td>
                </tr>
                <tr>
                    <td class="content" style="background-color:white; padding:20px;">
                        <h2 style="margin: 0 0 0.5rem 0; line-height: 1.25; color: #333E48; font-size: 2rem; font-weight: 500;">
                            Hello, {{ $username }}!
                        </h2>
                        <p>Thank you for your order! Below are the details of your purchase.</p>
            
                        @if($order->type === 'event')
                            @php
                                $event = \App\Models\Event::find($order->event_id);
                            @endphp
            
                            @if($event)
                                <p>
                                    <img src="{{ url('storage/' . $event->main_image) }}" alt="Event Main Image" style="width:100%; max-width: 100%; height: auto; border-radius: 10px;">
                                </p>
                                <p style="text-align: center; font-size: 19px; margin: 5px;">
                                    <strong>Event Name:</strong> {{ $event->title }}
                                </p>
                                <p style="text-align: center; font-size: 17px; margin: 5px;">
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->from_date_time)->format('F j, Y') }} to {{ \Carbon\Carbon::parse($event->to_date_time)->format('F j, Y') }}
                                </p>
                                <p style="text-align: center; font-size: 17px; margin: 5px;">
                                    <strong>Location:</strong> {{ $event->location }}
                                </p>
                                <p style="text-align: center; font-size: 17px; margin: 5px;">
                                    <strong>Order Number:</strong> {{ $order->id }}
                                </p>
                            @endif
                        @endif
            
                        <h3>Order Summary</h3>
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            @if($order->type === 'event')
                                <thead>
                                    <tr style="background-color: #f4f4f4;">
                                        <th style="text-align: left; padding: 8px;">Ticket</th>
                                        <th style="text-align: left; padding: 8px;">Type</th>
                                        <th style="text-align: left; padding: 8px;">Quantity</th>
                                        <th style="text-align: left; padding: 8px;">Total Price</th>
                                        <th style="text-align: left; padding: 8px;">Barcode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $eventTotal = 0;
                                        $fee = 2.49; // Define your fee
                                    @endphp
                                    @foreach($order->orderTickets as $ticket)
                                        @php
                                            $ticketTotal = $ticket->price; // Calculate total price for each ticket
                                            $eventTotal += $ticketTotal;
                                        @endphp
                                        <tr>
                                            <td style="padding: 8px;">
                                                @if($ticket->icon)
                                                    <img src="{{ asset('storage/'.$ticket->icon) }}" alt="{{ $ticket->ticket_name }}" style="width: 90px; height: 50px; vertical-align: middle; margin-right: 8px;">
                                                @endif
                                                {{ $ticket->ticket_name ?? 'N/A' }}
                                            </td>
                                            <td style="padding: 8px;">{{ ucfirst($ticket->ticket_type) ?? 'N/A' }}</td>
                                            <td style="padding: 8px;">{{ $ticket->quantity }}</td>
                                            <td style="padding: 8px;">${{ number_format($ticketTotal, 2) }}</td>
                                            

                                            <td style="padding: 8px;">
                                                @php
                                                    try {
                                                        $barcode = DNS2DFacade::getBarcodePNG($ticket->ticket_id, 'QRCODE', 4, 4);
                                                    } catch (Exception $e) {
                                                        $barcode = null;
                                                        \Log::error('Barcode Generation Failed:', ['ticket_id' => $ticket->ticket_id, 'error' => $e->getMessage()]);
                                                    }
                                                @endphp
                                                @if($barcode)
                                                    <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode">
                                                @else
                                                    <span style="color: red;">Barcode unavailable</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                <tfoot>
                                    <tr style="font-weight: bold; border-top: 1px solid;">
                                        <td colspan="3" style="padding: 8px; text-align: right; font-size: 20px;">Subtotal:</td>
                                        <td style="padding: 8px; font-size: 18px;">${{ number_format($eventTotal, 2) }}</td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td colspan="3" style="padding: 8px; text-align: right; font-size: 20px;">Fees:</td>
                                        <td style="padding: 8px; font-size: 18px;">${{ number_format($fee, 2) }}</td>
                                    </tr>
                                    <tr style="font-weight: bold; border-top: 1px solid;">
                                        <td colspan="3" style="padding: 8px; text-align: right; font-size: 20px;">Total:</td>
                                        <td style="padding: 8px; font-size: 18px;">${{ number_format($eventTotal + $fee, 2) }}</td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
            
                        <p><a class="trbtn" href="{{ route('user.login') }}" style="background: #0071c1; padding: 10px; color: #fff; border-radius: 5px; text-decoration: none;">Login Now</a></p>
                    </td>
                </tr>
                <tr>
                    <td class="content" style="background-color:white; padding:20px;">
                        <p style="font-size:14px;">If you have any questions, feel free to reply to this email and we will get back to you.</p>
                        <p style="font-size:14px;">Thanks again for choosing us!</p>
                        <p style="font-size:14px;">Thanks, <br />Eversabz</p>
                        <p style="font-size:14px;">For any support: <a href="{{ url('contactus') }}" style="color:#050505; text-decoration:none;">Contact Us</a></p>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
</table>
