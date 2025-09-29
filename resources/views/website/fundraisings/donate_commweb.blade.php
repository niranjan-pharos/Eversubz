@extends('layouts.eventlayout')

@section('title', 'Fundraiser Details | Eversabz')
@section('description', 'Welcome to Eversabz')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    #myModal, #myModal1 {
        z-index: 99999999;    background: rgba(0, 0, 0, 0.6);
    }

    .tab-content {
        display: none
    }

    .tab-content.active {
        display: block
    }

    #myModal .custom-width,
    #myModal1 .custom-width {
        width: 33%;    height: 400px;
        overflow-y: scroll;
    }

    #myModal h3 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px
    }

    .dropdown-menu {
        display: none
    }

    .dropdown-menu.show {
        display: block
    }

    .dropdown-menu1 {
        display: none
    }

    .dropdown-menu1.show {
        display: block
    }

    #closeModal,
    #closeModal1 {
        padding: 0 8px;
        height: 30px
    }

    #dropdownButton,
    #dropdownMenu,
    #dropdownMenu button {
        width: 200px
    }

    #dropdownButton1,
    #dropdownMenu1,
    #dropdownMenu1 button {
        width: 200px
    }

    .tabs-buttons .btn-primary {
        background: #2b6db5;
        padding: 10px;
        color: #fff
    }

    .tabs-buttons .btn-secondary-text {
        background: #2b6db554;
        padding: 10px;
        color: #000
    }

    .card-body {
    flex: 1 1 auto;
    padding: 25px;
    }
    .form-control {
        background-color: white !important;
        border: 1px solid #eee !important;
    }
    #side ul{
        padding-left:0px;
    }
    #side a {
        padding: .75rem .5rem !important;
        color: black;
        text-decoration: none;
    }
    #menu-dropdown .p-4 {
        padding: 0.5rem !important;
    }
    @media only screen and (max-width:767px) {
        #myModal .custom-width {
            width: 95%
        }
    }

    .card {
    max-width: 800px;
    margin: 0 auto;
    }

    /* #total-display {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        background-color: #e7f1ff;
        color: #007bff;
        border: none;
        padding: 15px;
        cursor: pointer;
    }

    #total-display:hover {
        background-color: #cfe2ff;
    } */

    #tip-amount {
        font-weight: bold;
        margin-top: -7px;
    }
