@extends('frontend.template.master')

@section('content')
<style>
  body {
    background-color: #F9FAFB;


  }

  .single-banner {
    margin-bottom: 0px;
  }

  .cart-item {
    border-bottom: 1px solid #ddd;
    padding: 1rem 0;
  }

  .cart-item:last-child {
    border-bottom: none;
  }

  .cart-item img {
    border-radius: 5px;
    height: 60px;
    width: 60px;
    object-fit: contain;
  }

  .cart-item h6,
  .subtotal {
    color: #333;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 11px;
  }

  .cart-item small {
    color: #777;
  }

  .form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    width: 60px;
    text-align: center;
    height: 38px;
    padding: 0px;
  }

  .card {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .card-title {
    font-size: 20px;
    margin-bottom: 1rem;
    text-transform: capitalize;
  }

  .card-text {
    font-size: 14px;
    color: #555;
  }

  .card-text1 {
    font-size: 18px;
    color: #555;
    border-top: 1px solid;
    margin-bottom: 10px;
    margin-top: 10px;
    padding-top: 10px;
  }

  .card-text2 {
    font-size: 10px;
    line-height: normal;
    color: #000;
    margin-top: 10px;
  }
  }

  .card-text span {
    font-weight: bold;
    color: #333;
  }

  .btn-primary {
    background-color: #0d47a1;
    border: none;
    border-radius: 5px;
  }

  .btn-primary:hover {
    background-color: #0a3d91;
  }

  .btn-primary:focus,
  .btn-primary:active {
    box-shadow: none;
  }

  .visually-hidden i {
    font-size: 8px;
  }

  .card-columns {
    column-gap: 0.7rem;
  }

  .card-columns .form-control {
    width: 30px;
    height: 30px;
  }

  .qty-title {
    font-size: 12px;
    font-weight: 600
  }

  .title-cart1 {
    font-size: 16px;
  }

  .btn.btn-primary {
    width: 100%;
  }

  h3 {
    color: #0d47a1;

  }

  .col-lg-4 {
    border-left: 1px solid #ccc;
  }
</style>

