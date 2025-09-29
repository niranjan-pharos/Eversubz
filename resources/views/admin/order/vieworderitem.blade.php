<!-- resources/views/admin/orders/view.blade.php -->

@extends('admin.template.master')

@section('content')

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    h3, h4 {
        margin-bottom: 20px;
        color: #007bff;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 1px;
    }

    section {
        padding: 30px 0;
    }

    .order-details {
        margin-bottom: 30px;
    }

    .order-details .card {
        border: none;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-body .card{height: 250px;}
    .card-body {
        padding: 20px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center; 
        background-color: #007bff !important;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .order_id{
        align-text: left;
    }
    .order_date{
        align-text: right;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
        display: flex;
        align-items: center;
    }

    .card-title i {
        margin-right: 10px;
        color: #007bff;
    }

    .card p {
    
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    }

    .badge1 {
        color: #fff;
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 5px;
    }

        .table {
            margin-top: 20px;
        }
        .table-bordered td, .table-bordered th {
        border-width: 0px 0px 2px 0px;
        border-color: #aaa;
        border-radius: 0px;
        border-right: 0px;
        padding: 20px 10px;
        border-left: 0px;
        white-space: nowrap;
        color: #595959;
        font-size: 14px;
    }
        .table th {
            background-color: #007bff36;
        color: #000000;
        text-transform: uppercase;
        font-size: 14px;
        padding: 10px;
        }

        .table td {
            padding: 10px;
            font-size: 14px;
            vertical-align: middle;
        }

        .odd-row {
            background-color: #f9f9f9;
        }

        .even-row {
            background-color: #ffffff;
        }

        .custom-table {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;  table-layout: auto; 
        }

        .custom-table th, .custom-table td {
            vertical-align: middle;
            padding: 12px;
            font-size: 14px; white-space: normal !important;
            word-break: break-word;
        }


        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
  @media (max-width: 767.98px) {
    .custom-table thead {
      display: none;
    }

    .custom-table,
    .custom-table tbody,
    .custom-table tr,
    .custom-table td {
      display: block;
      width: 100%;
    }

    .custom-table tr {
      margin-bottom: 1rem;
      border-radius: 8px;
    }

    .custom-table td {
      text-align: right;
      padding-left: 50%;
      position: relative;
    }

    .custom-table td::before {
      content: attr(data-label);
      position: absolute;
      left: 10px;
      top: 10px;
      font-weight: bold;
      text-align: left;
      white-space: nowrap;
    }

  }
</style>

<section class="inner-section category-part myads-part">
    <div class="container">
        <div class="row">
            <div class="order-details">
                <h3>Order Details</h3>
                <div class="card">
                    <div class="card-header">
                        <span class="order_id">Order ID: {{ $order->order_product_unique_id }}</span> 
                        <span class="order_date"> Order Date: {{ $order->created_at->format('d-m-Y H:i') }}</span>
                    </div>
                    

                    <div class="card-body">
                        <div class="row">
                            <!-- User Details -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-user"></i> User Details</h5>
                                        <hr>
                                        <p><strong>Full Name:</strong> {{ $order->full_name }}</p>
                                        {{-- <p><strong>User ID:</strong> {{ $order->user_id ?? 'Guest' }}</p> --}}
                                        <p><strong>Email:</strong> {{ $order->email ?? $order->guest_email }}</p>
                                        <p><strong>Phone Number:</strong> {{ $order->phone_number ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- User Address -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> User Address</h5>
                                        <hr>
                                        <p><strong>Address:</strong> {{ $order->address }}</p>
                                        <p><strong>City:</strong> {{ $order->city }}</p>
                                        <p><strong>State:</strong> {{ $order->state }}</p>
                                        <p><strong>Zip Code:</strong> {{ $order->zip_code }}</p>
                                        <p><strong>Country:</strong> {{ $order->country }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Information -->
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Order Information</h5>
                                        <hr>
                                        <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                                        <p><strong>Comments:</strong> {{ $order->comments }}</p>
                                        <p><strong>Payment Status:</strong> <span class="badge1 bg-success">{{ ucfirst($order->payment_status) }}</span></p>
                                        <p><strong>Payment ID:</strong> {{ $order->payment_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <h4>Order Items</h4>
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle custom-table mb-0">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Seller Name</th>
                <th>Order Status</th>
                <th>Customer Status</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                @php
                    $statusColors = [
                        'pending' => 'secondary',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'received' => 'success',
                    ];
                    $sellerColor = $statusColors[$item->status] ?? 'dark';
                    $customerColor = $statusColors[$item->customer_status] ?? 'dark';
                @endphp
                <tr>
                    <td data-label="Product Name">{{ $item->product->title ?? 'N/A' }}</td>
                    <td data-label="Seller Name">{{ $item->product->businessInfo->business_name ?? 'N/A' }}</td>
                    <td data-label="Seller Status">
                        <span class="badge1 bg-{{ $sellerColor }}">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td data-label="Customer Status">
                        <span class="badge1 bg-{{ $customerColor }}">{{ ucfirst($item->customer_status ?? 'N/A') }}</span>
                    </td>
                    <td data-label="Quantity">{{ $item->quantity }}</td>
                    <td data-label="Price">${{ number_format($item->price, 2) }}</td>
                    <td data-label="Total">${{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#orderTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true
    });
});
</script>

@endsection