.toast-message{
    color:black !important;
}
    textarea, input[type="text"] {
        border-radius: 5px;
    }


    .form-range {
        width: 100%;
    }

    .form-check-label {
        font-weight: bold;
    }

    .form-check-input {
        margin-top: 5px;
    }

    .d-flex img {
        width: 20px;
        height: 20px;
    }

    .d-flex p {
        font-size: 14px;
    }


    #info-icon {
        cursor: pointer;
        margin-left: 5px;
        font-size: 18px;
    }
    #shareBtn{
        background: #2b54a4;
        color: white;
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
    box-shadow: none;
    border: 1px solid #2e69b2;
    border-radius: 23px;
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

    .amount-btn {
        border-radius: 0.375rem !important;
    background-color: #fff;
    border: 1px solid #ced4da;
    color: #000;
    transition: all 0.3s ease;
    margin: 10px;
    font-size: 16px;
    padding: 8px 20px;
    font-weight: bold;
    border-color: #b6a9a9;
    }
    .amount-btn.active {
        background-color: #0d6efd !important;
        color: #fff !important;
        border-color: #0d6efd !important;
    }
    .amount-btn:hover {
        background-color: #e9ecef;
    }
    #tip-switcher {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 10px;
        background: #ddd;
        outline: none;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
        margin-right: 20px;
    }
    #tip-switcher::-webkit-slider-runnable-track {
        height: 10px;
        background: #ddd;
    }
    #tip-switcher::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #2b54a4;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: -400px 0 0 400px #2b54a4;
    }
    #tip-switcher::-moz-range-track {
        height: 10px;
        background: #ddd;
    }
    #tip-switcher::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #28a745;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: -400px 0 0 400px #28a745;
    }
    #tip-switcher::after {
        content: '';
        position: absolute;
        width: 12px;
        height: 12px;
        background: #28a745;
        border-radius: 50%;
        right: -20px; 
        top: 50%;
        transform: translateY(-50%);
    }
    #amount {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        transition: border-color 0.15s ease-in-out;
    }
    #amount.valid {
        border-color: #28a745;
    }
    #amount.valid::after {
        content: '\f00c';
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #28a745;
    }
    .amount-input-container {
        position: relative;
    }
    .value-display {
        margin-top: 0.5rem;
        font-weight: bold;
    }
    .value-display span {
        font-weight: normal;
        margin-left: 0.5rem;
    }
    hr {
        border: 1px solid #ddd; 
        margin: 0px !important;
    }
    .labelheading{
        font-size: 1.1rem; 
        font-weight: 400; 
        margin-bottom: 10px;
    }

    /* Style for the custom checkbox */
    .custom-checkbox {
        width: 20px;
        height: 20px;
        border-radius: 5px;
        background-color: white; /* Default background is white */
        border: 2px solid #ccc; /* Light gray border */
        position: relative;
        appearance: none;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
    }

    /* Checked state for the checkbox */
    .custom-checkbox:checked {
        background-color: #2b54a4; /* Blue background when checked */
        border-color: #2b54a4; /* Matching border color */
    }

    /* Add a checkmark inside the checkbox */
    .custom-checkbox:checked::after {
        content: '\2714'; /* Unicode checkmark */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white; /* White checkmark */
        font-size: 14px;
    }

    /* Hover effect for the checkbox */
    .custom-checkbox:hover {
        border-color: #007BFF; /* Change border to blue on hover */
    }

    /* Focus effect */
    .custom-checkbox:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25); /* Blue outline when focused */
    }

    /* Style for the label */
    .form-check-label {
        font-weight: 500;
        margin-left: 10px;
        color: #333;
        cursor: pointer;
    }

    /* Tooltip style */
    #info-icon {
        color: #007bff;
        cursor: pointer;
        margin-left: 5px;
    }

    /* Additional responsive styling */
    @media (max-width: 576px) {
        .form-check {
            font-size: 14px;
        }
    }

    input[type=checkbox]
 {
    --tw-bg-opacity: 1;
    background-color: rgb(241 245 249 / var(--tw-bg-opacity));
    --tw-text-opacity: 1 !important;
    color: rgb(2 132 199 / var(--tw-text-opacity)) !important;
    border: 1px solid #000;
    border-radius: 3px;
}
    #donate-btn {
    background-color: #2b54a4;
    color: #fff;
    font-size: 18px;
    padding: 10px;
    margin-top: 20px;
    border-radius: 50px;
    font-weight: 60p;
}
    .hosted-field { min-height: 44px; border: 1px solid #ced4da; border-radius: .375rem; padding: .375rem .75rem; }
.hosted-field iframe { width: 100%; height: 100%; }



.card-title {
    margin-bottom: .5rem;
    font-size: 19px;
}
.btn-group{
    margin-left: -7px;
}
.custom-input {
    border-radius: 10px !important;
    padding: 10px 15px !important;
    height: 56px;
    font-size: 16px ! IMPORTANT;
    background-color: #fff !important;
    border: 1px solid #272c324a !important;
    font-weight: 400 !important;
}
.form-control:focus {
    color: var(--bs-body-color);
    background-color: var(--bs-body-bg);
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
}
/* Track */
input[type=range] {
  -webkit-appearance: none;
  appearance: none;
  width: 100%;
  height: 6px;
  border-radius: 3px;
  background: linear-gradient(to right, #0d6efd 50%, #ddd 50%);
  outline: none;
}

/* Chrome, Safari, Edge thumb */
input[type=range]::-webkit-slider-thumb {
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background-color: #0d6efd!important; /* same as track fill */
  border: 2px solid #fff;
  cursor: pointer;
  margin-top: -6px;
  z-index:999999;
}

/* Firefox thumb */
input[type=range]::-moz-range-thumb {
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background-color: #0d6efd !important; /* same as track fill */
  border: 2px solid #fff;
  cursor: pointer;
}
/* Base checkbox style */
.custom-checkbox {
  appearance: none;
  -webkit-appearance: none;
  width: 20px;
  height: 20px;
  border: 2px solid #0d6efd;
  border-radius: 4px;
  background-color: #fff; /* Always white */
  cursor: pointer;
  position: relative;
}

/* Keep white background when checked */
.custom-checkbox:checked {
  background-color: #fff;
  border-color: #0d6efd;
}

/* Blue check mark */
.custom-checkbox:checked::after {
  content: "";
  position: absolute;
  left: 5px;
  top: 1px;
  width: 6px;
  height: 12px;
  border: solid #0d6efd;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

/* Remove focus glow */
.custom-checkbox:focus {
  outline: none;
  box-shadow: none;
}
.values-card{
    font-size: 1rem;
    padding: 10px 16px 20px 10px;
    background: none;
    border: 1px solid #c9bdbd;
    border-radius: 10px;
}




</style>
<main id="site__main" class="2xl:ml-0 xl:ml-0 p-2.5 my-3">

    <div class="max-w-[1065px] mx-auto">

        <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10 ">

            <div class="relative overflow-hidden lg:h-80 h-44 w-full">
                <img loading="eager" src="{{ asset('storage/' . $fundraising->main_image) }}" alt="main image"
                    class="h-full w-full object-contain inset-0">

                <div class="w-full bottom-0 absolute left-0 bg-gradient-to-t from -black/60 pt-10 z-10"></div>

            </div>

            <div class="lg:p-5 p-3 lg:px-10 pb-8">

                <div class="flex flex-col justify-center -mt-20">

                    <div class="relative h-20 w-20 mb-4 z-10">
                        <div
                            class="relative overflow-hidden rounded-full md:border-4 border-gray-100 shrink-0  shadow">
                            <img loading="eager" src="{{ asset('storage/' . $fundraising->main_image) }}"
                                alt="main image" class="h-full w-full object-contain inset-0">
                        </div>
                    </div>

                    <div class="flex lg:items-end justify-between max-md:flex-col lg:pb-3">

                        <div>
                            <h3 class="md:text-2xl text-base md:font-semibold font-medium text-black ">
                                {{ $fundraising->title }}</h3>
                            <div class="font-normal text-gray-500 mt-2 text-sm /70">
                                Fundraiser for
                                <a href="#" class="font-normal text-gray-800 hover:text-blue-600 ">
                                    {{ $fundraising->for }}</a>
                                by
                                <a href="{{ route('ngo.show', $ngoInfo->id) }}"
                                    class="font-medium text-gray-800 hover:text-blue-600 ">
                                    {{ optional($fundraising->ngo)->ngo_name ?? 'N/A' }}</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 lg:mt-1 mt-4 max-md:w-full">
                           
                            

                            <button id="shareBtn" class="button bg-secondery text-sm py-2 !px-6 max-md:flex-1">
                                Share
                            </button>
                        </div>

                    </div>


                </div>

            </div>


        </div>

        <div class="lg:flex-row gap-6 mt-2" id="js-oversized">

            <div class="container mt-5">
                <form id="donation-form">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Request for a Water Well for 120 Families</h5>
                            <!-- <h6 class="card-subtitle mb-4 text-black mt-4"></h6> -->
                            <label for="amount" class="form-label labelheading mt-2 text-black">Select an amount to support</label>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="btn-group" role="group" aria-label="Amount selection">
                                        <button type="button" class="btn amount-btn " data-amount="5">$5</button>
                                        <button type="button" class="btn amount-btn" data-amount="10">$10</button>
                                        <button type="button" class="btn amount-btn" data-amount="25">$25</button>
                                        <button type="button" class="btn amount-btn" data-amount="50">$50</button>
                                        <button type="button" class="btn amount-btn" data-amount="100">$100</button>
                                        <button type="button" class="btn amount-btn" data-amount="200">$200</button>
                                    </div>
                                    @error('amount')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Amount Input Section -->
                            <div class="row mt-3">
                                <div class="col-12 col-md-4 amount-input-container">
                                    <label for="amount" class="form-label labelheading">Amount</label>
                                    <input type="number" class="form-control custom-input" id="amount" placeholder="Enter Amount in AUD" step="1" min="0">
                                    @error('amount')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Tip Percentage Section with Switcher -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <hr>
                                    <label for="amount" class="form-label labelheading mt-3">Tip Amount</label>
                                    <div class="d-flex justify-content-between" style="position: relative;">
                                        <input type="range" class="form-range" id="tip-switcher" min="0" max="60" step="1" value="0">
                                        <span id="tip-amount">0%</span>
                                    </div>
                                    @error('tip')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Tip Description Section -->
                                <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center p-3" 
                                        style="background-color: #f0f9ff; border-radius: 12px; border: 1px solid #d0e7ff;">
                                        <img src="https://eversabz.com/assets/images/smiley.svg" 
                                            class="me-3" 
                                            style="width: 48px; height: 48px;">
                                        <p class="mb-0" style="font-size: 1rem; color: #333; line-height: 1.4;">
                                            <strong style="color: #0d6efd;">Imagine the smiles</strong> your tip can bring!  
                                            Even a little goes a long way in our journey to help others.  
                                            Let’s make a positive change together. 
                                        </p>
                                    </div>
                                </div>
                                </div>

                            
                            <!-- Cover Transaction Costs Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <!-- <div class="form-check">
                                        <input class="form-check-input custom-checkbox" type="checkbox" value="" id="cover-transaction-costs">
                                        <label class="form-check-label labelheading" for="cover-transaction-costs">
                                            Cover Transaction Costs
                                        </label>
                                        <span id="info-icon" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Transaction fees are paid to external payment processors (2.9% + $0.3) and do not go to Aseel."></span>
                                        <small class="form-text text-muted">By covering the transaction fee, you help the campaign receive 100% of your support.</small>
                                    </div> -->

                                    <div class="">
                                    <!-- <input class="form-check-input custom-checkbox me-2" 
                                        type="checkbox" 
                                        value="" 
                                        id="cover-transaction-costs"> -->

                                        <input type="checkbox" id="anonymous" value=""   id="cover-transaction-costs">
                                    <label class="form-check-label" 
                                        for="cover-transaction-costs" 
                                        style="font-weight: 500;">
                                    Cover Transaction Costs
                                    </label>
                                    <span id="info-icon" 
                                        class="fa fa-info-circle ms-2 text-primary" 
                                        style="cursor: pointer;" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="right" 
                                        title="Transaction fees are paid to external payment processors (2.9% + $0.3) and do not go to Aseel.">
                                    </span>
                                    <p class=" text-black d-block mt-1" style="line-height: 1.4;margin-left:12px;">
                                        By covering the transaction fee, you help the campaign receive <strong>100%</strong> of your support.
                                    </p>
                                    </div>

                                    
                                    @error('transaction_fee')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Value Displays -->
                            <!-- <div class="row mt-3 g-3">
                                <div class="col-12 value-display">
                                    <span class="fw-bold">Amount:</span> <span id="display-amount">$0.00</span>
                                </div>
                                <div class="col-12 value-display">
                                    <span class="fw-bold">Tip:</span> <span id="display-tip">$0.00</span>
                                </div>
                                <div class="col-12 value-display" id="transaction-fee-section" style="display: none;">
                                    <span class="fw-bold">Transaction Fee (2.9% + $0.30):</span> <span id="display-transaction-fee">$0.00</span>
                                </div>
                                <hr class="mt-2">
                                <div class="col-12 value-display" id="total">
                                    <span class="fw-bold">Total Amount:</span> <span id="total-display" disabled>$0.00</span>
                                    @error('total_amount')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> -->
                            <div class="d-flex flex-wrap align-items-center gap-4 mt-3 values-card" style="font-size: 1rem;">
    <div class="value-display">
        <span class="fw-bold">Amount:</span> <span id="display-amount" class="ms-1">$0.00</span>
    </div>
    <div class="value-display">
        <span class="fw-bold">Tip:</span> <span id="display-tip" class="ms-1">$0.00</span>
    </div>
    <div class="value-display" id="transaction-fee-section" style="display: none;">
        <span class="fw-bold">Transaction Fee (2.9% + $0.30):</span> 
        <span id="display-transaction-fee" class="ms-1">$0.00</span>
    </div>
    <div class="value-display" id="total" style="border-left: 2px solid #ddd; padding-left: 12px; font-weight: 600; color: #0d6efd;">
        <span class="fw-bold">Total:</span> <span id="total-display" class="ms-1" disabled>$0.00</span>
    </div>
</div>


                           



                
                            <!-- Additional Fields -->
                            <div class="row mt-4">
                               <div class="col-12 col-md-12">
                                <hr>
                              </div>
</div>
                              <div class="row mt-4">
                                <div class="col-12  col-md-6">
                                    <label for="name" class="form-label labelheading">First Name :</label>
                                    <input type="text" class="form-control custom-input" id="name" placeholder="Enter your name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="lastname" class="form-label labelheading">Last Name :</label>
                                    <input type="text" class="form-control custom-input" id="lastname" placeholder="Enter your last name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
</div>
<div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label labelheading">Email :</label>
                                    <input type="email" class="form-control custom-input" id="email" placeholder="Enter your email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="country" class="form-label labelheading">Country ;</label>
                                    <select name="country" class="form-control custom-input" id="country">
                                        <option value="" {{ old('country') ? '' : 'selected' }} disabled>Select Your Country</option>
                                        <option value="australia" {{ old('country') == 'australia' ? 'selected' : '' }}>Australia</option>
                                    </select>
                                    @error('country')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="message" class="form-label labelheading">Message to Donor</label>
                                    <textarea class="form-control custom-input" id="message" rows="3" placeholder="Write a message..." style="margin-bottom: 20px;">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-12">
                                    <input type="checkbox" id="anonymous" value="1">&nbsp;Don't show my nameon't show my name
                                
                                </div>
                                <div class="col-12 col-md-12 mt-4">
                                     <hr>
                                </div>
                            </div>
                            
                            <div class=" mt-4">
                                <div class="">
                                    <h5>Payment Information</h5>
                                </div>
                                <div class="mt-4">
                                    <div class="d-flex gap-2">
                                        <img src="https://eversabz.com/assets/images/pay-card/01.jpg" style="width: 40px; margin-right: 10px;">
                                        <img src="https://eversabz.com/assets/images/pay-card/02.jpg" style="width: 40px; margin-right: 10px;">
                                        <img src="https://eversabz.com/assets/images/pay-card/03.jpg" style="width: 40px; margin-right: 10px;">
                                    </div>
                                    <div id="payment-form-container">
                                        <div id="card-container">
                                          <div class="row mt-3">
                                            <div class="col-12">
                                              <label class="form-label labelheading">Card Number</label>
                                              <div id="card-number" class="hosted-field custom-input"></div>
                                            </div>
</div>
<div class="row mt-3">
                                            <div class="col-6">
                                              <label class="form-label labelheading">Expiry Month</label>
                                              <div id="expiry-month" class="hosted-field custom-input"></div>
                                            </div>
                                            <div class="col-6">
                                              <label class="form-label labelheading">Expiry Year</label>
                                              <div id="expiry-year" class="hosted-field custom-input"></div>
                                            </div>
</div>
<div class="row mt-3">
                                            <div class="col-12">
                                              <label class="form-label labelheading">Security Code</label>
                                              <div id="security-code" class="hosted-field custom-input"></div>
                                            </div>
                                          </div>
                                        </div>
                                        <input type="hidden" id="session_id" name="session_id">
                                      </div>
                                      
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn w-100" id="donate-btn">Donate Now</button>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </form>
            </div>
        

            <div class="lg:w-[400px]">

                <div class="lg:space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6"
                    uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                    <div class="hidden box p-5 px-6 pr-0">

                        <h3 class="font-semibold text-lg text-black "> Fundraiser Progress</h3>

                        <div class="grid grid-cols-3 gap-2 text-sm mt-4">
                            <div>
                                <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">
                                    162</h3>
                                <p class="mt-0.5">Donated</p>
                            </div>
                            <div>
                                <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">
                                    4,6K</h3>
                                <p class="mt-0.5">Invited</p>
                            </div>
                            <div>
                                <h3 class="sm:text-xl sm:font-semibold mt-1 text-black  text-base font-normal">
                                    1,4K</h3>
                                <p class="mt-0.5">Shared</p>
                            </div>
                        </div>

                    </div>

                <!-- 
                    <div class="box p-4 px-6 mt-0">

                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base"> Live Donations</h3>
                            <a href="#" class="text-sm text-blue-500" id="openModal">See all</a>
                        </div>

                        <div class="side-list">

                            <div class="side-list-item">

                                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                    class="side-list-image rounded-full">

                                <div class="flex-1">

                                    <h4 class="side-list-title"> Monroe Parker </h4>

                                    <div class="side-list-info"> Today</div>
                                </div>
                                <span class="">$12</span>
                            </div>

                            <div class="side-list-item">

                                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                    class="side-list-image rounded-full">

                                <div class="flex-1">

                                    <h4 class="side-list-title"> Martin Gray </h4>

                                    <div class="side-list-info"> 1 Day AGo</div>
                                </div>
                                <span class="">$50</span>
                            </div>

                            <div class="side-list-item">

                                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                    class="side-list-image rounded-full">

                                <div class="flex-1">

                                    <h4 class="side-list-title"> James Lewis </h4>

                                    <div class="side-list-info"> 3 Days Ago</div>
                                </div>
                                <span class="">$10</span>
                            </div>

                        </div>

                    </div>


                    <div class="box p-4 px-6">

                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base"> Top Donors</h3>
                            <a href="#" class="text-sm text-blue-500" id="openModal1">See all</a>
                        </div>
                        <div class="flex flex-col gap-5">
                            <div class="tabs-buttons p-2 bg-accent-100 rounded-lg gap-2 md:gap-3.5 flex">
                                <button class="btn btn-primary w-full tab-btn text-sm !px-0 capitalize"
                                    data-tab="allTime">All
                                    Time</button>
                                <button class="btn btn-secondary-text w-full tab-btn text-sm !px-0"
                                    data-tab="weekly">Weekly</button>
                                <button class="btn btn-secondary-text w-full tab-btn text-sm !px-0"
                                    data-tab="monthly">Monthly</button>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div id="allTime" class="tab-content">
                                    <div class="side-list">

                                        <div class="side-list-item">

                                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png"
                                                alt="" class="side-list-image rounded-full">

                                            <div class="flex-1">

                                                <h4 class="side-list-title"> Monroe Parker </h4>

                                                <div class="side-list-info"> Today</div>
                                            </div>
                                            <span class="">$12</span>
                                        </div>

                                        <div class="side-list-item">

                                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png"
                                                alt="" class="side-list-image rounded-full">

                                            <div class="flex-1">

                                                <h4 class="side-list-title"> Martin Gray </h4>

                                                <div class="side-list-info"> 1 Day AGo</div>
                                            </div>
                                            <span class="">$50</span>
                                        </div>

                                        <div class="side-list-item">

                                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png"
                                                alt="" class="side-list-image rounded-full">

                                            <div class="flex-1">

                                                <h4 class="side-list-title"> James Lewis </h4>

                                                <div class="side-list-info"> 3 Days Ago</div>
                                            </div>
                                            <span class="">$10</span>
                                        </div>

                                    </div>
                                </div>
                                <div id="weekly" class="tab-content">
                                    <div class="side-list">

                                        <div class="side-list-item">

                                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png"
                                                alt="" class="side-list-image rounded-full">

                                            <div class="flex-1">

                                                <h4 class="side-list-title"> Monroe Parker </h4>

                                                <div class="side-list-info"> Today</div>
                                            </div>
                                            <span class="">$12</span>
                                        </div>

                                        <div class="side-list-item">

                                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png"
                                                alt="" class="side-list-image rounded-full">

                                            <div class="flex-1">

                                                <h4 class="side-list-title"> Martin Gray </h4>

                                                <div class="side-list-info"> 1 Day AGo</div>
                                            </div>
                                            <span class="">$50</span>
                                        </div>



                                    </div>
                                </div>
                                <div id="monthly" class="tab-content">
                                    <div class="side-list-item">

                                        <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                            class="side-list-image rounded-full">

                                        <div class="flex-1">

                                            <h4 class="side-list-title"> James Lewis </h4>

                                            <div class="side-list-info"> 3 Days Ago</div>
                                        </div>
                                        <span class="">$10</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box p-4 px-6">

                        <div class="flex items-baseline justify-between text-black ">
                            <h3 class="font-bold text-base"> Campaign Gallery </h3>
                        </div>

                        <div class="relative capitalize font-medium text-sm text-center mt-4 mb-2" tabindex="-1"
                            uk-slider="autoplay: true;finite: true">

                            <div class="overflow-hidden uk-slider-container">

                                <ul class="uk-slider-items">
                                    @if ($fundraising->main_image)
                                    <li class="w-full pr-2">
                                        <div class="relative overflow-hidden rounded-lg">
                                            <div class="relative w-full h-40 card-media1">
                                                <img loading="eager"
                                                    src="{{ asset('storage/' . $fundraising->main_image) }}"
                                                    alt="{{ $fundraising->title }}"
                                                    class="object-contain w-full h-full inset-0">
                                            </div>
                                        </div>
                                    </li>
                                    @endif

                                    @foreach ($fundraising->fundraisingImages as $image)
                                    <li class="w-full pr-2">
                                        <div class="relative overflow-hidden rounded-lg">
                                            <div class="relative w-full h-40 card-media1">
                                                <img loading="eager" src="{{ asset('storage/' . $image->image_path) }}"
                                                    class="object-contain w-full h-full inset-0" alt="details">
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                                <button type="button"
                                    class="absolute bg-white rounded-full top-16 -left-4 grid w-9 h-9 place-items-center shadow "
                                    uk-slider-item="previous">
                                    <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
                                </button>
                                <button type="button"
                                    class="absolute -right-4 bg-white rounded-full top-16 grid w-9 h-9 place-items-center shadow "
                                    uk-slider-item="next">
                                    <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="box p-4 px-6 space-y-4">

                        <h3 class="font-bold text-base text-black"> Created by </h3>

                        <div class="side-list-item">
                            <a href="#">
                                <img loading="eager" src="{{ asset('storage/' . $fundraising->ngo->logo_path) }}"
                                    alt="user image" class="side-list-image rounded-full">

                            </a>
                            <div class="flex-1">
                                <a href="{{ route('ngo.show', $ngoInfo->id) }}">
                                    <h4 class="side-list-title">{{ optional($fundraising->ngo)->ngo_name ?? 'N/A' }}
                                    </h4>
                                </a>
                                <div class="side-list-info">{{ optional($fundraising->ngo)->contact_email ?? 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <ul class="text-gray-600 space-y-4 text-sm /80">
                            <li class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                                <div><span class="font-semibold text-black "> Members </span>{{ $memberCount }}
                                    People </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path
                                        d="M19 3h-1V2h-2v1H8V2H6v1H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 0h-4V2h4v1zm-6 0h4V2h-4v1zM5 7h14v12H5V7zm6 3h2v4h-2v-4zm-4 0h2v4H7v-4zm8 0h2v4h-2v-4z"
                                        fill="currentColor" />
                                </svg>
                                <div class="flex gap-4">
                                    <span class="font-semibold text-black ">Establiished - </span>
                                    <p class="text-left">@if ($fundraising->ngo->establishment)
                                        {{ $fundraising->ngo->establishment }}
                                        @else
                                        No Establiished year available.
                                        @endif</p>
                                </div>
                            </li>

                        </ul>

                    </div>

                    <div class="box p-5 px-6 hidden">

                        <div class="flex items-baseline justify-between text-black ">
                            <h3 class="font-bold text-base"> Related funds</h3>
                            <a href="#" class="text-sm text-blue-500">See all</a>
                        </div>

                        <div>

                            <div class="flex space-x-5 mt-5">
                                <div class="w-28 max-h-ful l h-20 flex-shrink-0 rounded-lg relative">
                                    <img loading="eager"
                                        src="https://eversabz.com/main_assets/images/funding/funder-3.jpg"
                                        class="absolute w-full h-full inset-0 rounded-lg object-cover" alt="funder">
                                </div>
                                <div class="flex-1">
                                    <a href="timeline-group.html"
                                        class="font-medium capitalize line-clamp-2 text-black text-sm ">
                                        Naveen's Boston Marathon Charles River Marathon </a>

                                    <div class="flex items-center gap-2  mt-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="text-yellow-500 w-5">
                                            <path fill-rule="evenodd"
                                                d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-xs text-gray-500"> 421 People donated </p>
                                    </div>

                                    <div class="bg-secondery rounded-2xl h-1 w-full relative overflow-hidden mt-3 .5">
                                        <div class="bg-blue-600 w-1/3 h-full"></div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div> -->

                </div>


            </div>

        </div>

    </div>

</main>
<div id="myModal" class="fixed inset-0  items-center justify-center bg-gray-500 bg-opacity-75 z-50 hidden">
    <div class="custom-width bg-white p-4 rounded-lg">
        <div class="flex  justify-between">
            <h3>Live Donations</h3>
            <button id="closeModal" class="bg-blue-500 text-white rounded">X</button>
        </div>

        <div class="flex justify-between gap-3">

            <div class="flex justify-between gap-3 mt-4">
                <div class="flex items-center gap-4">
                    <label for="sortBy" class="text-sm font-bold hidden sm:flex !mb-0 hide-xs">Sort:</label>
                    <div class="relative ">
                        <button id="dropdownButton"
                            class="text-sm font-medium text-neutral-800 -full py-1.5 px-4 border shadow-card border-neutral-300 rounded-lg flex items-center justify-between">
                            <span class="block truncate">Select</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 16 16" class="ml-2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6l4 4 4-4"></path>
                            </svg>
                        </button>
                        <div id="dropdownMenu"
                            class="dropdown-menu absolute right-0 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">A - Z
                                Order</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Z - A
                                Order</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Low to
                                High</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">High to
                                Low</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div
            class="side-list flex flex-col gap-3 max-h-[calc(100vh-20rem)] sm:max-h-[calc(100vh-20rem)] overflow-auto pr-4">

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Monroe Parker </h4>

                    <div class="side-list-info"> Today</div>
                </div>
                <span class="">$12</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Martin Gray </h4>

                    <div class="side-list-info"> 1 Day AGo</div>
                </div>
                <span class="">$50</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> James Lewis </h4>

                    <div class="side-list-info"> 3 Days Ago</div>
                </div>
                <span class="">$10</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Monroe Parker </h4>

                    <div class="side-list-info"> Today</div>
                </div>
                <span class="">$12</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Martin Gray </h4>

                    <div class="side-list-info"> 1 Day AGo</div>
                </div>
                <span class="">$50</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> James Lewis </h4>

                    <div class="side-list-info"> 3 Days Ago</div>
                </div>
                <span class="">$10</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Monroe Parker </h4>

                    <div class="side-list-info"> Today</div>
                </div>
                <span class="">$12</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> Martin Gray </h4>

                    <div class="side-list-info"> 1 Day AGo</div>
                </div>
                <span class="">$50</span>
            </div>

            <div class="side-list-item">

                <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                    class="side-list-image rounded-full">

                <div class="flex-1">

                    <h4 class="side-list-title"> James Lewis </h4>

                    <div class="side-list-info"> 3 Days Ago</div>
                </div>
                <span class="">$10</span>
            </div>

        </div>

    </div>
</div>



<div id="myModal1" class="fixed inset-0  items-center justify-center bg-gray-500 bg-opacity-75 z-50 hidden">
    <div class="custom-width bg-white p-4 rounded-lg">
        <div class="flex  justify-between">
            <h3>Top Donors</h3>
            <button id="closeModal1" class="bg-blue-500 text-white rounded">X</button>
        </div>

        <div class="flex justify-between gap-3">

            <div class=" flex justify-between gap-3 mt-4">
                <div class="flex items-center gap-4">
                    <label for="sortBy" class="text-sm font-bold hidden sm:flex !mb-0 hide-xs">Sort:</label>
                    <div class="relative ">
                        <button id="dropdownButton1"
                            class="text-sm font-medium text-neutral-800 -full py-1.5 px-4 border shadow-card border-neutral-300 rounded-lg flex items-center justify-between">
                            <span class="block truncate">Select</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 16 16" class="ml-2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6l4 4 4-4"></path>
                            </svg>
                        </button>
                        <div id="dropdownMenu1"
                            class="dropdown-menu absolute right-0 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">A - Z
                                Order</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Z - A
                                Order</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Low to
                                High</button>
                            <button class="block px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">High to
                                Low</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="flex flex-col gap-5">
            <div class="tabs-buttons p-2 bg-accent-100 rounded-lg gap-2 md:gap-3.5 flex">
                <button class="btn btn-primary w-full tab-btn1 text-sm !px-0 capitalize" data-tab1="allTim1">All
                    Time</button>
                <button class="btn btn-secondary-text w-full tab-btn1 text-sm !px-0" data-tab1="weekl1">Weekly</button>
                <button class="btn btn-secondary-text w-full tab-btn1 text-sm !px-0"
                    data-tab1="monthly1">Monthly</button>
            </div>
            <div class="flex flex-col gap-3">
                <div id="allTim1" class="tab-content1">
                    <div class="side-list">

                        <div class="side-list-item">

                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                class="side-list-image rounded-full">

                            <div class="flex-1">

                                <h4 class="side-list-title"> Monroe Parker </h4>

                                <div class="side-list-info"> Today</div>
                            </div>
                            <span class="">$12</span>
                        </div>

                        <div class="side-list-item">

                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                class="side-list-image rounded-full">

                            <div class="flex-1">

                                <h4 class="side-list-title"> Martin Gray </h4>

                                <div class="side-list-info"> 1 Day AGo</div>
                            </div>
                            <span class="">$50</span>
                        </div>

                        <div class="side-list-item">

                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                class="side-list-image rounded-full">

                            <div class="flex-1">

                                <h4 class="side-list-title"> James Lewis </h4>

                                <div class="side-list-info"> 3 Days Ago</div>
                            </div>
                            <span class="">$10</span>
                        </div>

                    </div>
                </div>
                <div id="weekl1" class="tab-content1">
                    <div class="side-list">

                        <div class="side-list-item">

                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                class="side-list-image rounded-full">

                            <div class="flex-1">

                                <h4 class="side-list-title"> Monroe Parker </h4>

                                <div class="side-list-info"> Today</div>
                            </div>
                            <span class="">$12</span>
                        </div>

                        <div class="side-list-item">

                            <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                                class="side-list-image rounded-full">

                            <div class="flex-1">

                                <h4 class="side-list-title"> Martin Gray </h4>

                                <div class="side-list-info"> 1 Day AGo</div>
                            </div>
                            <span class="">$50</span>
                        </div>



                    </div>
                </div>
                <div id="monthly1" class="tab-content1">
                    <div class="side-list-item">

                        <img src="https://eversabz.com/assets/images/avatar/charity-avtar.png" alt=""
                            class="side-list-image rounded-full">

                        <div class="flex-1">

                            <h4 class="side-list-title"> James Lewis </h4>

                            <div class="side-list-info"> 3 Days Ago</div>
                        </div>
                        <span class="">$10</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')

<script src="{{ config('services.commbank.form_url') }}/merchant/{{ config('services.commbank.merchant_id') }}/session.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 5000
    };

    const modals = [
        { id: 'myModal', openBtn: 'openModal', closeBtn: 'closeModal' },
        { id: 'myModal1', openBtn: 'openModal1', closeBtn: 'closeModal1' }
    ];
    modals.forEach(modal => {
        const m = document.getElementById(modal.id);
        const open = document.getElementById(modal.openBtn);
        const close = document.getElementById(modal.closeBtn);
        if (m && open && close) {
            m.classList.add('hidden');
            open.addEventListener('click', e => { e.preventDefault(); m.classList.remove('hidden'); m.classList.add('flex'); });
            close.addEventListener('click', () => { m.classList.add('hidden'); m.classList.remove('flex'); });
        }
    });

    const dropdowns = [
        { button: 'dropdownButton', menu: 'dropdownMenu' },
        { button: 'dropdownButton1', menu: 'dropdownMenu1' }
    ];
    dropdowns.forEach(d => {
        const btn = document.getElementById(d.button);
        const menu = document.getElementById(d.menu);
        if (btn && menu) {
            btn.addEventListener('click', () => menu.classList.toggle('show'));
            window.addEventListener('click', e => {
                if (!btn.contains(e.target) && !menu.contains(e.target)) menu.classList.remove('show');
            });
        }
    });

    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-secondary-text');
            });
            document.getElementById(tabId).classList.add('active');
            button.classList.remove('btn-secondary-text');
            button.classList.add('btn-primary');
        });
    });
    document.querySelector('.tab-btn')?.click();

    document.querySelectorAll('.tab-btn1').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab1');
            document.querySelectorAll('.tab-btn1').forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-secondary-text');
            });
            button.classList.add('btn-primary');
            button.classList.remove('btn-secondary-text');
            document.querySelectorAll('.tab-content1').forEach(content => content.style.display = 'none');
            document.getElementById(tabId).style.display = 'block';
        });
    });
    document.querySelector('.tab-btn1')?.click();

    document.getElementById('shareBtn')?.addEventListener('click', () => {
        if (navigator.share) {
            navigator.share({
                title: '{{ $fundraising->title }}',
                url: '{{ generateCanonicalUrl() }}'
            }).catch(err => console.error(err));
        } else {
            alert("Browser doesn't support this API !");
        }
    });

    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

    let selectedAmount = 0;
    let isConfigured = false;
    const amountButtons = document.querySelectorAll('.amount-btn');
    const amountInput = document.getElementById('amount');
    const displayAmount = document.getElementById('display-amount');
    const displayTip = document.getElementById('display-tip');
    const displayTransactionFee = document.getElementById('display-transaction-fee');
    const transactionFeeSection = document.getElementById('transaction-fee-section');
    const tipSwitcher = document.getElementById('tip-switcher');
    const tipAmountText = document.getElementById('tip-amount');
    const coverTransactionCostsCheckbox = document.getElementById('cover-transaction-costs');
    const form = document.getElementById('donation-form');
    const donateButton = document.getElementById('donate-btn');
    let tipPercentage = parseInt(tipSwitcher.value) || 0;

    amountButtons.forEach(button => {
        button.addEventListener('click', function() {
            amountButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            selectedAmount = parseInt(this.getAttribute('data-amount'));
            amountInput.value = selectedAmount;
            updateInputStyle();
            updateDisplayValues();
        });
    });

    amountInput.addEventListener('input', function() {
        selectedAmount = parseInt(this.value) || 0;
        if (selectedAmount < 0) selectedAmount = 0;
        this.value = selectedAmount;
        amountButtons.forEach(btn => btn.classList.remove('active'));
        const matchedButton = Array.from(amountButtons).find(btn => parseInt(btn.getAttribute('data-amount')) === selectedAmount);
        if (matchedButton) matchedButton.classList.add('active');
        updateInputStyle();
        updateDisplayValues();
    });

    tipSwitcher.addEventListener('input', () => {
        tipPercentage = parseInt(tipSwitcher.value);
        tipAmountText.textContent = `${tipPercentage}%`;
        updateTipSlider();
        updateDisplayValues();
    });

    coverTransactionCostsCheckbox.addEventListener('change', () => {
        transactionFeeSection.style.display = coverTransactionCostsCheckbox.checked ? 'block' : 'none';
        updateDisplayValues();
    });

    function updateTipSlider() {
        const percentage = (tipPercentage / 60) * 100;
        tipSwitcher.style.background = `linear-gradient(to right, #28a745 ${percentage}%, #ddd ${percentage}%)`;
    }

    function updateInputStyle() {
        const isValid = selectedAmount > 0;
        amountInput.classList.toggle('valid', isValid);
    }

    function updateDisplayValues() {
        const tipAmount = (selectedAmount * tipPercentage) / 100;
        const transactionFee = coverTransactionCostsCheckbox.checked ? (selectedAmount * 0.029 + 0.30) : 0;
        const totalAmount = selectedAmount + tipAmount + transactionFee;
        displayAmount.textContent = `$${selectedAmount.toFixed(2)}`;
        displayTip.textContent = `$${tipAmount.toFixed(2)}`;
        displayTransactionFee.textContent = `$${transactionFee.toFixed(2)}`;
        document.getElementById('total-display').textContent = `$${totalAmount.toFixed(2)}`;

        if (totalAmount > 0 && !isConfigured) {
            fetch('{{ route('donations.create_session') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    const sessionId = data.session_id;
                    fetch('{{ route('donations.update_session') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ session_id: sessionId, amount: totalAmount })
                    }).then(response => response.json())
                    .then(updateData => {
                        if (updateData.success) {
                            document.getElementById('session_id').value = sessionId;
                            PaymentSession.configure({
                                session: sessionId,
                                fields: {
                                    card: {
                                        number: '#card-number',
                                        expiryMonth: '#expiry-month',
                                        expiryYear: '#expiry-year',
                                        securityCode: '#security-code'
                                    }
                                },
                                frameEmbeddingMitigation: ['javascript'],
                                callbacks: {
                                    initialized: function(response) {
                                        console.log('initialized', response);
                                        if (response.status === 'ok') {
                                            toastr.success('Payment fields initialized successfully');
                                        } else {
                                            toastr.error('Payment fields initialization failed');
                                        }
                                    },
                                    formSessionUpdate: function(response) {
                                        console.log('formSessionUpdate', response);
                                        donateButton.disabled = false;
                                        if (loader) loader.remove();
                                        if (response.status === 'ok') {
                                            const formData = new FormData(form);
                                            formData.append('amount', selectedAmount);
                                            formData.append('tip', (selectedAmount * tipPercentage) / 100);
                                            formData.append('transaction_fee', coverTransactionCostsCheckbox.checked ? (selectedAmount * 0.029 + 0.30) : 0);
                                            formData.append('total_amount', totalAmount);
                                            formData.append('session_id', sessionId);

                                            fetch('{{ route('donations.store') }}', {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: formData
                                            }).then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    toastr.success('Donation submitted successfully! Your donation number is ' + data.data.donation_number);
                                                    form.reset();
                                                    amountButtons.forEach(btn => btn.classList.remove('active'));
                                                    amountInput.value = '';
                                                    tipSwitcher.value = 0;
                                                    tipAmountText.textContent = '0%';
                                                    coverTransactionCostsCheckbox.checked = false;
                                                    transactionFeeSection.style.display = 'none';
                                                    document.getElementById('session_id').value = '';
                                                    document.getElementById('card-number').value = '';
                                                    document.getElementById('expiry-month').value = '';
                                                    document.getElementById('expiry-year').value = '';
                                                    document.getElementById('security-code').value = '';
                                                    isConfigured = false;
                                                    updateInputStyle();
                                                    updateTipSlider();
                                                    updateDisplayValues();
                                                } else {
                                                    toastr.error(data.message || 'An error occurred.');
                                                }
                                            }).catch(error => {
                                                toastr.error('An error occurred during donation.');
                                                console.error(error);
                                            });
                                        }else if (!response.status) {
                                            toastr.error('Please check your card details.');
                                            console.error(response.message);
                                        }  else {
                                            toastr.error('Invalid payment details. Please check your card information.');
                                        }
                                    }
                                }
                            });
                            isConfigured = true;
                        } else {
                            toastr.error('Failed to update payment session');
                            donateButton.disabled = false;
                            if (loader) loader.remove();
                        }
                    }).catch(error => {
                        toastr.error('Error updating payment session.');
                        console.error(error);
                        donateButton.disabled = false;
                        if (loader) loader.remove();
                    });
                } else {
                    toastr.error('Failed to create payment session');
                    donateButton.disabled = false;
                    if (loader) loader.remove();
                }
            }).catch(error => {
                toastr.error('Error creating payment session.');
                console.error(error);
                donateButton.disabled = false;
                if (loader) loader.remove();
            });
        }
    }

    donateButton.addEventListener('click', e => {
        e.preventDefault();
        const requiredFields = ['first_name', 'last_name', 'email', 'country'];
        let isValid = true;

        requiredFields.forEach(fieldId => {
            const field = form.querySelector(`[name="${fieldId}"]`);
            if (!field || !field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid || selectedAmount <= 0 || !isConfigured) {
            toastr.error('Please enter a valid amount, fill in all required fields, and ensure payment is initialized.');
            donateButton.disabled = false;
            return;
        }

        donateButton.disabled = true;
        const loader = document.createElement('span');
        loader.classList.add('spinner-border', 'spinner-border-sm', 'ml-2');
        donateButton.appendChild(loader);

        PaymentSession.updateSessionFromForm('card');
    });

    updateTipSlider();
    updateDisplayValues();
});
</script>

@endpush
@endsection