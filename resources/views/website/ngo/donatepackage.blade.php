@extends('layouts.eventlayout')

@section('title', 'Donation Details | Eversabz')
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
    .sq-card-wrapper{
        margin-right: -25px;
        margin-left: -29px;
    }


    @media only screen and (max-width:767px) {
        #myModal .custom-width {
            width: 95%
        }
    }

    .card {
    max-width: 500px;
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
        border-radius: 6px !important;
    background-color: #fff;
    border: 1px solid #ced4da;
    color: #000;
    transition: all 0.3s ease;
    margin: 10px;
    font-size: 16px;
    padding: 4px 18px;
    font-weight: bold;
    border-color: #b6a9a9;
    }
    .amount-btn.active {
        background-color: #2b54a4 !important;
    color: #fff !important;
    border-color: #2b54a4 !important;
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
        /*overflow: hidden;*/
        position: relative;
        margin-right: 20px;
    }
    /*#tip-switcher::-webkit-slider-runnable-track {
    height: 10px;
    background: #ddd;
}
#tip-switcher::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 28px; 
    height: 28px; 
    background: #2b54a4;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: -400px 0 0 10px #2b54a4;
    margin-top: -9px; 
}
#tip-switcher
    {
  background: linear-gradient(to right, #2b54a4 0%, #2b54a4 50%, #fff 50%, #fff 100%);
  border: solid 1px #2b54a4;
  border-radius: 8px;
  height: 7px;
  width: 356px;
  outline: none;
  transition: background 450ms ease-in;
  -webkit-appearance: none;
}

#tip-switcher::-moz-range-track {
    height: 10px;
    background: #ddd;
}
#tip-switcher::-moz-range-thumb {
    width: 28px; 
    height: 28px; 
    background: #28a745;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: -400px 0 0 400px #28a745;
}
#tip-switcher::after {
    content: '';
    position: absolute;
    width: 16px; 
    height: 16px;
    background: #28a745;
    border-radius: 50%;
    right: -20px; 
    top: 50%;
    transform: translateY(-50%);
}*/

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
        justify-content: space-between;
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
    color: #2b54a4 !important;
    cursor: pointer;
    /* margin-left: 5px; */
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
    border-radius: 10px;
    font-weight: 600;
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
    border-radius: 5px !important;
    padding: 0px 15px !important;
    height: 36px;
    font-size: 14px ! IMPORTANT;
    background: #fff !important;
    border: 1px solid #272c324a !important;
    font-weight: 400 !important;
}
.custom-input-1 {
    border-radius: 5px !important;
    padding: 10px 15px !important;
    min-height: 40px !important;
    font-size: 14px ! IMPORTANT;
    background: #fff !important;
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
/*input[type=range]::-webkit-slider-thumb {
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background-color: #0d6efd!important; 
  border: 2px solid #fff;
  cursor: pointer;
  margin-top: -6px;
  z-index:999999;
}*f/

/* Firefox thumb */
/*input[type=range]::-moz-range-thumb {
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background-color: #0d6efd !important; 
  border: 2px solid #fff;
  cursor: pointer;
}*/
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
    padding: 0px 16px 10px 10px;
    background: none;
    border: 1px solid #c9bdbd;
    border-radius: 5px;
}

.widthforamountcard{
    width: 450px;
}

@media only screen and (max-width: 767px) {
    .px-4 {
    padding-right: 1rem !important;
    padding-left: 1rem !important;
}

.widthforamountcard{
    width: 292px;
}

#site__main{
    margin: 0px;
    padding: 0px;
}
.btn-group, .btn-group-vertical {
    position: relative;
    display: inline;
    margin-left: 0px !important;
}
.amount-btn {
    margin: 0px 10px 10px 0px;
}
.flex-wrap {
    flex-wrap: nowrap !important;
}
.mb0-2{
    margin-bottom:15px;
}
}


