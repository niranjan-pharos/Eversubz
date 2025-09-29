@extends('frontend.template.master')
@section('title', 'Checkout')
@section('description', 'Checkout - Eversubz')
@section('content')
@push('style')
<style>
    .shipping-tab {
          cursor: pointer;
    transition: 0.3s;
    box-shadow: 0px 4px 0px rgba(0, 0, 0, 0.1);
    padding: 13px;
    }
    .shipping-tab.active {
        border: 2px solid #007bff;
        background-color: #eef4ff;
    }
    .shipping-option  p{
           line-height: 20px;
    margin-top: 8px;
    font-size: 15px;
    }

 .shipping-option h4 {
    font-size: 18px;
    line-height: 26px;
    font-weight: 500;
    }
    body {
        background-color: #ffffff;
    }

    .loader {
        display: inline-block;
        font-size: 14px;
        color: #007bff;
    }

    .loader span {
        font-weight: bold;
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
    background-color:#0044bbd9 !important;
    margin-bottom: 0px;
    padding: 10px 10px !important;
    }
    .card-header h5 {
        margin: 0;font-size: 17px;
        color:white;
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
        
        margin-bottom: 60px;  

    }
    .order-summary-section .card-header{
        background-color: var(--primary) !important;}
        .order-summary-section .card-header h5{color: #fff;}
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

    .checkout-cart-product-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .col-md-3.col-6{display: flex
    ;
        justify-content: center;}
    .cart-item-img {}

    .cart-item-remove {
        display: flex;
        align-items: center;
    }

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
        margin-top: 7px;
        font-size: 14px;
        line-height: normal;

        align-items: center;
        color: #000;
        font-weight: 600;
    }

    .list-group-item {
        border: none;
        padding: .75rem 0px 0px
    }

    .list-group-item.shipping-price {
        font-size: 14px;
    }
    .tab-content .tab-pane {
        padding: 30px;
        margin-top: 23px;
        background: #eeeeee47;
        box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px !important;
    }

    .inner-section {
        margin-bottom: 0px;
    }

    .sub-total1 {
        color: #000;
        padding-top: 20px;
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
        width: 100%;
        padding: 8px 20px !important;
        border-radius: 4px;
        text-align: center;
        color: #fff;
        padding: 2px 10px;
        border-radius: 5px;
        border: 1px solid #2d6ab3;
        background: #1c721c;
    }

    .btn-inline1:hover {
        color: #fff;
        background: #135013;
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
        color: #000000 !important;
        background: #f5f5f5 !important;
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


    .card-body .form-group {
        position: relative;
        margin-bottom: 30px;
    }

    .card-body .form-group label {
        position: absolute;
        left: 25px;
        top: 7px;
        font-size: 14px;
        color: #000;
        pointer-events: none;
        transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            color 0.3s ease;
    }

    .card-body .form-group .form-control {
        padding-top: 15px; /* Space for the label */
    }

    .card-body .form-group .form-control:focus + label,
    .card-body .form-group .form-control:not(:placeholder-shown) + label {
        top: -22px; /* Moves the label above the input */
        font-size: 12px; /* Shrinks the label */
        color: #007bff; /* Change label color when focused */
    }

    .card-body .form-group .form-control:focus {
        border-color: #007bff; /* Customize the focus color */
    }

 
    .col-lg-7, .col-lg-5{    padding: 0px 7px;}

        /* background-color: #ffffff;
        box-shadow: 0px 0px 4px rgba(45, 107, 180, 0.2);
        transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            color 0.3s ease,
            box-shadow 0.3s ease; */


    .table td {
        border: none;
        padding: .75rem 6px;
    }

    .table tfoot {
        border-top: 1px solid #dee2e6;
    }

    .card-text1 {
        font-size: 25px;
        color: #000;
        font-weight: 700;
        border-top: 1px solid;
        margin-bottom: 20px;
        margin-top: 10px;
        padding-top: 20px;
    }

    .row.fw-bold {
        border-bottom: 1px solid;
        margin-bottom: 10px;

        padding-bottom: 20px;
    }

    .card-text {
        font-size: 16px;
        font-weight: 600;
        color: #000;
        padding-bottom: 8px;
    }


    .checkout-section .container {
        max-width: 1225px;
    }

    .card-body {
        padding: 30px;
    }

    .card-body .container {
        padding: 0px;
    }
    .text4{    display: flex
    ;
        justify-content: space-between;}
    .text2{font-size: 13px;
        color: #000;}
    .text3{    color: #000;
        font-size: 14px;
        margin-left: 16px;
        font-weight: 600;}
    .order-summary-section .col-md-9,
    .order-summary-section .col-9,
    .order-summary-section .col-md-6,
    .order-summary-section .col-3,
    .order-summary-section .col-4,
    .order-summary-section .col-md-3 {
        /* padding: 0px; */
    }
    .row .col-4.text-end,
    .row .col-4.text-end{text-align: end;}
    .col-lg-5.mt-4.desktop{display:none}

    .checkout-section{
        padding: 80px 0px;
    }

    .nav-tabs li {
        color: #fff !important;
        background: #0044bb !important;
        border-radius:6px;
    }
    .nav-tabs button {
        color: #fff !important;
        background: #0044bb !important;
        border-radius:6px;
    }
    .nav-tabs button:hover, .nav-tabs a:hover {
        color: #fff !important;
        background: #0044bb !important;
        border-radius:6px;
    }

    .nav-tabs li a{
        color: #fff !important;
    }

    .nav-tabs li .active {
        color: #fff !important;
        background: #1c721c !important;
    }

    .form-control {
        background: white !important;
    }
    .checkout-section{
        padding:80px 0px;
    }

    .pd-01{
            padding: 0px 8px;
    }
    @media only screen and (max-width: 767px) {
        .col-lg-5.mt-4.desktop{display:block}
        .col-lg-5.mt-4.desktop .order-summary-section{margin-bottom: 20px;}

        .col-lg-5.mt-4.mobile .card-header.desktop {display:none;}
        .col-lg-5.mt-4.mobile .card-body .mobile{display:none;}
        .mobile-section1 {}

        .mobile-section2 {
            font-size: 15px;
        }

        .cart-item-name,
        .cart-item-qty,
        .cart-item-price,
        .edit-cart {
            font-size: 13px;

        }

        .sub-total1 {
            font-size: 18px;
        }

        .card-text1 {
            font-size: 20px;
        }

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
        .checkout-section {
            padding: 0px 0px;
        }
        .md-none{
            display: none;
        }

    }
</style>
@endpush


<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Checkout</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="checkout-section">
    <div class="container">
        <form id="checkout-form">
            @csrf
            <div class="row">

                @if (empty(Auth::user()))
                <div class="col-lg-12 pd-01">
                    <div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link sign-in" href="{{ route('user.login') }}" role="tab">Sign In</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link checkout-btn" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Checkout As
                                    Guest</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade card" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="mb-3">
                                    <label for="guest_email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="guest_email" id="guest_email"
                                        placeholder="Enter your email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12 mb-4 md-none">
                    <h3>Welcome back, {{ Auth::user()->name }}!</h3>
                </div>
                @endif
                @php
                    \Log::info($cartItems);
                @endphp
            
                <div class="col-lg-5 mt-4 desktop">
                    <div class="card order-summary-section ">
                        <div class="card-header">
                            <h5>Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="container mobile">
                                @foreach($cartItems as $item)
                                    @php
                                        $product = \App\Models\BusinessProduct::find($item->id);
                                        $itemTotal = $item->price * $item->quantity;
                                    @endphp

                                    <div class="row mb-3">
                                        <div class="col-md-3 col-4">
                                            <img src="{{ $item->attributes->image ? asset('storage/'.$item->attributes->image) : asset('storage/no-image.jpg') }}"
                                                class="checkout-cart-product-img" alt="Product Image">
                                        </div>
                                        <div class="col-md-9 col-8">
                                            <p class="cart-item-name mb-0">{{ $item->name }}</p>
                                            <div class="text4">
                                                <span class="text2">{{ $item->quantity }}x</span>
                                                <span class="text3">${{ number_format($itemTotal, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                <div class="row mt-3 sub-total1">
                                    <div class="col-8">Sub Total:</div>
                                    <div class="col-4 text-end">${{ number_format($subTotal, 2) }}</div>
                                </div>
                                <div class="row card-text">
                                    <div class="col-8">Shipping:</div>
                                    <div class="col-4 text-end">
                                        @if (empty($shipping) || $shipping == 0)
                                            Free
                                        @else
                                            {{ config('constants.CURRENCY_SYMBOL') }}{{ number_format($shipping, 2) }}
                                        @endif
                                    </div>                                    
                                </div>
                                <div class="row card-text1">
                                    <div class="col-8">Total:</div>
                                    <div class="col-4 text-end">
                                        <p class="total-price2">${{ number_format($total, 2) }}</p>
                                    </div>
                                </div>

                                
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 mt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Pickup Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="shipping-option border rounded  text-center shipping-tab active" id="tab-eversabz" onclick="selectShipping('eversabz')">
                                        <input type="radio" name="shipping_method" id="shipping_delivery" value="eversabz" class="d-none" checked>
                                        <h4>Pickup from Eversabz</h4>
                                         <p>You can pick up your order directly from our Eversabz location.
                                            </p>
                                       <!--  <label for="shipping_delivery" class="mb-0">
                                            <strong>Pickup from Eversabz</strong><br><br>
                                            <small>You can pick up your order directly from our Eversabz location.
                                            </small>
                                        </label> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="shipping-option border rounded text-center shipping-tab" id="tab-seller" onclick="selectShipping('seller')">
                                        <input type="radio" name="shipping_method" id="shipping_pickup" value="seller" class="d-none">
                                         <h4>Pickup from Seller</h4>
                                         <p>You will pick up the order from the seller’s location.
                                            </p>
                                     <!--    <label for="shipping_pickup" class="mb-0">
                                            <strong>Pickup from Seller</strong><br>
                                            <small>You will pick up the order from the seller’s location.</small>
                                        </label> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="card mb-4" id="">{{-- id="address-fields" --}}
                        <div class="card-header">
                            <h5>Your Info</h5>
                        </div>
                        <div class="card-body"> 
                            <div class="row">
                                <input type="hidden" name="order_id" value="{{ $order_id }}">
                                
                                <!-- Full Name -->
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="full_name" required placeholder=" " 
                                        value="{{ $user ? $user->name : '' }}">
                                    <label for="full_name" class="form-label">Full Name</label>
                                </div>
                        
                                <!-- Email -->
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control" name="email" required placeholder=" " 
                                        value="{{ $user ? $user->email : '' }}">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                        
                                <!-- Phone Number -->
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="phone_number" required placeholder=" " maxlength="15" 
                                    value="{{ $user && $user->phone ? $user->phone : '' }}">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                </div>
                        
                                <!-- Address -->
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="address" required placeholder=" " 
                                        value="{{ $user && $user->address ? $user->address : '' }}">
                                    <label for="address" class="form-label">Address</label>
                                </div>
                        
                                <!-- City -->
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="city" required placeholder=" " 
                                        value="{{ $user && $user->permanent_city ? $user->permanent_city : '' }}">
                                    <label for="city" class="form-label">City</label>
                                </div>
                        
                                <!-- State -->
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="state" required placeholder=" " 
                                    value="{{ $user && $user->permanent_state ? $user->permanent_state : '' }}">
                                    <label for="state" class="form-label">State</label>
                                </div>
                        
                                <!-- Zip Code -->
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="zip_code" required placeholder=" " 
                                        value="{{ $user ? '' : '' }}">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                </div>
                        
                                <!-- Country -->
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="country" required placeholder=" "
                                        value="{{ $user && $user->permanent_country ? $user->permanent_country : '' }}">
                                    <label for="country" class="form-label">Country</label>
                                </div>
                        
                                <!-- Comments -->
                                <div class="col-md-12 form-group">
                                    <textarea name="comments" class="form-control" placeholder="">{{ old('comments') }}</textarea>
                                    <label for="comments" class="form-label">Comments/Instructions</label>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Payment Information</h5>
                            <div>
                                <img src="https://eversabz.com/assets/images/pay-card/01.jpg"
                                    style="width: 40px;margin-right: 10px;">
                                <img src="https://eversabz.com/assets/images/pay-card/02.jpg"
                                    style="width: 40px;margin-right: 10px;">
                                <img src="https://eversabz.com/assets/images/pay-card/03.jpg"
                                    style="width: 40px;margin-right: 10px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="payment-form-container">
                                <div id="card-container"></div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mobile ">
                    <div class="card order-summary-section ">
                        <div class="card-header desktop">
                            <h5>Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="container mobile">
                                @foreach($cartItems as $index => $item)
                                <input type="hidden" name="cartItems[{{ $index }}][product_id]"
                                    value="{{ Crypt::encryptString($item->id) }}">
                                <input type="hidden" name="cartItems[{{ $index }}][quantity]"
                                    value="{{ $item->quantity }}">
                                <input type="hidden" name="cartItems[{{ $index }}][price]" value="{{ $item->price }}">
                                @endforeach


                                @php $subTotal = 0; $shipping = 0; @endphp

                                @foreach($cartItems as $item)
                                @php
                                    $product = \App\Models\BusinessProduct::find($item->id);
                                    $itemTotal = $item->price * $item->quantity;
                                    $subTotal += $itemTotal;
                                @endphp

                                <div class="row mb-3">
                                    <div class="col-md-3 col-4">
                                        <img src="{{ $item->attributes->image ? asset('storage/'.$item->attributes->image) : asset('storage/no-image.jpg') }}"
                                            class="checkout-cart-product-img " alt="Product Image">
                                    </div>
                                    <div class="col-md-9 col-8">
                                        <p class="cart-item-name mb-0">{{ ($item->name) }}</p>
                                        <div class="text4">
                                        <span class="text2">{{ $item->quantity }}x</span>
                                    
                                        <span class="text3">${{ number_format($itemTotal, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="row mt-3 sub-total1">
                                    <div class="col-8">Sub Total:</div>
                                    <div class="col-4 text-end">${{ number_format($subTotal, 2) }}</div>
                                </div>
                                <div class="row card-text">
                                    <div class="col-8">Shipping:</div>
                                    <div class="col-4 text-end">
                                        @if ($shipping == 0)
                                            Free
                                        @else
                                            ${{ number_format($shipping, 2) }}
                                        @endif
                                    </div>
                                </div>
                                @php 
                                    $total = $subTotal + $shipping; 
                                @endphp
                                <div class="row card-text1">
                                    <div class="col-8">Total:</div>
                                    <div class="col-4 text-end">
                                        <p class="total-price2">${{ number_format($total, 2) }}</p>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="container desktop">
                            <div class="row mt-3">
                                @if($total >= 1)
                                    <div class="col-12 text-end">
                                        <button id="card-button" type="button" class="btn btn-inline1">Submit Order Now</button>
                                    </div>
                                    @else
                                    <div class="col-12 text-end">
                                        <button id="card-button" type="button" class="btn btn-inline1">Book Now</button>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </form>
    </div>
</section>
@push('scripts')
<script src="https://web.squarecdn.com/v1/square.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function selectShipping(method) {
        console.log("Method="+method);
        document.getElementById('shipping_delivery').checked = method === 'eversabz';
        document.getElementById('shipping_pickup').checked = method === 'seller';

        document.getElementById('tab-eversabz').classList.remove('active');
        document.getElementById('tab-seller').classList.remove('active');
        
        document.getElementById('tab-' + method).classList.add('active');

    }

    function toggleAddress(show) {
        const addressSection = document.getElementById('address-fields');
        addressSection.style.display = 'block';
        
        addressSection.querySelectorAll('input, textarea').forEach(input => input.required = true);
    }

    document.addEventListener("DOMContentLoaded", function () {
        const method = document.querySelector('input[name="shipping_method"]:checked')?.value || 'eversabz'; 
        console.log("Shipping method:", method);

        selectShipping(method);
    });

</script>



<script>
  document.addEventListener('DOMContentLoaded', async function () {
    const form = document.getElementById('checkout-form');
    const submitButton = document.getElementById('card-button');
    const shippingMethod = form.querySelector('input[name="shipping_method"]:checked').value;

    const appId = "{{ config('services.square.application_id') }}";
    const locationId = "{{ config('services.square.location_id') }}";

    let payments;
    let card;

    try {
        payments = Square.payments(appId, locationId);
        card = await payments.card();
        console.log('Card instance:', payments);
        await card.attach('#card-container');
    } catch (error) {
        toastr.error('Failed to initialize payment system. Please refresh and try again.');
        return;
    }

    submitButton.addEventListener('click', async function (event) {
        event.preventDefault();

        let nonce;
        try {
            const result = await card.tokenize();
            if (result.status !== 'OK') {
                throw new Error(result.errors ? result.errors.map(e => e.message).join(', ') : 'Card tokenization failed.');
            }
            nonce = result.token;
        } catch (error) {
            toastr.error('Failed to tokenize card. Please check your card details.');
            console.error('Tokenization error:', error);
            return;
        }

        const guestEmailField = document.querySelector('input[name="guest_email"]');
        const guestEmail = guestEmailField ? guestEmailField.value.trim() : null;

        if (!{{ Auth::check() ? 'true' : 'false' }} && (!guestEmail || guestEmail === '')) {
            toastr.error('Please log in or provide a guest email.');
            if (guestEmailField) guestEmailField.classList.add('is-invalid');
            return;
        }
        if (guestEmailField) guestEmailField.classList.remove('is-invalid');

        const requiredFields = ['full_name', 'email', 'phone_number', 'address', 'city', 'state', 'zip_code', 'country'];
        let isValid = true;

        requiredFields.forEach(fieldId => {
            const field = form.querySelector(`[name="${fieldId}"]`);
            if (!field || field.value.trim() === '') {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        const phoneField = form.querySelector('[name="phone_number"]');
        const phoneRegex = /^[\d\-+()\s]{1,16}$/;
        if (phoneField && !phoneRegex.test(phoneField.value.trim())) {
            isValid = false;
            phoneField.classList.add('is-invalid');
        } else if (phoneField) {
            phoneField.classList.remove('is-invalid');
        }

        if (!isValid) {
            toastr.error('Please fill in all required fields correctly.');
            return;
        }

        submitButton.disabled = true;
        const loader = document.createElement('span');
        loader.classList.add('spinner-border', 'spinner-border-sm', 'ml-2');
        submitButton.appendChild(loader);

        try {
            const formData = new FormData(form);
            const payload = { nonce, shipping_method: shippingMethod };
            const cartItems = [];

            console.log('Form Data:', formData);
            console.log('Initial Payload:', payload);

            formData.forEach((value, key) => {
                const match = key.match(/^cartItems\[\d+\]\[(.+)\]$/);
                if (match) {
                    const field = match[1];
                    if (cartItems.length === 0 || field === 'product_id') {
                        cartItems.push({ [field]: value });
                    } else {
                        cartItems[cartItems.length - 1][field] = value;
                    }
                } else {
                    payload[key] = value;
                }
            });

            payload.cartItems = cartItems;

            console.log('Processed Payload:', payload);

            const response = await fetch('{{ route('checkout.process') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            if (!response.ok) {
                const data = await response.json();

                console.log('Response Error Data:', data);

                if (response.status === 422) {
                   Object.values(data.errors).flat().forEach((error) => toastr.error(error));
                } else {
                    toastr.error(data.message || 'An unexpected error occurred.');
                }
                return;
            }

            const data = await response.json();

            console.log('Response Data:', data);

            if (data.success) {
                toastr.success("Order Placed. <br />Payment successful!");
                $('#checkout-form')[0].reset();
                const redirectUrl = data?.data?.redirect_url;
                if (redirectUrl) {
                    setTimeout(function () {
                    window.location.href = redirectUrl;
                    }, 2000);
                }
            } else {
                throw new Error(data.message || 'Payment failed.');
            }
        } catch (error) {
            toastr.error(error.message || 'An error occurred during payment.');
            console.error('Payment error:', error);
        } finally {
            submitButton.disabled = false;
            const loader = submitButton.querySelector('.spinner-border');
            if (loader) loader.remove();
        }

    });

});


</script>


@endpush


@endsection