<section class="inner-section single-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="single-content">
          <h2>View Cart</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Cart</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <h3 class="mb-4">Your Cart</h3>
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h4 class="title-cart1">Update Your Cart</h4>
            <ul id="eversabz-cart" class="list-unstyled">
              <!-- Cart Item 1 -->
              <li class="cart-item">
                <div class="row">
                  <div class="col-md-8">
                    <div class="card-columns d-flex">
                      <img src="https://eversabz.com/storage/products/4glda4wDnF4AX7oS6DwqQ5HiEHaSi9UOwsU4UVSc.jpg"
                        class="img-fluid rounded-start me-3" alt="Product Image">
                      <div>
                        <h6 class="mb-1">New Leather Handmade Shoulder Bag Buckle Flip Bag</h6>
                        <!-- <small>Navy, Size 18</small> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-6 text-center">
                    <p class="qty-title">Qty</p>
                    <div class="d-flex card-columns align-items-center justify-content-center gap-2">
                      <button type="button" class="btn-link text-dark p-0" onclick="decreaseQuantity('quantity-1')">
                        <span class="visually-hidden"><i class="fa fa-minus" aria-hidden="true"></i></span>
                      </button>
                      <input min="0" value="1" id="quantity-1" class="form-control text-center p-0 quantity">
                      <button type="button" class="btn-link text-dark p-0" onclick="increaseQuantity('quantity-1')">
                        <span class="visually-hidden"><i class="fa fa-plus" aria-hidden="true"></i></span>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-2 col-6 text-center">
                    <div class="text-center price subtotal" data-price="30">$30.00</div>
                    <button class="btn-sm remove-item">
                      <svg width="15px" height="15px" viewBox="-3 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <g id="Group_21" data-name="Group 21" transform="translate(-379 -89)">
                          <path id="Path_23" data-name="Path 23"
                            d="M417,95h-9V93a4,4,0,0,0-4-4h-8a4,4,0,0,0-4,4v2h-9a4,4,0,0,0-4,4v4h.988a2.8,2.8,0,0,1,3.02,2.129l3.532,27.015A5.638,5.638,0,0,0,392,137h16a5.637,5.637,0,0,0,5.459-4.843l3.529-27c.014-.087.36-2.122,3.024-2.153H421V99A4,4,0,0,0,417,95Zm-23-2a2,2,0,0,1,2-2h8a2,2,0,0,1,2,2v2h-2v-.5a1.5,1.5,0,0,0-1.5-1.5h-5a1.5,1.5,0,0,0-1.5,1.5V95h-2Zm-13,6a2,2,0,0,1,2-2h34a2,2,0,0,1,2,2v2H381Zm34.009,5.871-3.534,27.039A3.637,3.637,0,0,1,408,135H392a3.638,3.638,0,0,1-3.476-3.1l-3.536-27.051a4.442,4.442,0,0,0-.8-1.847h31.621A4.5,4.5,0,0,0,415.009,104.871Z"
                            fill="#303033"></path>
                          <g id="Group_20" data-name="Group 20">
                            <rect id="Rectangle_9" data-name="Rectangle 9" width="4" height="18"
                              transform="translate(398 110)" fill="#7d50f9">
                            </rect>
                            <path id="Path_24" data-name="Path 24" d="M406,110h4l-2,18h-2Z" fill="#7d50f9"></path>
                            <path id="Path_25" data-name="Path 25" d="M390,110h4v18h-2Z" fill="#7d50f9"></path>
                          </g>
                        </g>
                      </svg>

                    </button>
                  </div>

                </div>
              </li>

              <!-- Cart Item 2 -->
              <li class="cart-item">
                <div class="row">
                  <div class="col-md-8">
                    <div class="card-columns d-flex">
                      <img src="https://eversabz.com/storage/products/4glda4wDnF4AX7oS6DwqQ5HiEHaSi9UOwsU4UVSc.jpg"
                        class="img-fluid rounded-start me-3" alt="Product Image">
                      <div>
                        <h6 class="mb-1">Hazara Girl Artwork| Hazara Women Cultural Look|
                          Beautiful Afghan Women Artwork</h6>
                        <!-- <small>White, Size M</small> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-6 text-center">
                    <p class="qty-title">Qty</p>
                    <div class="card-columns d-flex align-items-center justify-content-center gap-2">
                      <button type="button" class="btn-link text-dark p-0" onclick="decreaseQuantity('quantity-2')">
                        <span class="visually-hidden"><i class="fa fa-minus" aria-hidden="true"></i></span>
                      </button>
                      <input min="0" value="1" id="quantity-2" class="form-control text-center p-0 quantity">
                      <button type="button" class="btn-link text-dark p-0" onclick="increaseQuantity('quantity-2')">
                        <span class="visually-hidden"><i class="fa fa-plus" aria-hidden="true"></i></span>
                      </button>
                    </div>
                  </div>
                  <div class="col-md-2 col-6 text-center">
                    <div class="text-center price subtotal" data-price="25">$25.00</div>

                    <button class="btn-sm remove-item">
                      <svg width="15px" height="15px" viewBox="-3 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <g id="Group_21" data-name="Group 21" transform="translate(-379 -89)">
                          <path id="Path_23" data-name="Path 23"
                            d="M417,95h-9V93a4,4,0,0,0-4-4h-8a4,4,0,0,0-4,4v2h-9a4,4,0,0,0-4,4v4h.988a2.8,2.8,0,0,1,3.02,2.129l3.532,27.015A5.638,5.638,0,0,0,392,137h16a5.637,5.637,0,0,0,5.459-4.843l3.529-27c.014-.087.36-2.122,3.024-2.153H421V99A4,4,0,0,0,417,95Zm-23-2a2,2,0,0,1,2-2h8a2,2,0,0,1,2,2v2h-2v-.5a1.5,1.5,0,0,0-1.5-1.5h-5a1.5,1.5,0,0,0-1.5,1.5V95h-2Zm-13,6a2,2,0,0,1,2-2h34a2,2,0,0,1,2,2v2H381Zm34.009,5.871-3.534,27.039A3.637,3.637,0,0,1,408,135H392a3.638,3.638,0,0,1-3.476-3.1l-3.536-27.051a4.442,4.442,0,0,0-.8-1.847h31.621A4.5,4.5,0,0,0,415.009,104.871Z"
                            fill="#303033"></path>
                          <g id="Group_20" data-name="Group 20">
                            <rect id="Rectangle_9" data-name="Rectangle 9" width="4" height="18"
                              transform="translate(398 110)" fill="#7d50f9">
                            </rect>
                            <path id="Path_24" data-name="Path 24" d="M406,110h4l-2,18h-2Z" fill="#7d50f9"></path>
                            <path id="Path_25" data-name="Path 25" d="M390,110h4v18h-2Z" fill="#7d50f9"></path>
                          </g>
                        </g>
                      </svg>

                    </button>
                  </div>


                </div>
              </li>

              <!-- Add more cart-item sections as needed -->
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Order Summary</h5>
            <p class="d-flex card-text justify-content-between">Items in cart <span id="item-count">2</span>
            </p>
            <p class="d-flex card-text justify-content-between">Subtotal <span id="cart-subtotal">$55.00</span></p>
            <!-- <p class="d-flex card-text justify-content-between">Delivery <span id="cart-delivery">Free</span></p> -->
            <p class="d-flex card-text1 justify-content-between">Total <span id="cart-total">$55.00</span>
            </p>
            <button class="btn btn-primary" onclick="checkout()">Proceed to Checkout</button>
            <p class="card-text2">By checking out, you are agreeing to our Terms of use and
              understand that your personal information is handled in accordance with Eversabz's Privacy
              Policy.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function updateCart() {
    let total = 0;
    let itemCount = 0;

    document.querySelectorAll('.cart-item').forEach(item => {
      const quantity = parseInt(item.querySelector('.quantity').value);
      const price = parseFloat(item.querySelector('.price').dataset.price);
      const subtotal = quantity * price;
      item.querySelector('.subtotal').textContent = `$${subtotal.toFixed(2)}`;
      total += subtotal;
      itemCount += quantity;
    });

    document.getElementById('cart-subtotal').textContent = `$${total.toFixed(2)}`;
    document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;
    document.getElementById('item-count').textContent = itemCount;
  }

  function increaseQuantity(id) {
    const input = document.getElementById(id);
    input.value = parseInt(input.value) + 1;
    updateCart();
  }

  function decreaseQuantity(id) {
    const input = document.getElementById(id);
    if (parseInt(input.value) > 0) {
      input.value = parseInt(input.value) - 1;
      updateCart();
    }
  }

  document.querySelectorAll('.quantity').forEach(input => {
    input.addEventListener('change', updateCart);
  });

  document.querySelectorAll('.remove-item').forEach(button => {
    button.addEventListener('click', (event) => {
      event.target.closest('.cart-item').remove();
      updateCart();
    });
  });

  // Initial call to set up cart summary correctly on page load
  updateCart();
</script>
@endsection