</style>
<main id="site__main" class="2xl:ml-0 xl:ml-0 p-2.5 my-3">

    <div class="max-w-[1065px] mx-auto">

        <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10 ">

            <div class="relative overflow-hidden lg:h-80 h-44 w-full">
                <img loading="eager" src="{{ asset('storage/' . $donationPackages->image) }}" alt="main image"
                    class="h-full object-contain inset-0" style="justify-self: center;">

                <div class="w-full bottom-0 absolute left-0 bg-gradient-to-t from -black/60 pt-10 z-10"></div>

            </div>

            <div class="lg:p-5 p-3 lg:px-10 pb-8">

                <div class="flex flex-col justify-center -mt-20">

                    <div class="relative h-20 w-20 mb-4 z-10">
                        <div
                            class="relative overflow-hidden rounded-full md:border-4 border-gray-100 shrink-0  shadow">
                            <img loading="eager" src="{{ asset('storage/' . $donationPackages->image) }}"
                                alt="main image" class="h-full w-full object-contain inset-0">
                        </div>
                    </div>

                    <div class="flex lg:items-end justify-between max-md:flex-col lg:pb-3">

                        <div>
                            <h3 class="md:text-2xl text-base md:font-semibold font-medium text-black ">
                                {{ $donationPackages->name }}</h3>
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
                            <!-- Amount Input Section -->
                            <div class="row mt-1">
                                <div class="col-12 col-md-4 amount-input-container">
                                    <input type="number" class="form-control custom-input widthforamountcard" id="amount" placeholder="Enter Amount in AUD" step="1" min="0" value="{{$price}}" readonly>
                                    @error('amount')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="fundraising_id" id="fundraising_id" value="{{$encryptedId}}">
                            <input type="hidden" name="quantity" id="quantity" value="{{$quantity}}">
                            
                            <!-- Tip Percentage Section with Switcher -->
                            <div class="row ">
                                <div class="col-12">
                                   
                                    <label for="amount" class="form-label labelheading mt-3">Tip Amount</label>
                                    <div class="d-flex justify-content-between" style="position: relative;">
                                        <div style="min-width: 90%; max-width:92%; width: -webkit-fill-available;">
                                            <input type="range" class="form-range-dnu" id="tip-switcher" name="tipPercentage" min="0" max="60" step="1" value="0">
                                        </div>
                                        <div>
                                            <span id="tip-amount">0%</span>
                                        </div>
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
                                        {{-- <img src="https://eversabz.com/assets/images/smiley.svg" 
                                            class="me-3" 
                                            style="width: 48px; height: 48px;"> --}}
                                        <p class="mb-0" style="font-size: 1rem; color: #333; line-height: 1.4;">
                                            <strong style="color: #2b54a4;">Sabz-Future </strong>  has a 0% platform fee for organisers and together lets make Future Sabz 
                                        </p>
                                    </div>
                                </div>
                                </div>

                            
                            <!-- Cover Transaction Costs Section -->
                            <div class="row mt-3">
                                <div class="col-12">

                                    <div class="">
                                        <label class="form-check-label" for="cover-transaction-costs" style="font-weight: 500;">
                                        Cover Transaction Costs
                                        </label>

                                    <span id="info-icon" 
                                        class="fa fa-info-circle ms-2 text-primary" 
                                        style="cursor: pointer;" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="right" 
                                        title="Transaction fees are paid to external payment processors (2.9% + $0.3) and do not go to Eversabz.">
                                    </span>
                                    <p class=" text-black d-block mt-1" style="line-height: 1.4;margin-left:12px;">
                                        By covering the transaction fee, you help the campaign receive <strong>100%</strong> of your support.
                                    </p>
                                    {{-- <input type="text" class="form-control custom-input" placeholder="Transaction Fee ( 2.9% + $0.3)" > --}}
                                    </div>

                                    
                                    @error('transaction_fee')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            
                            <div class="d-flex flex-wrap align-items-center gap-4 values-card" id="main_amounts_section" style="font-size: 1rem;">
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
                <div class="value-display" id="total" style="border-left: 2px solid #ddd; padding-left: 12px; font-weight: 600; color: #2b54a4;">
                    <span class="fw-bold">Total:</span> <span id="total-display" class="ms-1 fw-bold" disabled>$0.00</span>
                </div>
                    </div>


                           



                
                            <!-- Additional Fields -->
                            <div class="row mt-3">
                               <div class="col-12 col-md-12">
                                <hr>
                              </div>
                            </div>
                              <div class="row mt-3">
                                <div class="col-12  col-md-6">
                                    
                                    <input type="text" class="form-control custom-input mb0-2" id="first_name" placeholder="Enter your name" name="first_name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="email" class="form-control custom-input mb0-2" name="email"  id="email" placeholder="Enter your email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                
                                <div class="col-12 col-md-6">                                    
                                    <input type="text" class="form-control custom-input mb0-2" id="phone" name="phone"  placeholder="Enter your phone no." value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- <label for="country" class="form-label labelheading">Country ;</label> -->
                                    <select name="country" class="form-control custom-input mb0-2" id="country" name="country">
                                        <option value="" {{ old('country') ? '' : 'selected' }} disabled>Select Your Country</option>
                                        <option value="australia" {{ old('country') == 'australia' ? 'selected' : '' }}>Australia</option>
                                    </select>
                                    @error('country')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <!-- <label for="message" class="form-label labelheading">Message to Donor</label> -->
                                    <textarea class="form-control custom-input-1" id="message" rows="3" name="message" placeholder="Write a message..." style="margin-bottom: 20px;">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-12">
                                    <input type="checkbox" id="anonymous" name="anonymous" value="1">&nbsp;Don’t display my name publicly
                                
                                </div>
                                <div class="col-12 col-md-12 mt-3">
                                     <hr>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <div class="">
                                    <h5>Payment Information</h5>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex gap-2">
                                        <img src="https://eversabz.com/assets/images/pay-card/01.jpg" style="width: 40px; margin-right: 10px;">
                                        <img src="https://eversabz.com/assets/images/pay-card/02.jpg" style="width: 40px; margin-right: 10px;">
                                        <img src="https://eversabz.com/assets/images/pay-card/03.jpg" style="width: 40px; margin-right: 10px;">
                                    </div>
                                    <div class="card-body">
                                        <div id="payment-form-container">
                                            <div id="card-container"></div>
            
                                        </div>
                                    </div>
                                      
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn w-100 mb-2" id="donate-btn">Donate Now</button>
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

                                <div class="grid grid-cols-3 gap-2 text-sm mt-3">
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

