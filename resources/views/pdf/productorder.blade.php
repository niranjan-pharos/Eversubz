@php
$subtotal = 0;
foreach ($order->items as $item) {
$subtotal += $item->quantity * $item->product->price;
}
$shipping = 0;
$total = $subtotal + $shipping;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f4f4f4;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1
    style="font-size: 24px; color: #333; text-align: right; border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px;">
    Order Invoice
  </h1>
  <div class="event-details2" style="padding-bottom: 10px; margin-bottom: 20px; border-bottom: 1px solid #ccc;">
    <p style="text-align: right;margin: 0px;font-size: 14px;">
      <strong style="font-weight: 600; color: #000;">Order Id: {{ $order->order_product_unique_id }}</strong>
    </p>
    <p style="text-align: right; color: #000; margin: 5px 0px; font-size: 14px;">
      <strong style="font-weight: 600;">Order Date: {{ $order->created_at }}</strong>
    </p>
  </div>
  <div class="event-details2" style="padding-bottom: 10px; margin-bottom: 20px; border-bottom: 1px solid #ccc;">
    <p style="text-align: left; margin: 0px;">
      <strong style="font-weight: 600;">Receipt to:</strong>
      <br> {{ $order->full_name }}!
    </p>
  </div>

    <table style="font-size: 14px;" class="table">
        <tr>
            <th>Order Number:</th>
            <td>{{ $order->order_product_unique_id }}</td>
        </tr>
        <tr>
            <th>Full Name:</th>
            <td>{{ $order->full_name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $order->email }}</td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td>{{ $order->phone_number }}</td>
        </tr>
        <tr>
            <th>Address:</th>
            <td>{{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country }}, {{
                $order->zip_code }}</td>
        </tr>
        <tr>
          <th>Shipping Method:</th>
          <td>@if ($order->shipping_method == 'eversabz')
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
    <table style="font-size: 14px;" class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->product->price, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
    <table style="font-size: 14px;box-shadow: 0px 0px 1px;margin-left: auto;border-collapse: collapse;border: 1px solid #ccc;width: 40%;font-size: 13px;margin-top: 20px;" class="table">
        <tr>
            <th style="width: 200px; border: 1px solid #ddd; padding: 8px;">Subtotal:</th>
            <td style="width: 200px; border: 1px solid #ddd; padding: 8px;">${{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <th style="width: 200px; border: 1px solid #ddd; padding: 8px;">Shipping:</th>
            <td style="width: 200px; border: 1px solid #ddd; padding: 8px;">
              @if (empty($shipping) || $shipping == 0)
                  Free
              @else
                  ${{ number_format($shipping, 2) }}
              @endif
          </td>
          
        </tr>
        <tr>
            <th style="width: 200px; border: 1px solid #ddd; padding: 8px;">Total:</th>
            <td style="width: 200px; border: 1px solid #ddd; padding: 8px;">${{ number_format($total, 2) }}</td>
        </tr>
    </table>

    <div class="event-details4"
    style="margin-top: 30px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; padding: 20px 0px;">
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