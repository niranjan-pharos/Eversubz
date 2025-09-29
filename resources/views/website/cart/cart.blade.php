@extends('frontend.template.master')

@section('content')
@section('title', 'Cart')
@section('description', 'Cart - Eversubz')
@push('style')
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

        .cart-item h6 {
            color: #000;
            font-size: 17px;
            font-weight: 600;
        }

        
        .subtotal {
            color: #000;
            font-size: 16px;
            font-weight: 600;
        }
        .cart-item small {
            color: #000;
        }
        .card-body .btn-inline1 {    width: 100%;}
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
            .btn-inline1:hover {color:#fff;
            background: #135013;}
            .cart-bt.btn-inline1{width: 300px;}

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }

        .card-title {
            font-size: 20px;
            margin-bottom: 1rem;
            text-transform: capitalize;
        }

        .card-text {
            font-size: 16px;    font-weight: 600;
            color: #000;padding-bottom:8px
        }

        .card-text1 {
            font-size: 25px;
            color: #000;    font-weight: 700;
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
            color: #000;
        }

        .btn-primary {
            background-color: #2D6BB4;
            border: none;
            border-radius: 5px;
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
            color: #000;

        }

        .col-lg-4 {
            margin-left: auto;
            margin-top: 37px;
        }
        .card-header {
            border-radius: 5px 5px 0px 0px  !important;
            background-color: #0044bb;
            color: #fff;
            margin: 0px;
            padding: 10px !important;
        }
        .card-header h5 {
            margin: 0;
            color: #fff;
        }
        .account-title::before, .card-header::before{content:none;}
        .card-body{padding: 10px 20px;}
        .div12 {
            column-gap: 10px;
            border: 1px solid #2d6bb480;
            padding: 0px 20px;
            border-radius: 5px;
        }
        .div12 .form-control{border:none;background:none;}
        .cart-bt{   
        
            border-radius: 5px;}
            .sub-total1 {
                color: #000;
                padding-top: 10px;
                border-top: 1px solid;
                font-weight: bold;
                font-size: 20px;
                margin-bottom: 0.5rem;
            }

            @media only screen and (max-width:767px){
                .mobile-section{margin-bottom: 80px;}
                .card-header .col-md-2{display:none;}
                .col-md-2{padding-left:25px;}
                .cart-item h6 {
                    font-size: 14px;
                }
                .mobile-col-div12{/*justify-content: right !important;*/}
                .col-4{margin-top: 10px;}
                .col-3{margin-top: 10px;}
                .col-2{margin-top: 10px;}
                .cart-bt.btn-inline1 {
                    width: 100%;
                }
                .div12 {
                    padding: 0px 10px;
                }
            }
    </style>
@endpush();
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

