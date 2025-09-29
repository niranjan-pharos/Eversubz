<table class="body-wrap"
    style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
    <tr>
        <td class="container"
            style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
            <!-- Message start -->
            <table style="width:100% !important;border-collapse:collapse;">
                <tr>
                    <td class="masthead"
                        style="text-align:center; padding-top: 40px; padding-bottom: 30px; padding-right: 0; padding-left: 0;
                        background-color: #0071c1; background-image: url('{{ asset('uploads/common/logo.png') }}');
                        background-repeat: no-repeat; background-position: center 15px; background-attachment: scroll;
                        color: white; border-radius: 10px 10px 0 0;">
                        {{-- <a href="#"> --}}
                            <img class="email-logo" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                                style="width: 100px; background: #fff; border-radius: 10px; padding: 5px;">
                            {{-- </a> --}}
                        <h1 style="line-height: 1.25; font-size: 32px; margin-top: 0 !important; margin-bottom: 0 !important;
                        margin-right: auto !important; margin-left: auto !important; max-width: 90%;">New Order Notification - Eversabz</h1>
                    </td>
                </tr>

                <tr>
                    <td class="content"
                        style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                        <h2
                            style="margin: 0 0 0.5rem 0; line-height: 1.25;  color: #333E48; font-size: 2rem; font-weight: 500; font-style: normal;">
                            Hello, </h2>
                        <p>A customer has just placed a new order. Below are the order details.</p>

                        <h3>Customer Details</h3>
                        <ul>
                            <li><strong>Name:</strong> {{ $user->name }}</li>
                            <li><strong>Phone:</strong> {{ $user->phone }}</li>
                            <li><strong>Email:</strong> {{ $user->email }}</li>
                            <li><strong>Shipping Address:</strong> {{ $order->shipping_address }}</li>
                        </ul>

                        <h3>Order Summary</h3>
                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->name }} - Quantity: {{ $item->pivot->quantity }} - Price: ${{ number_format($item->pivot->price, 2) }}</li>
                            @endforeach
                        </ul>

                        <p>Total Amount: <strong>${{ number_format($order->total_amount, 2) }}</strong></p>
                    </td>
                </tr>

                <tr>
                    <td class="content"
                        style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">For any inquiries, please contact support.</p>
                        <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">Thanks, <br />Eversabz</p>
                    </td>
                </tr>
            </table>
            <!-- body end -->
        </td>
    </tr>
</table>
