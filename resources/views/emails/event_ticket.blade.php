<table class="body-wrap"
    style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
    <tr>
        <td class="container"
            style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
            <!-- Message start -->
            <table style="width:100% !important;border-collapse:collapse;">
                <tr>
                    <td class="masthead" style="text-align:center; padding-top: 40px; padding-bottom: 30px; padding-right: 0; padding-left: 0;
                        background-color: #0071c1; background-image: url('{{ asset('uploads/common/logo.png') }}');
                        background-repeat: no-repeat; background-position: center 15px; background-attachment: scroll;
                        color: white; border-radius: 10px 10px 0 0;">
                        {{-- <a href="#"> --}}
                            <img class="email-logo" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                                style="width: 100px; background: #fff; border-radius: 10px; padding: 5px;">
                            {{-- </a> --}}
                        <h1 style="line-height: 1.25; font-size: 32px; margin-top: 0 !important; margin-bottom: 0 !important;
                        margin-right: auto !important; margin-left: auto !important; max-width: 90%;">Event Tickets Booking</h1>
                    </td>
                </tr>

                <tr>
                    <td class="content" style="background-color:white;padding:20px;">
                        <h2 style="margin: 0 0 0.5rem 0; line-height: 1.25; color: #333E48; font-size: 2rem; font-weight: 500;">
                            Hello {{ $data['booking']['name'] }},
                        </h2>
                        <p>Your ticket has been confirmed.</p>
                        <p>Here are the details of the events:</p>
                        <p><strong>Title:</strong> {{ $data['event']['title'] }}</p>
                        <p><strong>Event Date:</strong> {{ $data['event']['from_date_time'] }} - {{ $data['event']['to_date_time'] }}</p>
                        <p><strong>Location:</strong> {{ $data['event']['city'] }}, {{ $data['event']['state'] }}</p>
                
                        <p><strong>Tickets:</strong></p>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            @foreach ($data['booking']['ticketItems'] as $ticket)
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; border: 1px solid #ccc;">
                                    <div>
                                        <strong>Ticket:</strong> {{ $ticket['ticket_name'] }}<br>
                                        <strong>Type:</strong> {{ ucfirst($ticket['ticket_type']) }}<br>
                                        <strong>Quantity:</strong> {{ $ticket['quantity'] }}<br>
                                        <strong>Price:</strong> ${{ number_format($ticket['price'], 2) }}
                                    </div>
                                    <div>
                                        <img src="{{ asset($ticket['icon']) }}" alt="Ticket Icon" width="50">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                
                        <p>If you have any questions, please feel free to get in touch with us.</p>
                        <p>
                            <a title="Login" class="trbtn" href="{{ route('user.login') }}" style="background: #0071c1; padding: 10px; color: #fff; border-radius: 5px;">Login Now</a>
                        </p>
                    </td>
                </tr>
                
                
                <tr>
                    <td class="content"
                        style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">If you have any questions, you
                            can simply reply to this email with your questions and we will get back to
                            you shortly with an answer.</p>
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">Thanks again for your choice!
                            We appreciate that you've chosen us.</p> 
                        <!-- signature begin -->
                        <p style="font-size:14px; font-weight:normal;  margin-bottom:20px;">Thanks, <br />Eversabz</p>
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">For any support: <a
                                title="contactus" href="{{ asset ('contactus') }}"
                                style="color:#050505;text-decoration:none;">Contact Us</a> <br />
                            <b>Eversabz</b> is always available to assist you.
                        </p>
                    </td>
                </tr>
            </table>
            <!-- body end -->
        </td>
    </tr>
    <!-- footer begin -->
    <tr>
        <td class="container"
            style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
            <table style="width:100% !important;border-collapse:collapse;">
                <tr>
                    <td class="content footer"
                        style="text-align:center; background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:2px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">You were sent this email
                            because you are registered with <a title="home" href="/">Eversabz</a>.<br>
                            Email: <a title="mail" href="mailto:info.eversabz@gmail.com"
                                style="color:#050505;text-decoration:none;">
                                <span class="__cf_email__">info.eversabz@gmail.com</span></a>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- footer end -->
</table>
