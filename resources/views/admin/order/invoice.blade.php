@php
  $subtotal = 0;
  foreach ($order->items as $item) {
      $subtotal += $item->quantity * $item->product->price;
  }
  $shipping = 0;
  $total = $subtotal + $shipping;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Invoice - {{ $order->order_product_unique_id }}</title>
  <style>
    body {
      font-family: 'Helvetica', Arial, sans-serif;
      color: #333;
      background: #fff;
      margin: 0;
      padding: 20px;
    }

    .invoice-container {
      max-width: 800px;
      margin: 0 auto;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 30px;
    }

    .header {
      text-align: right;
      border-bottom: 2px solid #ff6600;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .header h1 {
      font-size: 24px;
      margin: 0;
      color: #222;
    }

    .order-info {
      margin-bottom: 25px;
    }

    .order-info p {
      font-size: 14px;
      margin: 3px 0;
    }

    .customer-details {
      margin-bottom: 25px;
    }

    .customer-details strong {
      font-weight: 600;
      color: #111;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 25px;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 10px 8px;
      font-size: 14px;
    }

    table th {
      background: #f4f4f4;
      text-align: left;
    }

    .summary-table {
      width: 40%;
      margin-left: auto;
      border: 1px solid #ccc;
      border-collapse: collapse;
    }

    .summary-table th, .summary-table td {
      border: 1px solid #ddd;
      padding: 10px;
      font-size: 14px;
    }

    .summary-table th {
      background: #fafafa;
      text-align: left;
    }

    .footer {
      border-top: 1px solid #ccc;
      padding-top: 20px;
      text-align: left;
      font-size: 13px;
    }

    .footer-right {
      text-align: right;
    }

    .footer img {
      width: 180px;
      margin-bottom: 10px;
    }

    .footer p {
      margin: 3px 0;
      color: #333;
    }
  </style>
</head>

<body>
  <div class="invoice-container">

    <div class="header">
      <h1>Order Invoice</h1>
    </div>

    <div class="order-info">
      <p><strong>Order ID:</strong> {{ $order->order_product_unique_id }}</p>
      <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>

    <div class="customer-details">
      <p><strong>Receipt to:</strong></p>
      <p>{{ $order->full_name }}</p>
      <p>{{ $order->email }}</p>
      <p>{{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country }} - {{ $order->zip_code }}</p>
      <p><strong>Phone:</strong> {{ $order->phone_number }}</p>
      <p><strong>Shipping Method:</strong>
        @if ($order->shipping_method == 'eversabz')
            Pickup from Eversabz
        @elseif ($order->shipping_method == 'seller')
            Pickup from Seller
        @else
            {{ $order->shipping_method ?? 'N/A' }}
        @endif
      </p>
    </div>

    <h3>Product Details</h3>
    <table>
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

    <table class="summary-table">
      <tr>
        <th>Subtotal:</th>
        <td>${{ number_format($subtotal, 2) }}</td>
      </tr>
      <tr>
        <th>Shipping:</th>
        <td>
          @if (empty($shipping) || $shipping == 0)
              Free
          @else
              ${{ number_format($shipping, 2) }}
          @endif
        </td>
      </tr>
      <tr>
        <th>Total:</th>
        <td><strong>${{ number_format($total, 2) }}</strong></td>
      </tr>
    </table>

    <div class="footer">
      <table style="width:100%;">
        <tr>
          <td>
            <h4>Ticketing by</h4>
            <img src="https://eversabz.com/assets/images/logo.png" alt="Eversabz Logo">
          </td>
          <td class="footer-right">
            <p><strong>Eversabz</strong></p>
            <p>5/556-598, Princes Highway</p>
            <p>Noble Park, Melbourne</p>
            <p>North VIC 3174, Australia</p>
          </td>
        </tr>
      </table>
    </div>

  </div>
</body>
</html>
