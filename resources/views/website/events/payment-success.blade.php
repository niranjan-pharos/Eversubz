@extends('frontend.template.master')
@section('title', 'Checkout - Successful')
@section('description', 'Checkout - Eversubz')
@section('content')
@push('style')
  <style>
    body {
      background-color: #F9FAFB;
    }

    .card {
      border-radius: 5px;
      overflow: hidden;
      background: #fff;
    }

    .account-title::before,
    .card-header::before {
      content: none
    }

    .card-header {
      background-color: #2d6bb4;
      color: #fff;
      margin-bottom: 0px;
      padding: 10px ! IMPORTANT;
    }

    .card-header h5 {
      margin: 0;
      color: #fff;
    }

    .btn-custom {
      background-color: #007bff !important;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
    }

    .btn-custom:hover {
      background-color: #0a3d91 !important;
      color: #fff;
    }


    .payment-option.active {
      border-color: #007bff;
      box-shadow: 0 2px 4px rgba(0, 123, 255, 0.5);
    }

    .payment-option input {
      margin-right: 0.5rem;
    }

    .payment-option label {
      font-weight: bold;
    }

    .form-control,
    .form-select {
      border-radius: 5px;
      border: 1px solid #ced4da;
    }

    .form-control:focus,
    .form-select:focus {
      box-shadow: none;
      border-color: #007bff;
    }

    .section-title {
      margin-bottom: 1.5rem;
      color: #007bff;
    }

    .shipping-billing-address {
      margin-top: 2rem;
    }

    .shipping-billing-address h5 {
      color: #007bff;
    }

    .order-summary-section {
      border-top: 2px solid #007bff;

    }

    .order-summary-section .payment-option {
      border: none;
      background: none;
    }

    .order-summary-section .payment-option input {
      margin-right: 0.5rem;
    }

    .order-summary-section .btn-custom {
      display: block;
      width: 50%;
      margin: auto;
      margin-top: 1rem;
    }

    .coupon-section {
      margin-top: 1.5rem;
    }

    .coupon-section input {
      border-radius: 5px;
      border: 1px solid #ced4da;
    }

    .coupon-section button {
      margin-top: 1rem;
    }

    .billing-address {
      display: none;
    }

    .product-image {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
      margin-right: 10px;
    }

    .product-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1rem;
    }

    .product-item img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }

    .product-item .product-details {
      flex: 1;
      margin-left: 10px;
    }

    .product-item .product-price {
      font-weight: bold;
    }

    .badge {
      color: #fff;
      padding: 10px;
      font-size: 16px;
    }

    .cart-item__remove-btn {
      border: 1px solid;
      border-radius: 50%;
      padding: 0px 8px;
      background: #7c7c7c;
      width: 25px;
      height: 27px;
      color: #fff;
      font-size: 12px;
    }
    .checkout-cart-product-img{width: 130px;
        height: 85px;
        object-fit: contain;}
    .cart-item-img{}
    .cart-item-remove{display: flex;
      align-items: center;}
    .cart-item-qty {
      font-size: 13px;
    }

    .card-column {
      column-gap: 10px;
    }

    .checkout-item {
      padding-bottom: 15px;
      column-gap: 10px;
    }

    .item-cart1 {
      border-bottom: 1px solid;
      margin-bottom: 1px;
    }

    .cart-item-name,
    .cart-item-qty,
    .cart-item-price,
    .edit-cart {
      font-size: 16px;
      line-height: normal;
      display: flex;
      align-items: center;
      color: #000;
      font-weight: 500;
    }

    .list-group-item {
      border: none;
      padding: .75rem 0px 0px
    }

    .list-group-item.shipping-price {
      font-size: 14px;
    }

    .tab-content .tab-pane {
      padding: 20px;
    }

    .inner-section {
      margin-bottom: 0px;
    }

    .sub-total1 {
      color: #000;
      padding-top: 10px;
      border-top: 1px solid;
      font-weight: bold;
      font-size: 20px;
      margin-bottom: 0.5rem;
    }

    .gst-price1 {
      color: #000;
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 0.5rem;
    }

    .total1 {
      font-weight: bold;
      font-size: 25px;
      color: #000;
      margin-bottom: 0.5rem;
      padding-top: 10px;
    }

    .btn-inline1 {
      padding: 8px 20px !important;
      border-radius: 4px;
      text-align: center;
      color: #fff;
      padding: 2px 10px;
      border-radius: 5px;
      border: 1px solid #2d6ab3;
      background: #28A745;
    }

    .btn-inline1:hover {
      color: #fff;
      background: #1c721c;
    }

    .checkout-btns {
      display: flex;
      justify-content: space-between;
      margin-top: 25px;
    }

    .checkout-btns2 {
      display: flex;
      justify-content: end;
      margin-bottom: 25px;
    }

    .nav-tabs .nav-item {
      width: 307px;
    }

    .nav-tabs li .nav-link {
      width: 100%;
      border: none;
      padding: 10px;
      border: 1px solid #0044bb;
      font-size: 18px;
      text-transform: capitalize;
      border-radius: 5px;
    }

    .nav-tabs li .active {
      color: var(--chalk) !important;
      background: var(--primary) !important;
      border-color: var(--primary) !important;
    }

    .nav-tabs li .nav-link:hover {
      background: var(--chalk);
      border-color: #fff0;
      border: 1px solid #0044bb;
    }

    .nav.nav-tabs {
      justify-content: left;
      border-bottom: none;
      display: flex;
      column-gap: 20px;
    }

    .card-body {
      padding-top: 30px;
    }

    .card-body .form-group {
      position: relative;
      margin-bottom: 30px;
    }

    .card-body .form-group label {
      position: absolute;
      left: 25px;
      top: 12px;
      font-size: 14px;
      color: #777;
      pointer-events: none;
      transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                  font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                  color 0.3s ease;
    }

    .card-body .form-group input {
      font-size: 14px;
      transition: border-color 0.3s ease; /* Smooth border color transition */
    }

    .card-body .form-group input:focus {
      border-color: #2d6bb4;
      outline: none;
    }

    .card-body .form-group input:focus + label,
    .card-body .form-group input:not(:placeholder-shown) + label {
      top: -20px;
      font-size: 12px;
      color: #2d6bb4;
      padding: 0 4px;
      border-radius: 4px;
      left: 17px;
      /* Optional background effect for smoother label visibility */
      background-color: #ffffff;
      box-shadow: 0px 0px 4px rgba(45, 107, 180, 0.2);
      transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                  font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                  color 0.3s ease, 
                  box-shadow 0.3s ease;
    }


    @media only screen and (max-width: 767px) {

      .nav-tabs .nav-item {
        width: 100%;
        margin: 0px 0px 5px;
      }

      .nav.nav-tabs {
        margin: 0px 0px;
        display: block;
      }

      .tab-content .tab-pane {
        margin-bottom: -10px;
      }
    }
  </style>
@endpush


<section class="inner-section single-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="single-content">
          <h2>Success</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Success</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="py-5">
    <div class="container py-5">
        <div class="text-center">
            <h1>Payment Successful</h1>
            <p>Thank you, {{ $order->first_name }} {{ $order->last_name }}, for your payment!</p>
            <p>Your order has been confirmed. Here are your details:</p>
    
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body">
                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p><strong>Transaction ID:</strong> {{ $order->payment_id }}</p>
                    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    @if ($order->receipt_url)
                        <p><a href="{{ $order->receipt_url }}" target="_blank">View Receipt</a></p>
                    @endif
    
                    <h5>Tickets:</h5>
                    <ul>
                        @foreach($tickets as $ticket)
                            <li>{{ $ticket->quantity }} x {{ $ticket->ticket_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
    
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Return to Home</a>
        </div>
    </div>
</section>


@endsection