<script src="https://web.squarecdn.com/v1/square.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {

    function loadToastr() {
        if (typeof toastr !== 'undefined') { initializeToastrOptions(); return; }

        const toastrCSS = document.createElement('link');
        toastrCSS.rel = 'stylesheet';
        toastrCSS.href = 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css';
        document.head.appendChild(toastrCSS);

        const toastrJS = document.createElement('script');
        toastrJS.src = 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js';
        toastrJS.onload = initializeToastrOptions;
        document.head.appendChild(toastrJS);
    }

    function initializeToastrOptions() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 5000
        };
    }
    loadToastr();

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
            window.addEventListener('click', e => { if (!btn.contains(e.target) && !menu.contains(e.target)) menu.classList.remove('show'); });
        }
    });

    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => { btn.classList.remove('btn-primary'); btn.classList.add('btn-secondary-text'); });
            document.getElementById(tabId).classList.add('active');
            button.classList.remove('btn-secondary-text');
            button.classList.add('btn-primary');
        });
    });
    document.querySelector('.tab-btn')?.click();

    const amountButtons = document.querySelectorAll('.amount-btn');
    const amountInput = document.getElementById('amount');
    const displayAmount = document.getElementById('display-amount');
    const displayTip = document.getElementById('display-tip');
    const displayTransactionFee = document.getElementById('display-transaction-fee');
    const totalDisplay = document.getElementById('total-display');
    const donateButton = document.getElementById('donate-btn');
    const form = document.getElementById('donation-form');
    const tipSwitcher = document.getElementById('tip-switcher');
    const tipAmountDisplay = document.getElementById('tip-amount');

    let selectedAmount = Number('{{ $price }}') || 0;
    amountInput.value = selectedAmount;

    function updateAmountAndTipSections() {
        const amount = Number(amountInput.value) || 0;
        const tipValue = (tipSwitcher.value / 100) * amount;
        const transactionFee = (amount * 0.029) + 0.3;
        const totalAmount = amount + tipValue + transactionFee;

        displayAmount.textContent = `$${amount.toFixed(2)}`;
        displayTip.textContent = `$${tipValue.toFixed(2)}`;

        displayTransactionFee.textContent = `$${transactionFee.toFixed(2)}`;
            document.getElementById('transaction-fee-section').style.display = 'flex';

        totalDisplay.textContent = `$${totalAmount.toFixed(2)}`;
    }

    function syncButtonsWithInput() {
        const val = Number(amountInput.value);
        if (!Number.isFinite(val) || val <= 0) {
            amountButtons.forEach(btn => btn.classList.remove('active'));
            selectedAmount = 0;
            updateAmountAndTipSections();
            return;
        }

        let matched = false;
        amountButtons.forEach(btn => {
            const btnVal = Number(btn.dataset.amount);
            if (btnVal === val) {
                btn.classList.add('active');
                matched = true;
            } else {
                btn.classList.remove('active');
            }
        });

        if (!matched) selectedAmount = val;
        updateAmountAndTipSections();
    }

    amountInput.addEventListener('input', syncButtonsWithInput);
    amountInput.addEventListener('change', syncButtonsWithInput);

    tipSwitcher.addEventListener('input', function() {
        tipAmountDisplay.textContent = `${tipSwitcher.value}%`;
        updateAmountAndTipSections();
        const value = (this.value - this.min)/(this.max - this.min)*100;
        this.style.background = `linear-gradient(to right, rgb(44 91 168) 0%, rgb(43 88 167) ${value}%, #ddd ${value}%, #ddd 100%)`;
    });

    const infoIcon = document.getElementById('info-icon');
    const infoMessage = 'Transaction fees are paid to external <br>payment processors ( 2.9% + $0.3 )<br>and do not go to eversabz.';
    infoIcon.addEventListener('mouseenter', function() {
        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = infoMessage;
        infoIcon.appendChild(tooltip);
    });
    infoIcon.addEventListener('mouseleave', function() {
        const tooltip = infoIcon.querySelector('.tooltip');
        if (tooltip) tooltip.remove();
    });

    async function initializeSquarePayment() {
        const appId = "{{ config('services.square.application_id') }}";
        const locationId = "{{ config('services.square.location_id') }}";
        let payments, card;

        try {
            payments = window.Square.payments(appId, locationId);
            card = await payments.card();
            await card.attach('#card-container');
        } catch (error) {
            toastr.error('Failed to initialize Square payment system. Please refresh and try again.');
            console.error("Square payment init error:", error);
            return;
        }

        donateButton.addEventListener('click', async (e) => {
            e.preventDefault();

            const requiredFields = ['first_name', 'phone', 'email', 'country'];
            let isValid = true;
            requiredFields.forEach(fieldId => {
                const field = form.querySelector(`[name="${fieldId}"]`);
                if (field) {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else field.classList.remove('is-invalid');
                }
            });
            if (!isValid) { toastr.error('Please fill in all required fields.'); return; }

            donateButton.disabled = true;
            const loader = document.createElement('span');
            loader.classList.add('spinner-border', 'spinner-border-sm', 'ml-2');
            donateButton.appendChild(loader);

            try {
                const result = await card.tokenize();

                console.log(result);

                if (result.status !== 'OK') throw new Error(result.errors ? result.errors.map(e => e.message).join(', ') : 'Card tokenization failed.');
                const nonce = result.token;

                const payload = {
                    nonce,
                    amount: Number(amountInput.value),
                    first_name: form.querySelector('[name="first_name"]').value,
                    phone: form.querySelector('[name="phone"]').value,
                    email: form.querySelector('[name="email"]').value,
                    country: form.querySelector('[name="country"]').value,
                    anonymous: form.querySelector('[name="anonymous"]').checked ? 1 : 0,
                    message: form.querySelector('[name="message"]').value,
                    fundraising_id: form.querySelector('[name="fundraising_id"]').value,
                    quantity: form.querySelector('[name="quantity"]').value,
                    tipPercentage: form.querySelector('[name="tipPercentage"]').value,
                    coverTransactionCosts: form.querySelector('[name="coverTransactionCosts"]').value,
                };

                const response = await fetch("{{ route('donations.save') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                console.log(response);

                const data = await response.json();

                if (data.success) {
                    toastr.success('Donation submitted successfully!');
                    form.reset();
                    amountButtons.forEach(btn => btn.classList.remove('active'));
                    amountInput.value = selectedAmount = Number('{{ $price }}');
                    tipSwitcher.value = 0;
                    tipAmountDisplay.textContent = '0%';
                    updateAmountAndTipSections();
                    window.location.href = '{{ route("donations.success") }}';
                } else toastr.error(data.message || 'An error occurred during donation.');
            } catch (error) {
                toastr.error('An error occurred while processing your payment.');
                console.error('Error:', error);
            } finally {
                donateButton.disabled = false;
                const loaderEl = donateButton.querySelector('.spinner-border');
                if (loaderEl) loaderEl.remove();
            }
        });
    }

    initializeSquarePayment();
    updateAmountAndTipSections();

});
</script>


@endpush
@endsection