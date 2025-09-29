@extends('frontend.template.master')

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

  .cart-item-qty {
    font-size: 13px;
  }

  .card-column {
    column-gap: 10px;
  }

  .checkout-item {
    padding-bottom: 15px;column-gap: 10px;
  }
  .item-cart1{    border-bottom: 1px solid;
    margin-bottom: 1px;}
  .cart-item-name, .cart-item-qty,
  .cart-item-price,  .edit-cart {
    font-size: 16px;
    line-height: normal;display:flex;align-items:center;color: #000;
    font-weight: 500;
  }
  .list-group-item{border: none; padding: .75rem  0px 0px}
  .list-group-item.shipping-price{font-size: 14px;}
  .form-label{font-size: 13px; margin-bottom: 0px;color:#000}
  .inner-section {margin-bottom: 0px;}
  .sub-total1{
    color: #000;
    padding-top: 10px;
    border-top: 1px solid;
    font-weight: bold;
    font-size: 20px;margin-bottom:0.5rem;}
    .gst-price1{
    color: #000;
    font-weight: bold;
    font-size: 16px;margin-bottom:0.5rem;}
    .total1{font-weight: bold;
    font-size: 25px;    color: #000;
    margin-bottom: 0.5rem;
    padding-top: 10px;}
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
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="card mb-4">
          <div class="card-header">
            <h5> Address</h5>
          </div>
          <div class="card-body">
            <form id="checkout-form" method="POST" action="{{ route('cartProcess.payment') }}">
              @csrf
              <div class="row">

                <div class="col-md-6 mb-3">
                  <label for="shipping-name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="shipping-name" name="full_name" required placeholder="John Doe">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping-email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="shipping-email" name="email" required placeholder="john.doe@example.com">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping-number" class="form-label">Phone Number</label>
                  <input type="number" class="form-control" id="shipping-number" name="phone_number" required placeholder="+65665765">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping-address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="shipping-address" name="address" required placeholder="123 Main St">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping-city" class="form-label">City</label>
                  <input type="text" class="form-control" id="shipping-city" name="city" required placeholder="City">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping-state" class="form-label">State</label>
                  <input type="text" class="form-control" id="shipping-state" name="state" required placeholder="State">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping-zip" class="form-label">Zip Code</label>
                  <input type="text" class="form-control" id="shipping-zip" name="zip_code" required placeholder="Zip Code">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping-country" class="form-label">Country</label>
                  <input type="text" class="form-control" id="shipping-country" name="country" placeholder="Country">
                </div>
              </div>
              {{-- <div class="mb-3">
                <input type="checkbox" id="same-address" checked>
                <label for="same-address">Billing address same as shipping address</label>
              </div>--}}
            </form>
          </div>
        </div>
        {{-- <div class="card mb-4 billing-address">
          <div class="card-header">
            <h5>Billing Address</h5>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="billing-name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="billing-name"  placeholder="John Doe">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="billing-email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="billing-email" placeholder="john.doe@example.com">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="billing-number" class="form-label">Phone number</label>
                  <input type="number" class="form-control" id="billing-number" placeholder="john.doe@example.com">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="billing-address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="billing-address" placeholder="123 Main St">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="billing-city" class="form-label">City</label>
                  <input type="text" class="form-control" id="billing-city" placeholder="City">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="billing-state" class="form-label">State</label>
                  <input type="text" class="form-control" id="billing-state" placeholder="State">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="billing-zip" class="form-label">Zip Code</label>
                  <input type="text" class="form-control" id="billing-zip" placeholder="Zip Code">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="billing-country" class="form-label">Country</label>
                  <input type="text" class="form-control" id="billing-country" placeholder="Country">
                </div>
              </div>
            </form>


          </div>
        </div> --}}

        <div class="card mb-4">
          <div class="card-header">
            <h5>Payment Option</h5>
          </div>
          <div class="card-body">

            <div class="payment-option">
              <input type="radio" name="payment-method" id="credit-card" checked>
              <label for="credit-card">Credit Card</label>
              <div class="payment-fields">
                <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="card-name" class="form-label">Name On Card</label>
                  <input type="text" class="form-control" id="card-name" name="name_on_card" required placeholder="John Doe">
                </div>

                  <div class="col-md-6 mb-3">
                    <label for="card-number" class="form-label">Card Number</label>
                    <input type="text" maxlength="19" class="form-control" name="card_number" required id="card-number"
                      placeholder="1234 5678 9012 3456">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="expiry-date" class="form-label">Expiry Date</label>
                    <input type="text" maxlength="5" class="form-control" name="exp_date" placeholder="MM/YY" required id="expiry-date" placeholder="MM/YY">
                  </div>
                  <input type="hidden" name="nonce" id="card-nonce">
                  <div class="col-md-6 mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" required placeholder="123">
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card mb-4 order-summary-section">
          <div class="card-header">
            <h5>Order Summary</h5>
          </div>
          <div class="card-body">
            <div class="item-cart1">
          @foreach($cartItems as $item)
  <div class="checkout-item d-flex justify-content-between" data-product-id="{{ $item->id }}">
    <div class="d-flex card-column">
        <div class="cart-item-remove">
            <button type="button" class="plain cart-item__remove-btn" title="Remove this item from the Cart" onclick="removeFromCart('{{ $item->id }}')">X</button>
        </div>
        
        <div class="cart-item-qty">
            <span class="text">{{ $item->quantity }}x</span>
        </div>
        <div class="cart-item-name">
            {{ $item->name }}
        </div>
    </div>
    <div class="cart-item-price">
        ${{ number_format($item->price * $item->quantity, 2) }}
    </div>
  </div>
  @endforeach
          </div>
  <div class="d-flex justify-content-between sub-total1">
      <p>Sub Total</p>
      <p class="sub-total">${{ number_format($subTotal, 2) }}</p>
  </div>

  <div class="d-flex justify-content-between gst-price1">
      <p>GST</p>
      <p class="gst-value">$0.00</p>
  </div>

  <div class="d-flex justify-content-between gst-price1">
      <p>Shipping</p>
      <p class="shipping-value">$0.00</p>
  </div>
  <div class="d-flex justify-content-between total1">
      <p>Total</p>
      <p class="total-price2">${{ number_format($total, 2) }}</p>
  </div>




           <div class="checkout-btns">

           <button class="btn btn-custom mt-3">Place Order</button>
           </div>
        </div>

        </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.getElementById('same-address').addEventListener('change', function () {
    document.querySelector('.billing-address').style.display = this.checked ? 'none' : 'block';
  });

  document.getElementById('card-number').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); 
    value = value.match(/.{1,4}/g)?.join(' ') || value; 
    e.target.value = value.slice(0, 19);
  });

  document.getElementById('expiry-date').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); 
    if (value.length > 2) {
      value = value.slice(0, 2) + '/' + value.slice(2, 4); 
    }
    e.target.value = value.slice(0, 5); 
  });


  document.addEventListener('DOMContentLoaded', function () {
        
        function updatePrices() {
            let itemPrices = document.querySelectorAll('.cart-item-price');
            let subtotal = 0;

            
            itemPrices.forEach(function (priceElement) {
                subtotal += parseFloat(priceElement.textContent.replace('$', ''));
            });

            
            document.querySelector('.sub-total').textContent = `$${subtotal.toFixed(2)}`;

           
            let gst = subtotal * 0.10;
            document.querySelector('.gst-value').textContent = `$${gst.toFixed(2)}`;

           
            let totalPrice = subtotal + gst;
            document.querySelector('.total-price2').textContent = `$${totalPrice.toFixed(2)}`;
        }

       
        document.querySelectorAll('.cart-item__remove-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                const checkoutItem = this.closest('.checkout-item');
                checkoutItem.remove(); 

                updatePrices(); 
            });
        });

       
        updatePrices();
    });
</script>

<script>
  
  function removeFromCart(productId) {
      $.ajax({
          url: '{{ route("cart.removeItem") }}', 
          method: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              id: productId
          },
          success: function(response) {
              location.reload(); 
          },
          error: function(xhr, status, error) {
              console.error('Error removing item from cart: ', error);
          }
      });
  }
</script>
@endsection