<section class="py-5 mobile-section">
    <div class="container">
        <h3 class="mb-4 d-none">Your Cart</h3>
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
            <div class="card-header row"> 
                <div class="col-md-4">
                    <h5>Product</h5>
                </div>
                <div class="col-md-2 text-center">Price/piece</div>
                <div class="col-md-2 text-center">Qty</div>
                <div class="col-md-2 text-center">Amount</div>
                <div class="col-md-2 text-center">Remove</div>
             </div>
                <div class="card-body">
                    <!-- Cart content as you have it -->
                    <ul id="eversabz-cart" class="list-unstyled">
                        @foreach($cartItems as $item)
                        <li class="cart-item"  data-max-qty="{{ $item->max_qty }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card-columns d-flex align-items-center">
                                        <img src="{{ $item->attributes->image ? asset('storage/'.$item->attributes->image) : asset('storage/no-image.jpg') }}"
                                            class="img-fluid rounded-start me-3" alt="Product Image">
                                        <div>
                                            <h6 class="mb-1">{{ $item->name }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-3 text-center d-flex align-items-center justify-content-center mobile-col-div12">
                                    <div class=" " >
                                            ${{ number_format($item->price, 2) }}
                                        </div>
                                    </div>
                                <div class="col-md-2 col-4 text-center d-flex align-items-center justify-content-center">
                                    <div class="div12 d-flex card-columns justify-content-center">
                                        <button type="button" class="btn-link text-dark p-0" onclick="decreaseQuantity('{{ $item->id }}')">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>
                                        <input min="0" value="{{ $item->quantity }}" id="quantity-{{ $item->id }}"
                                            class="form-control text-center p-0 quantity">
                                        <button type="button" class="btn-link text-dark p-0 increase-btn"
                                            onclick="increaseQuantity('{{ $item->id }}', '{{ $item->max_qty }}')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2 col-3 text-center d-flex align-items-center justify-content-center mobile-col-div12">
                                <div class=" price subtotal" data-price="{{ $item->price }}">
                                        ${{ number_format($item->price * $item->quantity, 2) }}
                                    </div>
                                </div>
                                <div class="col-md-2 col-2 text-center d-flex align-items-center justify-content-center">
                                    
                                    <button class="btn-sm remove-item" onclick="removeFromCart('{{ $item->id }}')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>
            </div>
            <div class="col-md-8" style="margin-top: 37px; ">
                <div class="cart_btn">
                        <a title="cart" class="cart-bt btn-inline1" href="https://eversabz.com/shop/products" style=""><svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 60 60" id="Capa_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M11.68,13l-0.833-5h-2.99C7.411,6.28,5.859,5,4,5C1.794,5,0,6.794,0,9s1.794,4,4,4c1.859,0,3.411-1.28,3.858-3h1.294l0.5,3  H9.614l5.171,26.016c-2.465,0.188-4.518,2.086-4.76,4.474c-0.142,1.405,0.32,2.812,1.268,3.858C12.242,48.397,13.594,49,15,49h2  c0,3.309,2.691,6,6,6s6-2.691,6-6h11c0,3.309,2.691,6,6,6s6-2.691,6-6h4c0.553,0,1-0.447,1-1s-0.447-1-1-1h-4.35  c-0.826-2.327-3.043-4-5.65-4s-4.824,1.673-5.65,4h-11.7c-0.826-2.327-3.043-4-5.65-4s-4.824,1.673-5.65,4H15  c-0.842,0-1.652-0.362-2.224-0.993c-0.577-0.639-0.848-1.461-0.761-2.316c0.152-1.509,1.546-2.69,3.173-2.69h0.791  c0.014,0,0.025,0,0.039,0h38.994C57.763,41,60,38.763,60,36.013V13H11.68z M4,11c-1.103,0-2-0.897-2-2s0.897-2,2-2s2,0.897,2,2  S5.103,11,4,11z M46,45c2.206,0,4,1.794,4,4s-1.794,4-4,4s-4-1.794-4-4S43.794,45,46,45z M23,45c2.206,0,4,1.794,4,4s-1.794,4-4,4  s-4-1.794-4-4S20.794,45,23,45z M58,36.013C58,37.66,56.66,39,55.013,39H16.821l-4.77-24H58V36.013z"></path><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg> Continue Shopping</a>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <p class="d-flex card-text justify-content-between">Items in cart <span id="item-count">{{ $cartItems->count() }}</span></p>
                            
                            <!-- Display Subtotal -->
                            <p class="d-flex card-text justify-content-between sub-total1">
                                price(Excluded GST) <span id="cart-subtotal">${{ number_format($priceBeforeGst, 2) }}</span>
                            </p>
                        
                            <!-- Display GST -->
                            <p class="d-flex card-text justify-content-between">
                                GST ({{ config('constants.GST_PERCENTAGE') }}%) 
                                <span id="gst-total">${{ number_format($gstAmount, 2) }}</span>
                            </p>
                        
                            <!-- Display Shipping -->
                            <p class="d-flex card-text justify-content-between">
                                Shipping <span>$0.00</span>
                            </p>
                        
                            <!-- Display Total -->
                            <p class="d-flex card-text1 justify-content-between">
                                Total <span id="cart-total">${{ number_format($totalAmount, 2) }}</span>
                            </p>
                        
                            <!-- Hidden Field for GST Percentage (can be used for JS calculations) -->
                            <input type="hidden" id="gst-percentage" value="{{ config('constants.GST_PERCENTAGE', 10) }}">
                        
                            <!-- Checkout Button (enabled only if the total amount is greater than 0) -->
                            @if ($totalAmount > 0)
                                <button class="cart-bt btn-inline1" style="width: 100%;" onclick="checkout()">
                                    <svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M 3 6 L 3 26 L 12.585938 26 L 16 29.414062 L 19.414062 26 L 29 26 L 29 6 L 3 6 z M 5 8 L 27 8 L 27 24 L 18.585938 24 L 16 26.585938 L 13.414062 24 L 5 24 L 5 8 z M 15 10 L 15 11.1875 C 13.844 11.6055 13 12.708953 13 14.001953 C 13 15.646953 14.355 17.001953 16 17.001953 C 16.566 17.001953 17 17.435953 17 18.001953 C 17 18.567953 16.566 19.001953 16 19.001953 C 15.434 19.001953 15 18.567953 15 18.001953 L 13 18.001953 C 13 19.294953 13.844 20.396453 15 20.814453 L 15 22 L 17 22 L 17 20.8125 C 18.156 20.3945 19 19.291047 19 17.998047 C 19 16.353047 17.645 14.998047 16 14.998047 C 15.434 14.998047 15 14.564047 15 13.998047 C 15 13.432047 15.434 12.998047 16 12.998047 C 16.566 12.998047 17 13.432047 17 13.998047 L 19 13.998047 C 19 12.705047 18.156 11.603547 17 11.185547 L 17 10 L 15 10 z"></path>
                                    </svg> Proceed to Checkout
                                </button>
                            @else
                                <button class="btn-inline1" disabled>Add items to proceed to checkout.</button>
                            @endif
                        
                            <p class="card-text2">
                                By checking out, you are agreeing to our <a href="{{ route('terms-of-use') }}">Terms</a> of use and understand that your personal information is handled in accordance with Eversabz's Privacy Policy.
                            </p>
                        </div>
                        
                    </div>
                </div>
                
            
        </div>
    </div>
</section>
@push('scripts') 
<script>
    function updateCart() {
        let total = 0;
        let itemCount = 0;

        document.querySelectorAll('.cart-item').forEach(item => {
            const quantityInput = item.querySelector('.quantity');
            const priceElement = item.querySelector('.price');
            const subtotalElement = item.querySelector('.subtotal');
            const maxQty = parseInt(item.dataset.maxQty);

            if (quantityInput && priceElement && subtotalElement) {
                const quantity = parseInt(quantityInput.value);
                const price = parseFloat(priceElement.dataset.price);
                const subtotal = quantity * price;

                subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
                total += subtotal;
                itemCount += quantity;

                const increaseButton = item.querySelector('.increase-btn');
                if (increaseButton) {
                    increaseButton.disabled = quantity >= maxQty;
                }
            }
        });

        const gstPercentage = parseFloat(document.getElementById('gst-percentage').value);
        const priceBeforeGst = total / (1 + (gstPercentage / 100));
        const gstAmount = total - priceBeforeGst;
        const totalAmount = priceBeforeGst + gstAmount;

        const subtotalElement = document.getElementById('cart-subtotal');
        const gstElement = document.getElementById('gst-total');
        const totalElement = document.getElementById('cart-total');
        const itemCountElement = document.getElementById('item-count');
        const checkoutButton = document.querySelector('.btn-primary');

        if (subtotalElement) subtotalElement.textContent = `$${priceBeforeGst.toFixed(2)}`;
        if (gstElement) gstElement.textContent = `$${gstAmount.toFixed(2)}`;
        if (totalElement) totalElement.textContent = `$${totalAmount.toFixed(2)}`;
        if (itemCountElement) itemCountElement.textContent = itemCount;

        if (checkoutButton) {
            checkoutButton.disabled = total <= 0;
            checkoutButton.textContent = total > 0 ? 'Proceed to Checkout' : 'Add items to proceed to checkout.';
        }
    }


    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('input', function () {
                const quantity = parseInt(this.value);
                const cartItem = this.closest('.cart-item');
                const maxQty = parseInt(cartItem.dataset.maxQty);
                const productId = this.dataset.productId;

                if (quantity > 0 && quantity <= maxQty) {
                    updateCartQuantity(productId, quantity);
                } else if (quantity > maxQty) {
                    this.value = maxQty;
                    updateCartQuantity(productId, maxQty);
                    toastr.error('You cannot add more than ' + maxQty + ' items of this product to your cart.');
                } else {
                    this.value = 1;
                    updateCartQuantity(productId, 1);
                }
            });

            input.addEventListener('change', function () {
                const productId = this.dataset.productId;
                const quantity = parseInt(this.value);
                updateCartQuantity(productId, quantity);
            });
        });

        updateCart();
    });

    function updateCartQuantity(productId, quantity) {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error updating cart:', error);
        });
    }

    window.increaseQuantity = function (product_id, max_qty) {
        const input = document.getElementById('quantity-' + product_id);
        const currentQuantity = parseInt(input.value);

        if (input && currentQuantity < max_qty) {
            input.value = currentQuantity + 1;
            updateCartQuantity(product_id, currentQuantity + 1);
        } else if (currentQuantity >= max_qty) {
            toastr.error('You cannot add more than ' + max_qty + ' items of this product to your cart.');
        }
    };

    window.decreaseQuantity = function (product_id) {
        const input = document.getElementById('quantity-' + product_id);
        const currentQuantity = parseInt(input.value);

        if (input && currentQuantity > 1) {
            input.value = currentQuantity - 1;
            updateCartQuantity(product_id, currentQuantity - 1);
        }
    };


    window.removeFromCart = function (product_id) {
        const cartItem = document.getElementById('quantity-' + product_id).closest('.cart-item');

        if (cartItem) {
            fetch(`/cart/remove/${product_id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    cartItem.remove();
                    updateCart();
                    toastr.success(data.message);
                }
            })
            .catch(error => {
                console.error('Error removing item:', error);
                toastr.error('Error removing item from cart.');
            });
        }
    };

</script>


@endpush

@endsection