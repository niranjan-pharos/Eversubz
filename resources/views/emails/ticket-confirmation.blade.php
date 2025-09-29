@php
use Milon\Barcode\Facades\DNS2DFacade;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

<table class="body-wrap" style="width:97% !important;margin:0 auto;height:100%;background-color:#f9f9f9;">
  <tr>
    <td class="container"
      style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
      <!-- Message start -->
      <table style="width:100% !important; border-collapse:collapse;">
        <tr>
          <td class="masthead" style="">
            <img class="email-logo" src="https://eversabz.com/assets/images/logo.png" alt="logo"
              style="width: 250px; border-radius: 10px; padding: 5px;margin: auto;display: flex;">
            <!-- <h1 style="line-height: 1.25; font-size: 32px; margin: 0;    text-align: center;color: #fff;">Event Ticket Confirmation</h1> -->
          </td>
        </tr>
        <tr>
          <td class="content" style="padding-bottom: 30px;background-color:white; ">

            <p>
              <img
                src="{{ url('storage/' . $event->main_image) }}"
                alt="Event Main Image" style="width:100%; max-width: 100%; height: auto; border-radius: 10px;">
            </p>
            <h2
              style="margin: 0 0 0.5rem 0; line-height: 1.25; color: #000000; text-align: center; font-size: 1rem; font-weight: 500;margin: 35px 65px 0px;">
              Hello, {{ $order->first_name }} {{ $order->last_name }}! Thank you for your ticket purchase for the event
            </h2>
            <div style="background: #f9f9f9;margin: 35px;padding: 20px;">
              <p style="color: #000000;text-align: center;font-size: 23px;"><strong style="font-weight: 500;">{{ $event->title }}</strong></p>
            
              <p style="text-align: center;margin: 0px;">
                <strong style="font-weight: 500;">Order Number:</strong> {{ $order->order_event_unique_id }}
              </p>

              
             </p>
              <a style="text-align: center;font-size:14px;text-decoration: none;display: flex;border: 1px solid;width: 200px;justify-content: center;margin: 10px auto;padding: 10px 20px;color: #ffffff;background: #2a6eb5;"
              href="{{ route('downloadOrderPdf', ['order_event_unique_id' => $order->order_event_unique_id]) }}" target="_blank">View & Download Ticket</a>
              <hr style="margin: 20px;color: #ddd;border: 1px solid;">
              <p style="color: #000000;font-size: 14px;margin: 5px 5px 15px 20px;">
                <svg fill="#2a6eb5" width="17px" height="17px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM5 7h14v2H5V7z">
                  </path>
                </svg>
                <strong style="font-weight: 500;">Event Date - </strong> 
                {{ \Carbon\Carbon::parse($event->from_date_time)->format('F j, Y') }} to {{
                \Carbon\Carbon::parse($event->to_date_time)->format('F j, Y') }}
              </p>
              <p style="color: #000000;font-size: 14px;margin: 15px 5px 5px 20px;">
                <svg fill="#2a6eb5" width="17px" height="17px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M 16 3 C 11.042969 3 7 7.042969 7 12 C 7 13.40625 7.570313 15.019531 8.34375 16.78125 C 9.117188 18.542969 10.113281 20.414063 11.125 22.15625 C 13.148438 25.644531 15.1875 28.5625 15.1875 28.5625 L 16 29.75 L 16.8125 28.5625 C 16.8125 28.5625 18.851563 25.644531 20.875 22.15625 C 21.886719 20.414063 22.882813 18.542969 23.65625 16.78125 C 24.429688 15.019531 25 13.40625 25 12 C 25 7.042969 20.957031 3 16 3 Z M 16 5 C 19.878906 5 23 8.121094 23 12 C 23 12.800781 22.570313 14.316406 21.84375 15.96875 C 21.117188 17.621094 20.113281 19.453125 19.125 21.15625 C 17.554688 23.867188 16.578125 25.300781 16 26.15625 C 15.421875 25.300781 14.445313 23.867188 12.875 21.15625 C 11.886719 19.453125 10.882813 17.621094 10.15625 15.96875 C 9.429688 14.316406 9 12.800781 9 12 C 9 8.121094 12.121094 5 16 5 Z M 16 10 C 14.894531 10 14 10.894531 14 12 C 14 13.105469 14.894531 14 16 14 C 17.105469 14 18 13.105469 18 12 C 18 10.894531 17.105469 10 16 10 Z">
                  </path>
                </svg><strong style="font-weight: 500;">Event Location - </strong> {{ $event->location }}, {{ $event->city }}, {{ $event->state }}, {{ $event->country }}
              </p>
              <p style="display:flex; justify-content:center; margin: auto;"><a style="font-size:14px;margin: 10px 10px 20px 20px;display: flex;justify-content: center;"
                href="{{ route('event.show', [$event->slug]) }}">View event information</a>
                </p>
            </div>

            <div style="background: #f9f9f9;margin: 35px;padding: 20px 25px 20px;">
              <p style="color: #000000;    font-weight: 600;"><strong style="font-weight: 500;">Order Summary</strong></p>
              <p style="color: #000000;margin: 5px 0px; font-size: 14px;"><strong style="font-weight: 500;">Order Date</strong> - {{ $order->created_at }}</p>
              <p style="color: #000000;margin: 5px 0px; font-size: 14px;"><strong style="font-weight: 500;">Order Number</strong> - {{ $order->order_event_unique_id }}</p>
              <p style="color: #000000;margin: 5px 0px; font-size: 14px;"><strong style="font-weight: 500;">Customer Name </strong> - {{ $order->first_name }} {{
                $order->last_name }}</p>
              <hr style="margin: 20px;color: #ddd;border: 1px solid;">
              <p style="margin: 5px 0px; font-size: 14px;"><strong style="font-weight: 500;">Ticket Type </strong> </p>
              <hr>
              @php
              $eventTotal = 0;
              $fee = config('constants.EVENT_FEE');
          @endphp
          
          @foreach($order->orderTickets as $ticket)
              @php
                  $ticketTotal = $ticket->price * $ticket->quantity;
                  $eventTotal += $ticketTotal;
              @endphp

              <p style="color: #000;font-size: 13px;    margin-bottom: 2px;">
                
                {{ $ticket->quantity }}x &nbsp; {{ $ticket->ticket_name }} {{ ucfirst($ticket->ticket_type) }} - ${{
                number_format($ticketTotal, 2) }}
              </p>
              @endforeach

              <hr>
              <p style="color: #000000; font-size: 15px; margin: 5px;">
                <strong style="font-weight: 500;">Fee:</strong> ${{ config('constants.EVENT_FEE') }}
              </p>            
              <p style="color: #000000; font-size: 15px; margin: 5px;">
                <strong style="font-weight: 500;">Total:</strong> ${{ number_format($eventTotal + $fee, 2) }}
            </p>

            </div>

            <table style="border-radius:4px;border:solid 1px #dedede;margin-top:24px;background-color:white;width:80%; margin: auto auto 35px;"
            bgcolor="white">
              <tbody>
                <tr>
                  <td width="100" style="padding:10px">
                    <img src="https://eversabz.com/assets/images/logo.png" alt="Eversabz"
                      style="border:none;text-decoration:none;width: 100%;" class="CToWUd" data-bit="iit">
                  </td>
                  <td style="max-width:324px;text-align:left" align="left">
                    <p style="margin:0px;font-size:13px;margin-bottom:8px">Eversabz is proud to support <b>{{
                        $event->title }}</b></p>
                  </td>
                </tr>
              </tbody>
            </table>



            <p style="display:flex; justify-content: center; margin: auto;"><a class="trbtn" href="{{ route('user.login') }}"
                style="background: #0071c1; padding: 10px;     display: flex; justify-content: center; margin:0px auto;color: #fff; border-radius: 5px; text-decoration: none;">Login
                Now</a></p>
          </td>
        </tr>

       
      </table>
      <table style="width:100% !important; border-collapse:collapse;margin-top: 10px;">
        <tr>
          <td class="content"
              style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
              <p style="font-size:14px;font-weight:normal;margin-bottom:20px; text-align: center;">If you have any questions, you
                  can simply reply to this email with your questions and we will get back to
                  you shortly with an answer.</p>
              <p style="font-size:14px;font-weight:normal;margin-bottom:20px; text-align: center;">Thanks again for your choice!
                  We appreciate that you've chosen us.</p>
              <!-- signature begin -->
              <p style="font-size:14px; font-weight:normal;  margin-bottom:20px; text-align: center;">Thanks, <br />Eversabz</p>
              <!-- <p style="font-size:14px;font-weight:normal;margin-bottom:20px; text-align: center;"></p> -->
              <p style="font-size:14px;font-weight:normal;margin-bottom:20px; text-align: center;">For any support: <a
                      title="contactus" href="https://eversabz.com/contactus"
                      style="color:#050505;text-decoration:none;text-align: center;">Contact Us</a> <br />
                  <b>Eversabz</b> is always available to assist you.
              </p>
          </td>
      </tr>

        <tr>
          <td class="container"
              style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
              <table style="width:100% !important;border-collapse:collapse;">
                  <tr>
                      <td class="content footer"
                          style="text-align:center; background-color:#f9f9f9;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:2px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                          <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">You were sent this email
                              because you are registered with <a title="home" href="https://eversabz.com/">Eversabz</a>.<br>
                              Email: <a title="mail" href="mailto:info.eversabz@gmail.com"
                                  style="color:#050505;text-decoration:none;">
                                  <span class="__cf_email__">info.eversabz@gmail.com</span></a>
                          </p>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>
      </table>
    </td>
  </tr>
</table>