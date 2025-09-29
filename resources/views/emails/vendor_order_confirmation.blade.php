@php
$subtotal = 0;
// Calculate the subtotal based on the order items
foreach ($order->items as $item) {
    $subtotal += $item->quantity * $item->product->price;
}

$shipping = config('constants.PRODUCT_SHIPPING');
$total = $subtotal + $shipping;
@endphp
<style>
  .table-bordered tr {
    border: 1px solid #dee2e6;
    text-align: left;
}
</style>
{{-- <table class="body-wrap" style="width:97% !important;margin:0 auto;height:100%;background-color:#f9f9f9;">
    <tr>
        <td class="container"
            style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
            <!-- Message start -->
            <table style="width:100% !important; border-collapse:collapse;">
                <tr style="">
                    <td class="masthead">
                        <img class="email-logo" src="https://eversabz.com/assets/images/logo.png" alt="logo"
                            style="width: 250px; border-radius: 10px; padding: 5px;margin: auto;display: flex;">
                    </td>
                </tr>
                <tr style="">
                    <td class="content" style="padding-bottom: 30px;background-color:white;color: #000000;">
 
                        <h2
                            style="margin: 0 0 0.5rem 0; line-height: 1.25; text-align: center; font-size: 1rem; font-weight: 500;margin: 35px 65px 0px;color: #000000;">
                            Hello, {{ $user ? $user->full_name :  $order->full_name  }}! Thank you for your order.
                        </h2>
                        <div style="background: #f9f9f9;margin: 35px;padding: 20px;color: #000000;">
                            <p style="color: #000000;text-align: center;font-size: 23px;"><strong
                                    style="font-weight: 500;">Order Details</strong></p>

                            <p style="text-align: center;color: #000000; font-size: 19px; margin: 5px;">
                                <strong style="">Order Number:</strong>
                                {{ $order->order_product_unique_id }}
                            </p>
                            <p
                                style="text-align: center;font-size:14px;margin: 30px 30px 0px;text-decoration: none color: #000000;">
                                Thank you for shopping with us! Below are your order details.
                            </p>
                            <hr style="margin: 20px;color: #ddd;border: 1px solid;">
                            <p style="color: #000000;font-size: 14px;margin: 5px;">
                                <strong style="">Full Name:</strong> {{ $order->full_name }}
                            </p>
                            <p style="color: #000000;font-size: 14px;margin: 5px;">
                                <strong style="">Email:</strong> {{ $order->email }}
                            </p>
                            <p style="color: #000000;font-size: 14px;margin: 5px;">
                                <strong style="">Phone Number:</strong> {{ $order->phone_number }}
                            </p>
                            <p style="color: #000000;font-size: 14px;margin: 5px;">
                                <strong style="">Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->state }},  {{ $order->country }}, {{ $order->zip_code }}
                            </p>
                            <p><strong>Shipping Method:</strong> 
                                <span>
                                    @if ($order->shipping_method == 'eversabz')
                                        Pickup from Eversabz
                                    @elseif ($order->shipping_method == 'seller')
                                        Pickup from Seller
                                    @else
                                        {{ $order->shipping_method ?? "N/A" }}
                                    @endif
                                </span>
                            </p>
                            
                          

                            <h3 style="color: #000000;">Product Details</h3>
                            <table class="table table-bordered" style="">
                                <thead>
                                    <tr style="">
                                        <th style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">Product Name</th>
                                        <th style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">Quantity</th>
                                        <th style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">Price</th>
                                        <th style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">Total</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach ($order->items as $item)
                                    <tr style="">
                                        <td style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">{{ $item->product->title }}</td>
                                        <td style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">{{ $item->quantity }}</td>
                                        <td style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">${{ number_format($item->product->price, 2) }}</td>
                                        <td style="color: #000000;    margin-right: 5px !important;    border: 1px solid #ddd;padding: 8px;">${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="table table-bordered"
                                style="color: #000000;width: 50%;box-shadow: 0px 0px 1px;margin-left: auto;border-collapse: collapse;border: 1px solid #ccc;font-size: 13px;margin-top: 20px;">
                                <thead>
                                    <tr style="">
                                        <th style="padding: 8px;">Summary</th>
                                        <th style="padding: 8px;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="">
                                        <td style="color: #000000;width: 300px;max-width: 300px; border: 1px solid #ddd; padding: 8px;">
                                            <strong>Subtotal:</strong></td>
                                        <td style="width: 200px;max-width: 200px; padding: 8px;">${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr style="">
                                        <td style="color: #000000;width: 300px;max-width: 300px; border: 1px solid #ddd; padding: 8px;">
                                            <strong>Shipping:</strong></td>
                                            <td style="width: 200px;max-width: 200px; padding: 8px;">
                                                @if (empty($shipping) || $shipping == 0)
                                                    Free
                                                @else
                                                    ${{ number_format($shipping, 2) }}
                                                @endif
                                            </td>
                                            
                                    </tr>
                                    <tr style="">
                                        <td style="color: #000000;width: 300px;max-width: 300px; border: 1px solid #ddd; padding: 8px;">
                                            <strong>Total:</strong></td>
                                        <td style="width: 200px;max-width: 200px; padding: 8px;">${{ number_format($total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        

                        <table style="width:100% !important; border-collapse:collapse;margin-top: 10px;" class="adm">
                            <tr style="">
                                <td class="content"
                                    style="background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:20px;padding-bottom:0;padding-right:20px;padding-left:20px;">
                                    <p
                                        style="font-size:14px;font-weight:normal;margin-bottom:20px; text-align: center;color: #000000;">
                                        If you have any questions, you
                                        can simply reply to this email with your questions and we will get back to
                                        you shortly with an answer.</p>
                                    <p
                                        style="font-size:14px;font-weight:normal;margin-bottom:20px; text-align: center;color: #000000;">
                                        Thanks again for your choice!
                                        We appreciate that you've chosen us.</p>
                                    <p
                                        style="font-size:14px; font-weight:normal;  margin-bottom:20px; text-align: center;color: #000000;">
                                        Thanks, <br />Eversabz</p>
                                    <p
                                        style="font-size:14px;font-weight:normal;margin-bottom:20px; text-align: center;color: #000000;">
                                        For any support: <a title="contactus" href="https://eversabz.com/contactus"
                                            style="color:#050505;text-decoration:none;text-align: center;">Contact
                                            Us</a> <br />
                                        <b>Eversabz</b> is always available to assist you.
                                    </p>
                                </td>
                            </tr>

                            <tr style="">
                                <td class="container"
                                    style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;">
                                    <table style="width:100% !important;border-collapse:collapse;">
                                        <tr style="">
                                            <td class="content footer"
                                                style="text-align:center; background-color:#f9f9f9;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:2px;padding-bottom:0;padding-right:20px;padding-left:20px;color: #000000;">
                                                <p style="font-size:14px;font-weight:normal;margin-bottom:20px;">You
                                                    were sent this email
                                                    because you are registered with <a title="home"
                                                        href="https://eversabz.com/">Eversabz</a>.<br>
                                                    Email: <a title="mail" href="mailto:info.eversabz@gmail.com"
                                                        style="color:#050505;text-decoration:none;">
                                                        <span class="__cf_email__">info.eversabz@gmail.com</span>
                                                    </a>
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
        </td>
    </tr>
</table> --}}


<table class="body-wrap" style="width:97% !important;margin:0 auto;height:100%;background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);min-height:100vh;">
    <tr>
        <td class="container"
            style="display:block !important;clear:both !important;margin-top:40px !important;margin-bottom:40px !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
            
            <!-- Email Card with Shadow -->
            <table style="width:100% !important; border-collapse:collapse; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
                
                <!-- Header with Gradient -->
                <tr>
                    <td style="background: linear-gradient(135deg, #2660C5 0%, #4285f4 100%); padding:0; text-align:center;">
                        
                        <!-- Logo Section -->
                        <div style="padding:30px 20px 20px;">
                            <img class="email-logo" src="https://eversabz.com/assets/images/logo.png" alt="Eversabz Logo"
                                style="display:block; max-width:200px; margin:0 auto; filter: brightness(0) invert(1);">
                        </div>
                        
                        <!-- Bell Icon -->
                        <div style="padding:0 20px 20px;">
                            <div style="background-color:rgba(255,255,255,0.2); border-radius:50%; width:80px; height:80px; margin:0 auto; display:flex; align-items:center; justify-content:center;">
                                <span style="font-size:32px; color:#ffffff;">🔔</span>
                            </div>
                        </div>
                        
                        <!-- Main Title -->
                        <div style="padding:0 20px 40px;">
                            <h1 style="margin:0; font-size:28px; font-weight:700; color:#ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                New Order Received!
                            </h1>
                            <p style="margin:10px 0 0; font-size:16px; color:rgba(255,255,255,0.9); font-weight:400;">
                                You have a new order to fulfill
                            </p>
                        </div>
                        
                    </td>
                </tr>
                
                <!-- Content Section -->
                <tr>
                    <td class="content" style="padding:40px; background-color:white; color:#333333; font-size:16px; line-height:1.6;">
                        
                        <!-- Welcome Message -->
                        <div style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); 
                                    border-left:4px solid #2660C5; border-radius:12px; padding:25px; margin-bottom:30px; 
                                    box-shadow: 0 4px 15px rgba(38, 96, 197, 0.1);">
                            <h2 style="margin:0 0 15px; font-size:22px; font-weight:600; color:#2660C5; display:flex; align-items:center; justify-content:center;">
                                <span style="margin-right:8px;">🏪</span> Hello Vendor!
                            </h2>
                            <p style="margin:0; color:#666; font-size:16px; text-align:center;">
                                A new order has been placed and requires your attention. Please review the details below and prepare for fulfillment.
                            </p>
                        </div>

                        <!-- Order Information -->
                        <div style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); 
                                    border-left:4px solid #2660C5; border-radius:12px; padding:25px; margin:25px 0; 
                                    box-shadow: 0 4px 15px rgba(38, 96, 197, 0.1);">
                            <h3 style="margin:0 0 20px; font-size:18px; font-weight:600; color:#2660C5; display:flex; align-items:center; justify-content:center;">
                                <span style="margin-right:8px;">📋</span> Order Details
                            </h3>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:15px;">
                                <tr>
                                    <td style="padding:8px 0; color:#333; font-weight:500;">Order Number:</td>
                                    <td style="padding:8px 0; color:#666; text-align:right; font-family:monospace;">{{ $order->order_product_unique_id }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#333; font-weight:500;">Order Date:</td>
                                    <td style="padding:8px 0; color:#666; text-align:right;">{{ $order->created_at->format('M d, Y - h:i A') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#333; font-weight:500;">Order Value:</td>
                                    <td style="padding:8px 0; color:#2660C5; text-align:right; font-weight:600; font-size:16px;">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#333; font-weight:500;">Payment Status:</td>
                                    <td style="padding:8px 0; color:#28a745; text-align:right; font-weight:600;">{{ $order->payment_status }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Customer Information -->
                        <div style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); 
                                    border-left:4px solid #2660C5; border-radius:12px; padding:25px; margin:25px 0; 
                                    box-shadow: 0 4px 15px rgba(38, 96, 197, 0.1);">
                            <h3 style="margin:0 0 20px; font-size:18px; font-weight:600; color:#2660C5; display:flex; align-items:center; justify-content:center;">
                                <span style="margin-right:8px;">👤</span> Customer Information
                            </h3>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:15px;">
                                <tr>
                                    <td style="padding:8px 0; color:#333; font-weight:500;">Name:</td>
                                    <td style="padding:8px 0; color:#666; text-align:right;">{{ $order->full_name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#333; font-weight:500;">Email:</td>
                                    <td style="padding:8px 0; color:#666; text-align:right;">{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#333; font-weight:500;">Phone:</td>
                                    <td style="padding:8px 0; color:#666; text-align:right;">{{ $order->phone_number }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Shipping Information -->
                        <div style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); 
                                    border-left:4px solid #2660C5; border-radius:12px; padding:25px; margin:25px 0; 
                                    box-shadow: 0 4px 15px rgba(38, 96, 197, 0.1);">
                            <h3 style="margin:0 0 15px; font-size:18px; font-weight:600; color:#2660C5; display:flex; align-items:center; justify-content:center;">
                                <span style="margin-right:8px;">📦</span> Shipping Details
                            </h3>
                            <div style="background:#fff; border-radius:8px; padding:20px; border:1px solid #e1e1e1; margin-bottom:15px;">
                                <p style="margin:0 0 10px; color:#333; font-weight:500;">Delivery Address:</p>
                                <p style="margin:0; color:#666; font-size:15px; line-height:1.5;">
                                    {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country }}, {{ $order->zip_code }}
                                </p>
                            </div>
                            <div style="background:#fff; border-radius:8px; padding:20px; border:1px solid #e1e1e1;">
                                <p style="margin:0 0 10px; color:#333; font-weight:500;">Shipping Method:</p>
                                <p style="margin:0; color:#666; font-size:15px;">
                                    @if ($order->shipping_method == 'eversabz')
                                        Pickup from Eversabz
                                    @elseif ($order->shipping_method == 'seller')
                                        Pickup from Seller
                                    @else
                                        {{ $order->shipping_method ?? "Standard Delivery" }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Products Ordered -->
                        <div style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); 
                                    border-left:4px solid #2660C5; border-radius:12px; padding:25px; margin:25px 0; 
                                    box-shadow: 0 4px 15px rgba(38, 96, 197, 0.1);">
                            <h3 style="margin:0 0 20px; font-size:18px; font-weight:600; color:#2660C5; display:flex; align-items:center; justify-content:center;">
                                <span style="margin-right:8px;">🛍️</span> Products to Fulfill
                            </h3>
                            <div style="background:#fff; border-radius:8px; padding:20px; border:1px solid #e1e1e1;">
                                @foreach ($items as $item)
                                    <div style="padding:15px 0; border-bottom:1px solid #f0f0f0; @if($loop->last) border-bottom:none; @endif">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="color:#333; font-weight:600; font-size:16px;">Product ID: {{ $item->product_id }}</td>
                                                <td style="text-align:right; color:#2660C5; font-weight:600; font-size:16px;">Qty: {{ $item->quantity }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color:#666; font-size:14px; padding-top:5px;">Unit Price: ${{ number_format($item->price, 2) }}</td>
                                                <td style="text-align:right; color:#666; font-size:14px; padding-top:5px;">Total: ${{ number_format($item->total, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Action Required -->
                        <div style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); 
                                    border-left:4px solid #ffc107; border-radius:12px; padding:25px; margin:30px 0; 
                                    box-shadow: 0 4px 15px rgba(255, 193, 7, 0.2);">
                            <h3 style="margin:0 0 15px; font-size:18px; font-weight:600; color:#856404; display:flex; align-items:center; justify-content:center;">
                                <span style="margin-right:8px;">⚡</span> Action Required
                            </h3>
                            <p style="margin:0 0 15px; color:#856404; font-size:15px; text-align:center; font-weight:500;">
                                Please log in to your vendor dashboard to process this order and update shipping status.
                            </p>
                            <div style="text-align:center;">
                                <a href="https://eversabz.com/my-orders" style="display:inline-block; background:#2660C5; color:#ffffff; text-decoration:none; padding:16px 40px; font-size:16px; border-radius:50px; font-weight:600; box-shadow: 0 8px 20px rgba(38, 96, 197, 0.3);">
                                    View Order in Dashboard →
                                </a>
                            </div>
                        </div>

                    </td>
                </tr>

                <!-- Support Section -->
                <tr>
                    <td style="padding:0 40px 40px;">
                        <div style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); 
                                    border-left:4px solid #2660C5; border-radius:12px; padding:25px; 
                                    box-shadow: 0 4px 15px rgba(38, 96, 197, 0.1); text-align:center;">
                            <h3 style="margin:0 0 15px; font-size:16px; font-weight:600; color:#2660C5;">
                                Vendor Support Team
                            </h3>
                            <p style="margin:0 0 15px; font-size:14px; color:#666;">
                                Need assistance with order processing? Our vendor support team is here to help.
                            </p>
                            <p style="margin:0 0 15px; font-size:14px; color:#666;">
                                <a href="mailto:{{ url('contactus') }}" style="color:#2660C5; text-decoration:none; font-weight:600;">Contact Us</a>
                            </p>
                            <div style="border-top:1px solid #e0e6ff; padding-top:15px; margin-top:15px;">
                                <p style="margin:0; font-size:12px; color:#999; line-height:1.5;">
                                    © {{date("Y")}} Eversabz Vendor Portal. All rights reserved.
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
