@extends('frontend.template.master')

@section('content')
@push('style')
<style>
    .header-part{
            border-bottom: 1px solid #eee;
    }
.thank-you-section {
    background: #f4f4f45c;
    padding: 60px 0px 100px 0px;
    color: #f4f4f4;
    text-align: center;
    position: relative;
    overflow: hidden;
}

    .thank-you-section::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -150px;
        background: rgba(255, 255, 255, 0.1);
        width: 400px;
        height: 400px;
        border-radius: 50%;
        z-index: 1;
        animation: pulse 8s infinite ease-in-out;
    }

    .thank-you-section::after {
        content: "";
        position: absolute;
        bottom: -150px;
        left: -150px;
        background: rgba(255, 255, 255, 0.1);
        width: 400px;
        height: 400px;
        border-radius: 50%;
        z-index: 1;
        animation: pulse 10s infinite ease-in-out;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.2);
        }
    }

    /* Header */
    .thank-you-header h1 {
    font-size: 37px;
    font-weight: 600;
    text-shadow: none;
    z-index: 2;
    color: black;
    position: relative;
}

    .thank-you-header p {
        font-size:18px;
           margin-top: 10px;
    color: #0000009e;
    z-index: 2;
    position: relative;
    }

    /* Order Summary Section */
    .order-summary {
           background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0px 4px 5px rgba(0, 0, 0, 0.2);
    margin: 30px auto;
    color: #333;
    max-width: 800px;
    z-index: 2;
    position: relative;
    }

  .order-summary h3 {
    font-size: 24px;
    color: black;
    font-weight: 500;
    text-align: center !important;
    margin-bottom: 20px;
    text-align: center;
}

  .order-summary h4 {
    font-size: 24px;
    color: black;
    font-weight: 500;
    text-align: left !important;
    margin-bottom: 20px;
    text-align: center;
}

    .order-summary ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .order-summary li {
        font-size: 1.2rem;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: none;
    padding-bottom: 2px;
    }

    /* Icon and Button Styling */
    .thank-you-actions {
        text-align: center;
        margin-top: 30px;
        z-index: 2;
        position: relative;
    }

    .thank-you-actions a {
            background: linear-gradient(135deg,#2c54a4,#28a745);
        color: #fff;
        padding: 10px 40px;
        border-radius: 30px;
        font-size: 1.2rem;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: transform 0.3s ease, background 0.3s ease;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }

    .thank-you-actions a:hover {
        transform: scale(1.1);
        background: linear-gradient(135deg,#2c54a4,#28a745);
    }

    .thank-you-image img {
        max-width: 100%;
        border-radius: 15px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 2;
        position: relative;
    }
    .table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
    text-align: left;
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    border-radius: 10px;
    padding: 23px;
    background: #f4f4f4;
    -webkit-overflow-scrolling: touch;
}
.order-list li strong{
        font-size: 16px;
    font-weight: 600;
}
.order-list li span{
        font-size: 16px;
    font-weight: 500;
}
.table-bordered thead th {
    border-bottom-width: 2px;
    background: #2872b8;
    color: #fff;
}
    /* Responsive Design */
    @media (max-width: 768px) {
        .thank-you-header h1 {
            font-size: 2rem;
        }

        .order-summary {
            padding: 20px;
        }
        .order-summary h3{font-size: 1.5rem;}

        .order-summary li {
            font-size: 1rem;
        }
    }
</style>
@endpush

<section class="thank-you-section">
    <div class="container">
        <div class="thank-you-header">
            <h1>Payment Successful!</h1>
            <p>Your payment has been processed successfully. We're thrilled to serve you!</p>
        </div>
        <div class="order-summary">
            <h3>Order Details</h3>
            <hr>
            <ul class="order-list">
                <li><strong>Order ID</strong> <span>{{ $storeOrder->order_product_unique_id }}</span></li>
                <li><strong>Name</strong> <span>{{ $storeOrder->full_name }}</span></li>
                <li><strong>Email</strong> <span>{{ $storeOrder->email ?? 'N/A' }}</span></li>
                <li><strong>Phone</strong> <span>{{ $storeOrder->phone_number }}</span></li>
                <li><strong>Shipping Method</strong> 
                    <span>
                        @if ($storeOrder->shipping_method == 'eversabz')
                            Pickup from Eversabz
                        @elseif ($storeOrder->shipping_method == 'seller')
                            Pickup from Seller
                        @else
                            N/A.
                        @endif
                    </span>
                </li>
                
            </ul>

            <!-- Product Info in Table Format -->
            <h4 class="mt-5">Product Details</h4>
            <hr>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($storeOrder->items as $item)
                        @php
                            $itemTotal = $item->quantity * $item->product->price;
                            $subtotal += $itemTotal;
                        @endphp
                        <tr>
                            <td>{{ $item->product->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>${{ number_format($itemTotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <!-- Subtotal, Shipping, and Total in a separate table positioned at the bottom-right corner -->
            <!-- @php
                $shipping = 9.99; // Fixed shipping cost
                $total = $subtotal + $shipping;
            @endphp
            <table class="table table-bordered" style="    width: 38%;box-shadow: 0px 0px 1px;margin-left: auto;border-collapse: collapse;border: 1px solid #ccc;font-size: 13px;margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Summary</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="width: 200px; border: 1px solid #ddd; padding: 8px;"><strong>Subtotal:</strong></td>
                        <td>${{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td  style="width: 200px; border: 1px solid #ddd; padding: 8px;"><strong>Shipping:</strong></td>
                        <td>${{ number_format($shipping, 2) }}</td>
                    </tr>
                    <tr>
                        <td  style="width: 200px; border: 1px solid #ddd; padding: 8px;"><strong>Total:</strong></td>
                        <td>${{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table> -->
        </div>
        <div class="thank-you-actions">
            <p>Check your email for the receipt or visit your account dashboard for more information.</p>
            <a href="/">Go to Homepage</a>
        </div>
    </div>
</section>








@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
        toastr.success('{{ session('success') }}', 'Success');
        @endif
    });
</script>
@endpush
@endsection
