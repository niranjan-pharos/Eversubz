@php
    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += $item->quantity * $item->product->price;
    }
    $shipping = 0;
    $total = $subtotal + $shipping;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Vendor Order Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .table { width: 100%; border-collapse: collapse; }
        .table, .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f4f4f4; text-align: left; }
    </style>
</head>
<body>

    <h1 style="font-size: 22px; color: #333; text-align: right; border-bottom: 1px solid #ccc; padding-bottom: 8px; margin-bottom: 16px;">
        Vendor Order Invoice
    </h1>
    <div style="padding-bottom: 8px; margin-bottom: 16px; border-bottom: 1px solid #ccc;">
        <p style="text-align: right; margin: 0; font-size: 14px;">
            <strong>Order Id:</strong> {{ $order->order_product_unique_id }}
        </p>
        <p style="text-align: right; color: #000; margin: 4px 0; font-size: 14px;">
            <strong>Order Date:</strong> {{ $order->created_at }}
        </p>
    </div>
    <div style="padding-bottom: 8px; margin-bottom: 16px; border-bottom: 1px solid #ccc;">
        <p style="text-align: left; margin: 0;">
            <strong>Vendor Email:</strong> <br> {{ $vendorEmail }}
        </p>
    </div>

    <table class="table" style="font-size: 14px;">
        <tr>
            <th>Order Number:</th>
            <td>{{ $order->order_product_unique_id }}</td>
        </tr>
        <tr>
            <th>Customer Name:</th>
            <td>{{ $order->full_name }}</td>
        </tr>
        <tr>
            <th>Customer Email:</th>
            <td>{{ $order->email }}</td>
        </tr>
        <tr>
            <th>Address:</th>
            <td>{{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country }}, {{ $order->zip_code }}</td>
        </tr>
        <tr>
            <th>Shipping Method:</th>
            <td>
                @if ($order->shipping_method == 'eversabz')
                    Pickup from Eversabz
                @elseif ($order->shipping_method == 'seller')
                    Pickup from Seller
                @else
                    {{ $order->shipping_method ?? "N/A" }}
                @endif
            </td>
        </tr>
    </table>

    <h3 style="font-size: 15px;">Product Details</h3>
    <table class="table" style="font-size: 14px;">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->product->price, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table" style="font-size: 14px; width: 40%; margin-left: auto; margin-top: 16px; border-collapse: collapse;">
        <tr>
            <th style="width: 200px;">Subtotal:</th>
            <td style="width: 200px;">${{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">Shipping:</th>
            <td style="width: 200px;">
                @if (empty($shipping) || $shipping == 0)
                    Free
                @else
                    ${{ number_format($shipping, 2) }}
                @endif
            </td>
        </tr>
        <tr>
            <th style="width: 200px;">Total:</th>
            <td style="width: 200px;">${{ number_format($total, 2) }}</td>
        </tr>
    </table>

    <div style="margin-top: 20px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; padding: 12px 0;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="text-align: left; width: 50%;">
                    <h4 style="margin: 0;">Presented by</h4>
                    <img src="https://eversabz.com/assets/images/logo.png" alt="logo" width="180">
                </td>
                <td style="text-align: right; width: 50%;">
                    <p style="margin: 2px 0;">Eversabz</p>
                    <p style="margin: 2px 0;">5/556-598, Princes Highway</p>
                    <p style="margin: 2px 0;">Noble Park. 3174</p>
                    <p style="margin: 2px 0;">Noble Park, Melbourne</p>
                    <p style="margin: 2px 0;">North VIC 3174, Australia</p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
