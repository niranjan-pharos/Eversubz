@extends('frontend.template.master')
@section('title', 'Checkout')
@section('description', 'Checkout - Eversubz')
@section('content')
@push('style')
<style>
    body {
        background-color: #F9FAFB;
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
        background-color: var(--primary) !important;
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
        margin-bottom: 60px;    box-shadow: 0px 0px 10px #ccc;

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

    .checkout-cart-product-img {
        width: 130px;
        height: 85px;
        object-fit: contain;
    }

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
        width: 100%;
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

    .card-body  input, .card-body  textarea {
        font-size: 14px;
        transition: border-color 0.3s ease;
        background: #fff;
        border: 1px solid #bbb;
        border-radius: 10px;
        /* Smooth border color transition */
    }

    .card-body input:focus, .card-body textarea:focus {
        border-color: #2d6bb4;
        outline: none;
        background: #f9f9f9;
        border: 1px solid #2d6bb4;
        border-radius: 10px;
    }

    .card-body  input:focus+label,
    .card-body  input:not(:placeholder-shown)+label,
    .card-body  textarea:focus+label,
    .card-body  textarea:not(:placeholder-shown)+label {
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
        margin-bottom: 10px;
        margin-top: 10px;
        padding-top: 10px;
    }
    .row.fw-bold{    border-bottom: 1px solid;
        margin-bottom: 10px;
    
        padding-bottom: 20px;}
    .card-text {
        font-size: 16px;
        font-weight: 600;
        color: #000;
        padding-bottom: 8px;
    }

    .sub-total1 {
        color: #000;
        padding-top: 10px;
        border-top: 1px solid;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 0.5rem;
    }

    .checkout-section .container {
        max-width: 1225px;
    }
    .card-body{padding: 30px;}
    .card-body .container{padding: 0px;}
    .order-summary-section .col-md-9,
    .order-summary-section .col-9,
    .order-summary-section .col-md-6,
    .order-summary-section .col-3,
    .order-summary-section .col-8,
    .order-summary-section .col-4,
    .order-summary-section .col-12,
    .order-summary-section .col-md-3{padding: 0px;}
    .card-images{position: absolute;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    gap: 4px;
    pointer-events: none;}

    .form-control-card {
  letter-spacing: 2px;
}


    @media only screen and (max-width: 767px) {
    .mobile-section1{}
    .mobile-section2{font-size: 15px;}
    .cart-item-name, .cart-item-qty, .cart-item-price, .edit-cart {
        font-size: 13px;

    }
    .sub-total1 {
    font-size: 18px;}
    .card-text1 {
        font-size: 20px;}  .nav-tabs .nav-item {
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


<section class="py-5 checkout-section">
    <div class="container">
        <form id="checkout-form">
            @csrf
            <div class="row">

                @if (empty(Auth::user()))
                <div class="col-md-12">
                    <div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="{{ route('user.login') }}" role="tab">Sign In</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
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
                <div class="col-md-12 mb-4">
                    <h3>Welcome back, {{ Auth::user()->name }}!</h3>
                </div>
                @endif

                <div class="col-lg-7 mt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Address</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="order_id" value="{{ $order_id }}">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="full_name" required placeholder=" ">
                                    <label for="full_name" class="form-label">Full Name</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control" name="email" required placeholder=" ">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="phone_number" required placeholder=" "
                                        maxlength="15">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="address" required placeholder=" ">
                                    <label for="address" class="form-label">Address</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="city" required placeholder=" ">
                                    <label for="city" class="form-label">City</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="state" required placeholder=" ">
                                    <label for="state" class="form-label">State</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="zip_code" required placeholder=" ">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="country" required placeholder=" ">
                                    <label for="country" class="form-label">Country</label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea name="comments" class="form-control" placeholder=" "></textarea>
                                    <label for="comments" class="form-label">Comments</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
    <div class="card-header">
        <h5>Payment Information</h5>
    </div>
    <div class="card-body">
        <div id="payment-form-container" class="form-container">
            <div id="card-fields" class="form-grid row">
                <div class="form-group col-md-12">
                <input type="text" id="card-number" class="form-control form-control-card" maxlength="19" placeholder="">
                    <label class="form-label" for="card-number">Card Number - XXXX XXXX XXXX XXXX:</label>
                    <div data-testid="icons-container" class="card-images">
                        <img src="https://buy.paddle.com/images/icons/visa.svg" alt="visa" data-testid="card-icon-visa" class="sc-cTAIfT dGsWQk">
                        <img src="https://buy.paddle.com/images/icons/mastercard.svg" alt="mastercard" data-testid="card-icon-mastercard" class="sc-cTAIfT dGsWQk">
                        <img src="https://buy.paddle.com/images/icons/amex.svg" alt="amex" data-testid="card-icon-amex" class="sc-cTAIfT dGsWQk">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" id="expiry-month" class="form-control" maxlength="2" placeholder="">
                    <label class="form-label" for="expiry-month">Expiry Month - MM:</label>

                </div>
                <div class="form-group col-md-4">
                    <input type="text" id="expiry-year" class="form-control" maxlength="4" placeholder="">
                    <label class="form-label" for="expiry-year">Expiry Year - YYYY:</label>

                </div>
                <div class="form-group col-md-4">
                    <input type="text" id="security-code" class="form-control" maxlength="3" placeholder="">
                    <label class="form-label" for="security-code">Security Code - CVV:</label>

                </div>
            </div>
        </div>
    </div>
</div>

                </div>

                <div class="col-lg-5 mt-4">
                    <div class="card order-summary-section">
                        <div class="card-header">
                            <h5>Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row fw-bold">
                                    <div class="col-6 col-md-6 mobile-section2"><strong>Product</strong></div>
                                    <div class="col-3 col-md-3 text-center mobile-section2"><strong>Quantity</strong></div>
                                    <div class="col-3 col-md-3 text-end mobile-section2"><strong>Price</strong></div>
                                </div>
                                @foreach($cartItems as $index => $item)
                                    <input type="hidden" name="cartItems[{{ $index }}][product_id]" value="{{ Crypt::encryptString($item->id) }}">
                                    <input type="hidden" name="cartItems[{{ $index }}][quantity]" value="{{ $item->quantity }}">
                                    <input type="hidden" name="cartItems[{{ $index }}][price]" value="{{ $item->price }}">
                                @endforeach

                
                                @php $subTotal = 0; @endphp
                
                                @foreach($cartItems as $item)
                                    @php
                                        $product = \App\Models\BusinessProduct::find($item->id);
                                        $itemTotal = $item->price * $item->quantity;
                                        $subTotal += $itemTotal;
                                    @endphp
                
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-6 col-6">
                                        
                                            <p class="cart-item-name mb-0">{{ $item->name }}</p>
                                        </div>
                                        <div class="col-md-3 col-3 text-center">
                                            <span class="text">{{ $item->quantity }}</span>
                                        </div>
                                        <div class="col-md-3 col-3 text-end">
                                            ${{ number_format($itemTotal, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                
                                <div class="row mt-3 sub-total1">
                                    <div class="col-9">Sub Total:</div>
                                    <div class="col-3 text-end">${{ number_format($subTotal, 2) }}</div>
                                </div>
                                <div class="row card-text">
                                    <div class="col-9">GST ({{ config('constants.GST_PERCENTAGE') }}%):</div>
                                    <div class="col-3 text-end">${{ number_format($gst, 2) }}</div>
                                </div>
                                <div class="row card-text1">
                                    <div class="col-8">Total:</div>
                                    <div class="col-4 text-end">
                                        <p class="total-price2">${{ number_format($total, 2) }}</p>
                                    </div>
                                </div>
                
                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <button id="card-button" onclick="pay();" type="button" class="btn btn-inline1">Submit Order Now</button>
                                    </div>
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
<script src="https://paymentgateway.commbank.com.au/form/version/72/merchant/<MERCHANT_ID>/session.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.getElementById('card-number').addEventListener('input', function (e) {
  let input = e.target.value;
  input = input.replace(/\D/g, '');
  
  let formattedInput = input
    .match(/.{1,4}/g) 
    ?.join(' ')      
    .substring(0, 19); 
  
  e.target.value = formattedInput || '';
});

</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const requiredFields = ['full_name', 'email', 'phone_number', 'address', 'city', 'state', 'zip_code', 'country'];

    document.getElementById('card-button').addEventListener('click', function (event) {
      event.preventDefault();
      if (!validateRequiredFields(requiredFields)) {
        toastr.error('Please fill in all required fields correctly.');
        return;
      }
      PaymentSession.updateSessionFromForm('card');
    });

    PaymentSession.configure({
      session: "",
      fields: {
        card: {
          number: "#card-number",
          expiryMonth: "#expiry-month",
          expiryYear: "#expiry-year",
          securityCode: "#security-code"
        }
      },
      frameEmbeddingMitigation: ["javascript"],
      callbacks: {
        initialized: function (response) {
          console.log("CommWeb Hosted Fields initialized.");
        },
        formSessionUpdate: function (response) {
          if (response.status === "ok") {
            submitPayment(response.session.id);
          } else if (response.status === "fields_in_error") {
            console.error("Validation error:", response.errors);
          } else {
            console.error("System error:", response.errors);
          }
        }
      }
    });

    function validateRequiredFields(fields) {
      let isValid = true;
      fields.forEach(fieldId => {
        const field = document.querySelector(`[name="${fieldId}"]`);
        if (!field || field.value.trim() === '') {
          isValid = false;
          field.classList.add('is-invalid');
        } else {
          field.classList.remove('is-invalid');
        }
      });
      return isValid;
    }

    async function submitPayment(sessionId) {
      const formData = new FormData(document.getElementById('checkout-form'));
      formData.append('session_id', sessionId);

      try {
        const response = await fetch('{{ route('checkout.process') }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          toastr.success('Payment successful!');
          if (result.redirect_url) {
            window.location.href = result.redirect_url;
          }
        } else {
          toastr.error(result.message || 'Payment failed.');
        }
      } catch (error) {
        console.error('Error submitting payment:', error);
        toastr.error('An error occurred during payment.');
      }
    }
  });
</script>





@endpush

@endsection