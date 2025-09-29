@extends('frontend.template.master')
@section('title', 'Event Ticket Details')
@section('content')

    @push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <style>
            .is-invalid {
                border: 2px solid red;
            }

            body {
                background: #ffffff;
                }

            input[type="text"],
            input[type="email"],
            input[type="tel"] {}

            input[type="text"]:hover,
            input[type="email"]:hover,
            input[type="tel"]:hover {
                border-color: #cbd5e0
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="tel"]:focus {
                border-color: #3182ce;
                box-shadow: 0 0 0 2px rgba(49, 130, 206, 0.3)
            }

            input[type=number]::-webkit-outer-spin-button,
            input[type=number]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0
            }

            input[type=number] {
                -moz-appearance: textfield
            }



            #ticket-summary h2 {
                font-size: 1.25rem;
                font-weight: bold;
                color: #2d3748;
                margin-bottom: 15px
            }

            #summary-list li {
                font-size: 0.9rem;
                color: #000;
                margin-bottom: 8px;
                line-height: 1.5;
                display: flex;
                justify-content: space-between;
            }

            #summary-list li .ticket-name {
                font-weight: 600;
            }

            #summary-list li .ticket-price {
                font-weight: 600;
            }

            #ticket-summary.subtotal,
            #ticket-summary.fees,
            #ticket-summary.total {
                font-size: 1rem;
                color: #2d3748;
                margin: 10px 0
            }

            #ticket-summary.subtotal {
                font-weight: normal
            }

            #ticket-summary.fees {
                font-size: 0.85rem;
                color: #718096
            }

            #ticket-summary.total {
                font-weight: bold;
                font-size: 1.1rem
            }

            .order-text1 {
                display: flex;
                justify-content: space-between;
            }

            .order-text1.total {
                padding-top: 1rem;
                border-top: 1px solid;
            }

            input:focus {
                outline: none !important;
                box-shadow: none !important;
            }

            .accordion-content h3 {
                font-weight: 700;
                font-size: 20px;
            }

            .accordion-content p {}

            .accordion-content p strong {
                font-weight: 600;
            }

            .ticket-type-border-bottom {
                border-bottom: 1px solid #ddd;
                padding-bottom: 10px;
            }

            .glyphicon-plus:before {
                content: "\2b";
            }

            .glyphicon-euro:before {
                content: "\20ac";
            }

            .glyphicon-minus:before {
                content: "\2212";
            }

            .glyphicon-plus-sign:before {
                content: "\e081";
            }

            .glyphicon-minus-sign:before {
                content: "\e082";
            }

            .inner-section {
                margin-bottom: 0px;
            }

            .panel-group .panel {
                border-radius: 0;
                box-shadow: none;
                border-color: #EEEEEE;
            }

            .panel-default>.panel-heading {
                padding: 10px 20px 10px 15px;
                border-radius: 2px;
                color: #212121;
                background-color: #e9e9e9;
                border-color: #EEEEEE;
            }

            .panel-title>strong>a {
                display: block;
                color: #000;
            }

            .more-less {
                margin-right: 7px;
            }

            .panel-default>.panel-heading+.panel-collapse>.panel-body {
                border-top-color: #EEEEEE;
            }

            .card {
                margin-bottom: 30px;
                border-radius: 5px;  
            }

            .account-title::before,
            .card-header::before {
                content: none;
            }

            .card-header h5 {
                margin: 0;color: #fff;
            }

            .card1 .card2 h3 {
                margin-bottom: 10px;
            }

            .card1 .card2 p {
                color: #000;
                margin-bottom: 10px;
            }

            .card2,
            #cart-section .list-unstyled, #square-payment-form, .user-details-form .row{
                padding: 10px 10px;
            }
            .panel-group {
                padding: 0px 20px 10px;
            }

            .qty-buttons {
                font-size: 25px;
            }

            #cart-section ul li .div1 {
                display: flex;
                column-gap: 20px;
                align-items: center;
            }

            #cart-section ul li {
                column-gap: 25px;
                /* display: flex; */
            }

            #cart-section ul li h3 {
                margin-bottom: 0px;
                font-size: 18px;
                color: #000;
                font-weight: bold;
            }

            #cart-section ul li dl {
                font-size: 15px;
            }

            #cart-section ul li .div1 img {
                width: 70px;
            }

            #cart-section ul li .div12 {
                column-gap: 10px;
                border: 1px solid #2d6bb480;
                padding: 0px 20px;
                border-radius: 5px;
            }

            #cart-section ul li .div12 input {
                width: 40px;
                height: 40px;
                padding: 0px 12px;
            }

            .form-control,
            .form-select {
                border-radius: 5px;
                border: 1px solid #ced4da;
                color: #000;
                padding: 10px;
            }

            .btn-inline1 {
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

            .btn-secondary {
                color: #fff;
                padding: 8px 20px !important;
                width: 125px;
                border-radius: 5px;
                border: 1px solid #2d6ab3;
                background: #5a6268;
            }

            .btn-secondary:hover {
                color: #000;
                background-color: #5a626861;
                border-color: #545b62;
            }

            .checkout-teckit-1 button{    width: 325px;    height: 50px;
                margin: 0px !important;}
                #to-step-2{    margin-left: auto;
                    margin-right: 20px;
            width: 325px;
            justify-content: center;
            display: flex;
            margin-top: 30px;}

            .sq-input-wrapper {
                margin: 0px 10px;
            }
            .sq-card-wrapper .sq-card-iframe-container {
                height: 50px !important;
            }

            .order-summary-titles {
                font-size: 0.9rem;
                color: #000
            }

            .order-summary-titles2 {
                font-size: 20px;
                color: #000;
                border-top: 1px solid #bbb;
            }

           
            .order-summary-titles2 .span12 {
                font-weight: 600;
            }

            .order-summary-titles1 {
                font-size: 25px;
                color: #000;
                font-weight: 700;
                border-top: 1px solid;
                margin-bottom: 10px;
                margin-top: 10px;
                padding-top: 10px;
            }

            .order-summary-titles1 .span12 {
                font-weight: 800;
            }

            .card-header {
                background-color: #0044bb !important;
                margin-bottom: 0px;
                padding: 5px 10px !important;border-radius: 5px 5px 0px 0px !important;
            }
            #ticket-summary .card-header{ border-top: none !important;   background-color: #f5f5f5 !important;}
            #ticket-summary .card-header h5{color: #000;}
            .card-header1{margin-bottom: 10px;
                padding: 5px 10px !important;
                display: flex;
                justify-content: space-between;
            }
            .mobile1 {
                display: none;
            }

            .desktop1 {
                display: block;
            }

            .div13 {
                display: flex;
                align-items: center;
            }

            .checkout-button {width: 325px;
                padding: 8px 20px !important;
            }

            .proceed-button{margin: 0px 20px 20px auto;display:flex; justify-content: center;}

            .h4,
            h4 {
                font-size: 19px;
            }

            .nav-tabs .nav-item {
                width: 307px;
               
            }

            .nav-tabs li .nav-link {
                width: 100%;
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
                .tab-content .tab-pane{    margin-bottom: 0px;padding: 20px;}
                            .nav.nav-tabs {
                        
                    justify-content: left;
                    border-bottom: none;
                    display: flex;
                    column-gap: 20px;margin-bottom: 5px;
                            }
                            .nav-tabs li .nav-link:hover {
                    background: var(--chalk);
                    border-color: #fff0;
                    border: 1px solid #0044bb;
                }
                .checkout-teckit-1{display: flex;
                    justify-content: space-between;}

                .form-group {
                position: relative;
                margin-bottom: 30px !important;
                }
            .col-md-12.mb-4.form-group{
                margin-bottom: 0px !important;

            }
                .form-group label {
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
                .form-group input{
                    height: 40px;}
                .form-group input,
                .form-group textarea {
                    font-size: 14px;
                    transition: border-color 0.3s ease;
                    background: #fff;
                    border: 1px solid #bbb;
                    border-radius: 4px;
                                }

                                .form-group input:focus,
                                .form-group textarea:focus {
                                    border-color: #2d6bb4;
                    outline: none;
                    background: #f9f9f9;
                    border: 1px solid #bbb;
                    border-radius: 4px;
                                }
                .col-lg-8, .col-lg-4{  padding: 0px 7px;}
                .form-group input:focus + label,
                .form-group input:not(:placeholder-shown) + label,
                .form-group textarea:focus + label,
                .form-group textarea:not(:placeholder-shown) + label {
                top: -20px;
                font-size: 12px;
                color: #2d6bb4;
                padding: 0 4px;
                border-radius: 4px;
                left: 20px;
                background-color: #ffffff;
                box-shadow: 0px 0px 4px rgba(45, 107, 180, 0.2);
                }

                .user-details-form .row{padding-top:15px;}
                .form-control:focus{    background: #e8f0fe;}



                            @media only screen and (max-width:767px) {
                                .checkout-button {
                    width: 100%;}
                .checkout-teckit-1{display: block;}
                .checkout-teckit-1 button{        margin-bottom: 10px;;width:100% !important;}
                #action-button{margin-bottom: 0px;}
                .nav-tabs .nav-item {
                    width: 100%;
                    margin: 0px 0px 5px;
                }

                .nav.nav-tabs {
                    margin: 0px 0px;display: block;
                }
                .tab-content .tab-pane {
                        margin-bottom: -10px;}
                .main-sections1 {
                    margin-bottom: 70px
                }

                #cart-section ul li {
                    display: block;
                }

                .mobile1 {
                    display: block;
                }

                .desktop1 {
                    display: none;
                }

                #cart-section ul li .div13 {
                    column-gap: 10px;
                    border: 1px solid #2d6bb480;
                    padding: 0px 20px;
                    border-radius: 5px;
                    display: flex;
                    height: 35px
                }

                #cart-section ul li .div1 {
                    margin-bottom: 14px;
                    margin-top: 10px;
                }

                #cart-section ul li .div12 input {
                    height: auto;
                }

                #cart-section ul li .div12 {
                    column-gap: 10px;
                    border: 0;
                    padding: 0;
                    border-radius: 0;
                }

                #cart-section ul li h3 {
                    margin-bottom: 0px;
                    font-size: 16px;
                }

                #cart-section ul li dl {
                    font-size: 13px;
                    line-height: normal;
                }

                #cart-section ul li .div1 img {
                    display: none;
                }

                .card1 .card2 h3 {
                    font-size: 19px;
                }

                .sq-card-wrapper .sq-card-iframe-container {
                    height: auto !important
                }
                .row.d-flex.flex-lg-row{flex-direction: column-reverse;}
            }

            .small,
            small {
                font-size: 90%;
                color: #000;
                font-weight: 400;
            }

            form #card-number-wrapper {
                background: red !important;
            }
           

            .ticket-list {
                list-style: none;
                padding: 0;
            }

            .ticket-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
                border-bottom: 1px solid #ddd;
                width: 100%;
            }

            .ticket-info {
                display: flex;
                flex: 1;
                justify-content: space-between; 
                align-items: center;
            }

            .ticket-info h6 {
                font-size: 1.1rem;
                margin: 0 20px 0 20px;
                flex: 1;
            }

            .ticket-info p {
                color: #555;
                margin-right: 20px;
                flex: 1;
            }

            .ticket-quantity {
                width: 70px; 
                text-align: center;
                padding: 5px;
                margin-left: 15px;
                border: 1px solid #ddd;
                font-size: 1rem; 
            }

            .ticket-item input[type="number"] {
                width: 70px; 
                text-align: center;
                argin-right:20px;
            }

            input[type="number"] {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border-radius: 5px;
                padding: 5px;
            }

            label {
                font-size: 1rem;
                font-weight: bold;
                margin-bottom: 5px;
                display: block;
            }



                .btn {
                    width: 100%;
                    padding: 10px;
                    font-size: 1rem;
                }

                #ticket-summary {
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                }

                .summary-title {
                    font-weight: bold;
                }

                .summary-title, #summary-subtotal, #summary-fees, #summary-total {
                    font-size: 1rem;
                }

                .card-body {
                    padding: 20px;
                }

                .form-control {
                    margin-bottom: 15px;
                }

                .form-step {
                    margin-bottom: 30px;
                }

                .form-step h5 {
                    margin-bottom: 20px;
                }
                h5{
                    margin:10px;
                    font-weight: bold;
                }

                .quantity-section {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: auto;
                    margin-right:10px;
                }

                .quantity-btn {
                    width: 30px;
                    height: 30px;
                    background-color: #f0f0f0;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    font-size: 1.5rem;
                    font-weight: bold;
                    text-align: center;
                    color: #333;
                    cursor: pointer;
                    transition: background-color 0.3s ease, border-color 0.3s ease;
                }

                .quantity-btn:hover {
                    background-color: #ddd;
                    border-color: #aaa;
                }

                .ticket-quantity {
                    width: 50px;
                    height: 30px;
                    text-align: center;
                    margin: 0 5px;
                    padding: 5px;
                    font-size: 1rem;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                .quantity-section button {
                    display: inline-block;
                    padding: 0;
                    height: 30px;
                    line-height: 30px;
                    text-align: center;
                    font-size: 20px;
                    margin:0;
                }

                .quantity-section input {
                    display: inline-block;
                    width: 50px;
                    text-align: center;
                    padding: 5px;
                    margin: 0 5px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                .img-fluid{
                    margin-left:10px;
                }

                .billing-info {
                    margin-top: 20px;
                }

                .form-label {
                    font-weight: 600;
                    font-size: 14px;
                    color: #555;
                }

                .mb-3 {
                    margin-bottom: 1.5rem;
                }

                .row {
                    display: flex;
                    flex-wrap: wrap;
                }

                .col-md-6 {
                    flex: 1;
                    margin-right: 10px;
                    margin-left: 10px;
                }

                .ticket-attendee-fields {
                    margin-bottom: 30px;
                }

                .ticket-attendee-fields h6 {
                    font-size: 18px;
                    margin-bottom: 10px;
                    font-weight: bold;
                    margin-left:10px;
                }

                .ticket-attendee-fields .form-control {
                    margin-bottom: 15px;
                }

                .attendee-fields-row {
                    display: flex;
                    justify-content: space-between;
                }

                .attendee-fields-row .col-md-6 {
                    flex: 0 0 48%;
                }

                .attendee-fields-row label {
                    margin-bottom: 8px;
                }

                .back{
                    padding: 8px 20px !important;
                }

                .is-invalid {
                    border: 1px solid #dc3545;
                }

                .invalid-feedback {
                    display: block;
                    color: #dc3545;
                }


                #to-step-3, #back-to-cart-section {
                    margin-top: 20px;
                }

                #to-step-3 {
                    background-color: #007bff;
                    border: none;
                    padding: 12px 30px;
                    font-size: 16px;
                    color: white;
                    cursor: pointer;
                }

                #back-to-cart-section {
                    background-color: #6c757d;
                    border: none;
                    padding: 12px 30px;
                    font-size: 16px;
                    color: white;
                    cursor: pointer;
                }

                #to-step-3:hover, #back-to-cart-section:hover {
                    opacity: 0.8;
                }
              

                
                @media (max-width: 768px) {
                    .ticket-item {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .ticket-info {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .ticket-quantity {
                        width: 50px;
                        text-align: center;
                        margin: 0 10px;
                        padding: 5px;
                        border: 1px solid #ccc;
                        font-size: 1rem;
                    }
                }


        </style>
@endpush
   
    

            @php
                use Carbon\Carbon;
                $fromDateTime = Carbon::parse($event->from_date_time);
                $toDateTime = Carbon::parse($event->to_date_time);
                $currentDateTime = Carbon::now();
                $eventDateTime = Carbon::parse($event->from_date_time);

                // Determine if the event date is in the future
                $isFutureEvent = $eventDateTime->isFuture();
                $countdownDate = $isFutureEvent ? $eventDateTime->format('Y-m-d\TH:i:sP') : null;
            @endphp


{{-- <pre>
    @dd($event->id)
</pre>  --}}


    <section class="main-sections1 py-5">
        <div class="container">
            <div class="row"> 
                @if (empty(Auth::user()))
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="https://eversabz.com/login" role="tab">Sign In</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Checkout As Guest</button>
                            </li>
                        </ul>
    
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade card" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form class="">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Guest Email address</label>
                                        <input type="email" class="form-control" id="emailInput" placeholder="Enter your email">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 mb-4">
                        <h3>Welcome back, {{ Auth::user()->name }}!</h3>
                    </div>
                @endif
    
                <div class="col-md-12 mt-4">
                    <div class="card card1">
                        <div class="card-header">
                            <h5>About Event</h5>
                        </div>
                        <div class="card2">
                            <h3>{!! $event->title !!}</h3>
                            <p><strong>Date & Time -</strong> {{ $fromDateTime->format('j M \A\T h:i A') }} – {{ $toDateTime->format('j M \A\T h:i A') }}</p>
                            <p><strong>Location -</strong> {!! $event->location !!}, {!! $event->city !!}</p>
                        </div>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <p class="panel-title"><strong>
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed d-flex justify-content-between">
                                            <span>Event Info</span>
                                            <span style="font-size:11px;"><i class="more-less glyphicon glyphicon-plus"></i> More Info</span>
                                        </a></strong>
                                    </p>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <p>{!! $event->event_description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row d-flex flex-lg-row">
                <!-- Left Column - Form Section -->
                <div class="col-lg-8" id="main-section">
                    <div class="card">
                        <form id="payment-form" >
                            @csrf
                            <!-- Step 1: Ticket Quantity Selection -->
                            <div id="cart-section" class="form-step">
                                <h5>Select Tickets</h5>
                                <ul class="ticket-list">
                                    @foreach ($ticketTypes as $ticketType)
                                        <li class="ticket-item">
                                            <div class="ticket-info">
                                                <img src="{{ $ticketType['icon'] }}" alt="{{ $ticketType['name'] }}" class="img-fluid rounded" style="width:60px;height:60px;"/>
                                                <h6>{{ $ticketType['name'] }}
                                                <span class="d-inline">Price for {{ $ticketType['ticket_type'] }}:</span></h6>
                                                <p>{{ ucwords(str_replace('_', ' ', $ticketType['category_name'])) }}</p>
                                                <p>{{ $ticketType['price'] > 0 ? config('constants.CURRENCY_SYMBOL') . number_format($ticketType['price'], 2) : 'Free' }}</p>
                                                
                                                <div class="quantity-section">
                                                    <button type="button" class="quantity-btn decrement">-</button>
                                                    <input type="number" id="quantity-{{ $ticketType['id'] }}" value="0" min="0" class="ticket-quantity" onchange="updateSummary()">
                                                    <button type="button" class="quantity-btn increment">+</button>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                
                                <button type="button" id="to-step-2" class="btn btn-primary" disabled>Continue</button>
                            </div>
                            
                            <!-- Step 2: Billing Info + Attendee Info + Payment Info -->
                            <div id="step-2" class="form-step d-none user-details-form">
                                <h5>User Info</h5>
                                <div class="billing-info">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="first-name" class="form-label">First Name</label>
                                            <input type="text" id="first-name" class="form-control" placeholder="First Name" required />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="last-name" class="form-label">Last Name</label>
                                            <input type="text" id="last-name" class="form-control" placeholder="Last Name" required />
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" class="form-control" placeholder="Email" required />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" id="phone" class="form-control" placeholder="Phone" required />
                                        </div>
                                    </div>
                                </div>
                        
                                
                                <div id="attendee-info-fields"></div>
                                
                                <div id="payment-section">
                                <h5>Payment Information</h5>
                                    <div class="card-body">
                                        <div class="card-header1">                                        
                                            <div>
                                                <img src="https://eversabz.com/assets/images/pay-card/01.jpg" style="width: 40px;margin-right: 10px;">
                                                <img src="https://eversabz.com/assets/images/pay-card/02.jpg" style="width: 40px;margin-right: 10px;">
                                                <img src="https://eversabz.com/assets/images/pay-card/03.jpg" style="width: 40px;margin-right: 10px;">
                                            </div>
                                        </div>
                                        <div id="payment-form-container">
                                            <div id="card-container"></div> <!-- For payment processing -->
                                        </div>
                                        <div class="checkout-teckit-1">
                                            <button id="back-to-cart-section" type="button" class="btn btn-secondary back">Back</button>
                                            <button class="checkout-button mt-4 btn-inline1 proceed-button" id="continue-button">
                                                Pay Now
                                                <div id="loader1" class="spinner-border spinner-border-sm text-light" role="status" style="display:none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="free-download-section" style="display:none;">
                                    <button id="free-download-btn" class="btn btn-success">
                                      Download Ticket
                                      <div id="free-loader" class="spinner-border spinner-border-sm text-light" style="display:none;vertical-align:middle;margin-left:7px;">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                    </button>
                                  </div>
                                  


                            </div>
                        </form>
                        
                    </div>
                </div>
            
                <!-- Right Column - Order Summary -->
                <div class="col-lg-4">
                    <div id="ticket-summary" class="card">
                        <div class="card-header">
                            <h5>Order Summary</h5>
                        </div>
                        <img src="{{ asset('storage/' . $event->main_image) }}" alt="Event Main Image" class="img-fluid rounded mb-4">
                        <div class="card-body">
                            <ul id="summary-list" class="list-unstyled">
                                <!-- Dynamically populated order summary -->
                            </ul>
                            <div class="d-flex justify-content-between">
                                <span class="summary-title">Subtotal</span>
                                <span id="summary-subtotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="summary-title">Booking Fee</span>
                                <span id="summary-fees">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="summary-title">Total</span>
                                <span id="summary-total">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://web.squarecdn.com/v1/square.js"></script>

<script>
    const ticketTypes = @json($ticketTypes);

    document.addEventListener('DOMContentLoaded', function () {
        const continueButton = document.getElementById('to-step-2');
        const cartSection = document.getElementById('cart-section');
        const userDetailsForm = document.getElementById('step-2');
        const continuePayButton = document.getElementById('continue-button');
        const loader = document.getElementById('loader1');
        const freeDownloadBtn = document.getElementById('free-download-btn');
        const freeLoader = document.getElementById('free-loader');
        const paymentSection = document.getElementById('payment-form-container');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const encryptedEventId = "{{ Crypt::encryptString($event->id) }}";
        const cardContainer = document.getElementById('card-container');
        const email = document.getElementById('email');
        const first_name = document.getElementById('first-name');
        const last_name = document.getElementById('last-name');
        const phone = document.getElementById('phone');
        let payments = null, card = null, isInitializing = false;
        let lastUpdateTime = 0;

        function showStep(stepId) {
            [cartSection, userDetailsForm].forEach(step => step.classList.add('d-none'));
            document.getElementById(stepId).classList.remove('d-none');
        }

        continueButton.addEventListener('click', () => {
            populateAttendeeFields();
            showStep('step-2');
        });

        document.getElementById('back-to-cart-section').addEventListener('click', () => showStep('cart-section'));

        function enableProceedButton() {
            const ticketQty = Array.from(document.querySelectorAll('.ticket-quantity'))
                .map(input => parseInt(input.value) || 0)
                .reduce((acc, qty) => acc + qty, 0);
            continueButton.disabled = ticketQty === 0;
        }

        function updateSummary() {
            let subtotal = 0;
            let bookingFee = 0;
            let summaryList = document.getElementById('summary-list');
            summaryList.innerHTML = '';
            ticketTypes.forEach(ticketType => {
                let ord_qty = parseInt(document.getElementById(`quantity-${ticketType.id}`)?.value) || 0;
                let price = parseFloat(ticketType.price);
                let lineTotal = ord_qty * price;
                let accountType = ticketType.account_type;
                if (ord_qty > 0) {
                    subtotal += lineTotal;
                    if (price <= 0) {
                        bookingFee += 0;
                    } else if (accountType == 1) {
                        bookingFee += ord_qty * (price * 0.025 + 0.50);
                    } else {
                        bookingFee += ord_qty * (price * 0.04 + 0.99);
                    }
                    let item = document.createElement('li');
                    item.innerHTML = `${ord_qty} x ${ticketType.name} - $${lineTotal.toFixed(2)}`;
                    summaryList.appendChild(item);
                }
            });
            let total = subtotal + bookingFee;
            document.getElementById('summary-subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('summary-fees').textContent = `$${bookingFee.toFixed(2)}`;
            document.getElementById('summary-total').textContent = `$${total.toFixed(2)}`;
        }

        function updateQuantity(inputId, change) {
            const input = document.getElementById(inputId);
            let currentValue = parseInt(input.value) || 0;
            input.value = Math.max(0, currentValue + change);
            enableProceedButton();
            updateSummary();
            updatePaymentInfoVisibility();
        }

        document.querySelectorAll('.ticket-quantity').forEach(input => input.addEventListener('input', () => {
            enableProceedButton();
            updateSummary();
            updatePaymentInfoVisibility();
        }));

        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const inputId = e.target.closest('.ticket-item').querySelector('input').id;
                const change = e.target.classList.contains('increment') ? 1 : -1;
                updateQuantity(inputId, change);
            });
        });

        function populateAttendeeFields() {
            const attendeeFieldsContainer = document.getElementById('attendee-info-fields');
            attendeeFieldsContainer.innerHTML = '';
            ticketTypes.forEach(ticket => {
                const qty = parseInt(document.getElementById(`quantity-${ticket.id}`)?.value) || 0;
                let attendeeFields = [];
                if (ticket.attendee_fields) {
                    attendeeFields = Array.isArray(ticket.attendee_fields) ? ticket.attendee_fields : JSON.parse(ticket.attendee_fields);
                }
                if (qty > 0 && attendeeFields.length > 0) {
                    const ticketContainer = document.createElement('div');
                    ticketContainer.classList.add('ticket-attendee-fields');
                    for (let i = 0; i < qty; i++) {
                        const attendeeHeading = document.createElement('h6');
                        attendeeHeading.textContent = `${ticket.name} Attendee Information #${i + 1}`;
                        ticketContainer.appendChild(attendeeHeading);
                        const rowContainer = document.createElement('div');
                        rowContainer.classList.add('row');
                        attendeeFields.forEach(field => {
                            if (field && field.label) {
                                const fieldKey = field.label.trim().toLowerCase();
                                const colDiv = document.createElement('div');
                                colDiv.classList.add('col-md-6');
                                const fieldHTML = `
                                    <div class="mb-3">
                                        <label for="ticket-${ticket.id}-attendee-${i}-${fieldKey}" class="form-label">
                                            ${field.label} ${field.required ? '<span class="text-danger">*</span>' : ''}
                                        </label>
                                        <input type="${field.type || 'text'}" 
                                            id="ticket-${ticket.id}-attendee-${i}-${fieldKey}" 
                                            name="attendees[${ticket.id}][${i}][${fieldKey}]" 
                                            class="form-control" 
                                            placeholder="${field.label}" 
                                            ${field.required ? 'required' : ''} />
                                    </div>
                                `;
                                colDiv.innerHTML = fieldHTML;
                                rowContainer.appendChild(colDiv);
                            }
                        });
                        ticketContainer.appendChild(rowContainer);
                        attendeeFieldsContainer.appendChild(ticketContainer);
                    }
                }
            });
        }

        function allSelectedTicketsAreFree() {
            let atLeastOne = false;
            let allFree = true;
            ticketTypes.forEach(ticket => {
                let qty = parseInt(document.getElementById(`quantity-${ticket.id}`)?.value) || 0;
                if (qty > 0) {
                    atLeastOne = true;
                    if (parseFloat(ticket.price) > 0) {
                        allFree = false;
                    }
                }
            });
            return atLeastOne && allFree;
        }

        async function initializePayment() {
            if (!cardContainer) return false;
            if (card || isInitializing || cardContainer.children.length > 0) return true;
            isInitializing = true;
            try {
                cardContainer.innerHTML = '';
                payments = Square.payments("{{ config('services.square.application_id') }}", "{{ config('services.square.location_id') }}");
                card = await payments.card();
                await card.attach('#card-container');
            } catch (error) {
                toastr.error('Failed to initialize payment system. Please refresh and try again.');
                return false;
            } finally {
                isInitializing = false;
            }
            return true;
        }

        function updatePaymentInfoVisibility() {
            const now = Date.now();
            if (now - lastUpdateTime < 500) return;
            lastUpdateTime = now;
            const paymentSectionWrap = document.getElementById('payment-section');
            const freeSection = document.getElementById('free-download-section');
            const continuePayButton = document.getElementById('continue-button');
            const allFree = allSelectedTicketsAreFree();
            if (allFree) {
                if (paymentSectionWrap) paymentSectionWrap.style.display = 'none';
                if (freeSection) freeSection.style.display = '';
                cardContainer.innerHTML = '';
            } else {
                if (paymentSectionWrap) paymentSectionWrap.style.display = '';
                if (freeSection) freeSection.style.display = 'none';
                if (continuePayButton) continuePayButton.innerHTML = `Pay Now
                    <div id="loader1" class="spinner-border spinner-border-sm text-light" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>`;
                if (!card && !isInitializing && cardContainer.children.length === 0) initializePayment();
            }
        }

        async function handleTicketBooking(event, triggerBtn, loaderEl) {
            event.preventDefault();
            triggerBtn.disabled = true;
            loaderEl.style.display = 'inline-block';

            const requiredFields = document.querySelectorAll('[required]');
            let allFieldsFilled = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allFieldsFilled = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            if (!allFieldsFilled) {
                toastr.error('Please fill out all required fields.');
                loaderEl.style.display = 'none';
                triggerBtn.disabled = false;
                return;
            }

            const tickets = [];
            const eventId = @json(Crypt::encryptString($event->id));
            ticketTypes.forEach(ticket => {
                const qty = parseInt(document.getElementById(`quantity-${ticket.id}`)?.value) || 0;
                if (qty > 0) {
                    const attendees = [];
                    for (let i = 0; i < qty; i++) {
                        const attendeeInputs = document.querySelectorAll(
                            `.ticket-attendee-fields input[name^="attendees[${ticket.id}][${i}]"]`
                        );
                        const attendeeData = {};
                        attendeeInputs.forEach(input => {
                            const matches = input.name.match(/^attendees\[\d+]\[\d+]\[(.+)]$/);
                            if (matches && matches[1]) {
                                attendeeData[matches[1]] = input.value;
                            }
                        });
                        attendees.push(attendeeData);
                    }
                    tickets.push({
                        id: ticket.encrypted_id,
                        quantity: qty,
                        event_id: eventId,
                        attendees: attendees
                    });
                }
            });

            if (!tickets.length) {
                toastr.error('Please select at least one ticket.');
                loaderEl.style.display = 'none';
                triggerBtn.disabled = false;
                return;
            }

            if (allSelectedTicketsAreFree()) {
                let guest_email = '';
                @if(Auth::check())
                    guest_email = @json(Auth::user() ? Auth::user()->email : '');
                @else
                    guest_email = document.getElementById('emailInput')?.value || email.value;
                @endif
                if (!guest_email) {
                    toastr.error('Please log in or provide a guest email to proceed with booking.');
                    loaderEl.style.display = 'none';
                    triggerBtn.disabled = false;
                    return;
                }
                const bookingData = {
                    guest_email: guest_email,
                    email: email.value,
                    first_name: first_name.value,
                    last_name: last_name.value,
                    phone: phone.value,
                    tickets: tickets
                };
                try {
                    const response = await fetch(`/event/${encryptedEventId}/purchase`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(bookingData)
                    });
                    const result = await response.json();
                    if (result.success === true) {
                        window.location.href = `/event/${encodeURIComponent(result.encryptedOrderId)}/success?guest_email=${result.guest_email}`;
                    } else {
                        toastr.error('Booking failed: ' + (result.message || 'An unknown error occurred.'));
                    }
                } catch (error) {
                    toastr.error('An error occurred during booking. Please try again.');
                } finally {
                    loaderEl.style.display = 'none';
                    triggerBtn.disabled = false;
                }
                return;
            }

            if (!payments || !card) {
                let ok = await initializePayment();
                if (!ok) {
                    loaderEl.style.display = 'none';
                    triggerBtn.disabled = false;
                    return;
                }
            }

            let paymentMethod;
            try {
                paymentMethod = await card.tokenize();
            } catch (e) {
                toastr.error('Payment system error.');
                loaderEl.style.display = 'none';
                triggerBtn.disabled = false;
                return;
            }
            if (!paymentMethod || paymentMethod.status !== 'OK') {
                toastr.error('Payment failed: ' + (paymentMethod?.errors?.[0]?.detail || ''));
                loaderEl.style.display = 'none';
                triggerBtn.disabled = false;
                return;
            }

            let guest_email = '';
            @if(Auth::check())
                guest_email = @json(Auth::user() ? Auth::user()->email : '');
            @else
                guest_email = document.getElementById('emailInput')?.value || email.value;
            @endif
            if (!guest_email) {
                toastr.error('Please log in or provide a guest email to proceed with booking.');
                loaderEl.style.display = 'none';
                triggerBtn.disabled = false;
                return;
            }

            const paymentData = {
                nonce: paymentMethod.token,
                encryptedEventId: encryptedEventId,
                csrfToken: csrfToken,
                guest_email: guest_email,
                email: email.value,
                first_name: first_name.value,
                last_name: last_name.value,
                phone: phone.value,
                tickets: tickets
            };
            try {
                const response = await fetch(`/event/${encryptedEventId}/purchase`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(paymentData)
                });
                const result = await response.json();
                if (result.status === 'error' && result.errors) {
                    for (const field in result.errors) {
                        const errorMessages = result.errors[field].join(' ');
                        toastr.error(errorMessages);
                    }
                } else if (result.success === true) {
                    if (result.payment_url) {
                        window.location.href = result.payment_url;
                    } else {
                        window.location.href = `/event/${encodeURIComponent(result.encryptedOrderId)}/success?guest_email=${result.guest_email}`;
                    }
                } else {
                    toastr.error('Payment failed: ' + (result.message || 'An unknown error occurred.'));
                }
            } catch (error) {
                toastr.error('An error occurred during payment processing. Please try again.');
            } finally {
                loaderEl.style.display = 'none';
                triggerBtn.disabled = false;
            }
        }

        continuePayButton.addEventListener('click', function(event) {
            handleTicketBooking(event, continuePayButton, loader);
        });

        if (freeDownloadBtn) {
            freeDownloadBtn.addEventListener('click', function(event) {
                handleTicketBooking(event, freeDownloadBtn, freeLoader);
            });
        }

        enableProceedButton();
        updateSummary();
        showStep('cart-section');
        updatePaymentInfoVisibility();
    });
</script>
            
            
    @endpush
@endsection
