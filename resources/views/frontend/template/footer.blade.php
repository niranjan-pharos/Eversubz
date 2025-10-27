<footer class="footer-part">
    <div class="container-fluide">
        <div class="row newsletter">
            <div class="col-lg-7">
                <div class="news-content">
                    <h2>Unlock Exclusive Deals: Straight to Your Inbox!</h2>
                    <p>Subscribe now to receive unbeatable offers and insider deals directly in your inbox!</p>
                </div>
            </div> 
 
            <div class="col-lg-5">
                <form class="news-form" id="newsletterForm">
                    @csrf
                    <input type="email" name="email" id="email" placeholder="Enter Your Email Address">
                    <button type="submit" class="btn btn-inline"><i
                            class="fas fa-envelope"></i> <span>Subscribe</span></button>
                </form>
            </div>
        </div>
        <div class="row footer-part12">

            <div class="col-sm-6 col-md-6 col-lg-5">
                <div class="footer-info" style="line-height: 30px;text-align: justify;padding-right: 30px;">

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <a href="/"><img loading="lazy" src="{{ asset('main_assets/images/logo.png') }}" alt="logo"></a>
                        <a href="/"><img loading="lazy" src="{{ asset('assets/images/sub_future_logo.png') }}" alt="logo"></a>
                    </div>
                    <p>
                        Welcome to EverSabz, your premier online marketplace for a wide array of categories including
                        Electronics, Food &amp; Dining, Entertainment, Sports, Automotive, Fashion &amp; Clothing,
                        Furniture,
                        and much more.
                        At Eversabz, we pride ourselves on being your one-stop destination for all your buying and
                        selling needs across diverse categories.
                    </p>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-2">
                <div class="footer-content">
                    <h3>Quick Links</h3>
                    <ul class="footer-widget">
                    <li><a href="{{ route ('products.category_list') }}">Category List</a></li>
                        <li><a href="{{ route ('business.list') }}">Business List</a></li>
                        <li><a href="{{ route('ngo.list') }}">Sabz-Future</a></li>
                        <li><a href="{{ route ('adsList') }}">Market Place</a></li>
                        <li><a href="{{ route ('product.filter') }}">Shop Now</a></li>
                        <li><a href="{{ route ('events.list') }}">Events</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-2">
                <div class="footer-content">
                    <h3>Information</h3>
                    <ul class="footer-widget">
                        <li><a href="{{ asset('/') }}">Home</a></li>
                        <li><a href="{{ asset('about-us') }}">About Us</a></li>
                        <li><a href="{{ asset('blogs') }}">Blogs</a></li>
                        <li><a href="{{ asset('pricing-list') }}">Pricing</a></li>
                        <li><a href="{{ asset('contactus') }}">Contact Us</a></li>
                        <li><a href="{{ asset('terms-of-use') }}">Terms of Use</a></li>
                        <li><a href="{{ asset('privacy-policy') }}">Privacy Policy</a></li>

                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-content">
                     <h3>Counters</h3>
                  <!--  <ul class="footer-address">

                        <li><i class="fas fa-envelope"></i>
                            <p><a href="mailto:eversabz.info@gmail.com">
                                    eversabz.info@gmail.com</a>
                            </p>
                        </li>

                    </ul>
                    <br> -->
                    <ul class="footer-count">
                        <li>
                            <h5>{{ $footerData['registeredBusinessCount'] }}+</h5>
                            <p>Registered Business</p>
                        </li>
                        <li>
                            <h5>{{ $footerData['productsCount'] }}+</h5>
                            <p>Products</p>
                        </li>
                        <li>
                            <h5>{{ $footerData['productsCount'] }}+</h5>
                            <p>Ads published</p>
                        </li>
                    </ul>
                     <div class="footer-app mt-4"><a href="https://play.google.com/store/apps/details?id=com.eversabz.twa"><img
                            src="https://eversabz.com/assets/images/play-store.png" alt="play-store"></a>
                            <a href="https://apps.apple.com/in/app/your-app-name/id1234567890">
  <img src="https://eversabz.com/assets/images/app-store.png" alt="app-store">
</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <br><br>
    <div class="footer-end">
        <div class="container-fluide">
            <div class="footer-end-content">
                <p>&copy; Copyright © 2025, Everstore Australia Pty Ltd ABN 326 121 886 37 ACN 612 188 637.</p>
                <div class="footer-app" style="display: flex;"><img src="https://eversabz.com/assets/images/payments.png" alt="playments" class="payments-icon" style="width: 100%;height: auto;float: right;">
                </div>
                <!-- <ul class="footer-social">
                    <li><a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                viewBox="0 0 48 48">
                                <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
                                <path fill="#fff"
                                    d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z">
                                </path>
                            </svg>
                        </a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                height="40" viewBox="0 0 48 48">
                                <path fill="#03A9F4"
                                    d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429">
                                </path>
                            </svg></a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                height="40" viewBox="0 0 48 48">
                                <path fill="#0288D1"
                                    d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z">
                                </path>
                                <path fill="#FFF"
                                    d="M12 19H17V36H12zM14.485 17h-.028C12.965 17 12 15.888 12 14.499 12 13.08 12.995 12 14.514 12c1.521 0 2.458 1.08 2.486 2.499C17 15.887 16.035 17 14.485 17zM36 36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698-1.501 0-2.313 1.012-2.707 1.99C24.957 25.543 25 26.511 25 27v9h-5V19h5v2.616C25.721 20.5 26.85 19 29.738 19c3.578 0 6.261 2.25 6.261 7.274L36 36 36 36z">
                                </path>
                            </svg></a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                height="40" viewBox="0 0 48 48">
                                <path fill="#FF3D00"
                                    d="M43.2,33.9c-0.4,2.1-2.1,3.7-4.2,4c-3.3,0.5-8.8,1.1-15,1.1c-6.1,0-11.6-0.6-15-1.1c-2.1-0.3-3.8-1.9-4.2-4C4.4,31.6,4,28.2,4,24c0-4.2,0.4-7.6,0.8-9.9c0.4-2.1,2.1-3.7,4.2-4C12.3,9.6,17.8,9,24,9c6.2,0,11.6,0.6,15,1.1c2.1,0.3,3.8,1.9,4.2,4c0.4,2.3,0.9,5.7,0.9,9.9C44,28.2,43.6,31.6,43.2,33.9z">
                                </path>
                                <path fill="#FFF" d="M20 31L20 17 32 24z"></path>
                            </svg></a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40"
                                height="40" viewBox="0 0 48 48">
                                <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38"
                                    cy="42.035" r="44.899" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#fd5"></stop>
                                    <stop offset=".328" stop-color="#ff543f"></stop>
                                    <stop offset=".348" stop-color="#fc5245"></stop>
                                    <stop offset=".504" stop-color="#e64771"></stop>
                                    <stop offset=".643" stop-color="#d53e91"></stop>
                                    <stop offset=".761" stop-color="#cc39a4"></stop>
                                    <stop offset=".841" stop-color="#c837ab"></stop>
                                </radialGradient>
                                <path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)"
                                    d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                </path>
                                <radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786"
                                    cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#4168c9"></stop>
                                    <stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop>
                                </radialGradient>
                                <path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)"
                                    d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                </path>
                                <path fill="#fff"
                                    d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z">
                                </path>
                                <circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle>
                                <path fill="#fff"
                                    d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z">
                                </path>
                            </svg></a></li>
                </ul> -->
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" id="currency">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Choose a Currency</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body"><button class="modal-link active">United States Doller (USD) - $</button><button
                    class="modal-link">Euro (EUR) - €</button><button class="modal-link">British Pound (GBP) -
                    £</button><button class="modal-link">Australian Dollar (AUD) - A$</button><button
                    class="modal-link">Canadian Dollar (CAD) - C$</button></div>
        </div>
    </div>
</div>
<div class="modal fade" id="language">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Choose a Language</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body"><button class="modal-link active">English</button><button
                    class="modal-link">bangali</button><button class="modal-link">arabic</button><button
                    class="modal-link">germany</button><button class="modal-link">spanish</button></div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


<script src="{{ asset('assets/js/custom/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/themes/fa/theme.min.js"></script>
@stack('scripts')


<script>
    function initializeCityAutocomplete(inputSelector, suggestionsContainerSelector) {
        $(inputSelector).on('input', function() {
            var query = $(this).val();
            if (!query) return;
            fetch(`/cities?q=${query}`).then(response => response.json()).then(cities => {
                const suggestions = $(suggestionsContainerSelector);
                suggestions.empty();
                cities.forEach(city => {
                    $('<li>').text(city).on('click', function() {
                        $(inputSelector).val(city);
                        suggestions.empty()
                    }).appendTo(suggestions)
                })
            })
        })
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentPage = window.location.href;
        var menuItems = document.querySelectorAll(".dash-menu-list a");
        menuItems.forEach(function(item) {
            if (item.href === currentPage) {
                item.classList.add("active")
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.navbar-link').click(function() {
            $('.navbar-link').removeClass('active');
            $(this).addClass('active')
        })
    });
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarBtn = document.querySelector(".mobile-widget.sidebar-btn");
        const sidebar = document.querySelector(".sidebar-part");
        sidebarBtn.addEventListener("click", function() {
            sidebar.classList.toggle("hidden");
            sidebar.classList.toggle("visible")
        })
    });
</script>


<script>
    $(document).ready(function() {

        let storedAdId = localStorage.getItem('wishlistProductId');
        if (storedAdId) {
            let wishlistButton = $(`.wishlistButton[data-wishable-id='${storedAdId}']`);
            if (wishlistButton.length) {
                wishlistButton.click();
            }
            localStorage.removeItem('wishlistProductId');
        }


        $('.wishlistButton').off('click').on('click', function(e) {
            e.preventDefault();
            const wishableId = $(this).data('wishable-id');
            const wishableType = $(this).data('wishable-type');
            let isInWishlist = $(this).hasClass('fas');
            const actionUrl = isInWishlist ? '/wishlist/remove' : '/wishlist/add';
            const ajaxMethod = isInWishlist ? 'DELETE' : 'POST';

            $.ajax({
                url: actionUrl,
                type: ajaxMethod,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    wishable_id: wishableId,
                    wishable_type: wishableType
                },
                success: function(response) {
                    if (isInWishlist) {
                        $(this).removeClass('fas fa-heart').addClass('far fa-heart');
                    } else {
                        $(this).removeClass('far fa-heart').addClass('fas fa-heart');
                    }
                    isInWishlist = !isInWishlist;
                    displayToastr(response.message, 'success');
                    updateWishlistCount();
                }.bind(this),
                error: function(xhr) {
                    if (xhr.status === 401) {
                        displayToastr('Please Login First', 'warning');
                    } else {
                        let errorMsg = xhr.responseJSON && xhr.responseJSON.error ? xhr
                            .responseJSON.error : "An error occurred";
                        displayToastr(errorMsg, 'error');
                    }
                }
            });
        });


        function displayToastr(message, type) {
            if (type === 'success') {
                toastr.success(message);
            } else if (type === 'error') {
                toastr.error(message);
            } else if (type === 'warning') {
                toastr.warning(message);
            } else if (type === 'info') {
                toastr.info(message);
            }
        }


        function updateWishlistCount() {
            $.ajax({
                url: '/wishlist/count',
                type: 'GET',
                success: function(response) {
                    $('.wishlistCount').text(response.count);
                }
            });
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('newsletterForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var emailInput = document.getElementById('email').value.trim();
            console.log('Email Input:', emailInput);

            if (emailInput === '') {
                toastr.error('Please enter your email address.');
                return;
            }

            var formData = new FormData(this);

            fetch('{{ route('newsletter-form.submit') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    toastr.success(data.message);
                    this.reset();
                })
                .catch(error => {
                    toastr.error('Email ID already exists.');
                });
        });
    });


    function checkout() {
        const checkoutUrl = '/checkout';
        window.location.href = checkoutUrl;
    };

    $(document).ready(function() {
        fetchCartContents();

        $('.add-to-cart-button').click(function(event) {
            event.preventDefault();
            var productSlug = $(this).data('product-slug');
            console.log('Product Slug:', productSlug);

            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_slug: productSlug
                },
                success: function(response) {
                    if (response.message) {
                        console.log(response);
                        toastr.success(response.message);
                        updateCartDropdown(response.cartItems, response.cartItemCount,
                            response.cartTotal);
                        openCartDropdown();
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        toastr.error(xhr.responseJSON.error);
                    } else {
                        toastr.error('Error adding product to cart.');
                    }
                }
            });
        });

        function fetchCartContents() {
            $.ajax({
                url: '{{ route('cart.getContents') }}',
                method: 'GET',
                success: function(response) {
                    if (response.cartItems) {
                        updateCartDropdown(response.cartItems, response.cartItemCount, response
                            .cartTotal);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching cart contents.');
                }
            });
        }

    const BASE_URL = "{{ asset('storage') }}";
    
        function updateCartDropdown(cartItems, cartItemCount, cartTotal) {
            var dropdownMenu = $('.dropdown-menu-cart');
            dropdownMenu.empty();

            if (cartItemCount > 0) {
                $.each(cartItems, function(key, item) {
                    var imageUrl = BASE_URL + '/' + item.attributes.image;
                    var truncatedName = item.name.length > 30 ? item.name.substring(0, 30) + '...' : item.name;
                    var price = item.price;

                    dropdownMenu.append(
                        '<li class="dropdown-item cart-item" id="cart-item-' + item.id + '">' +
                        '<img src="' + imageUrl + '" width="50" alt="' + truncatedName + '">' +
                        '<div class="flex-1">' +
                        '<p class="block">' + truncatedName + '</p>' +
                        '<p class="text-sm text-gray-600 qty-item1">(' + item.quantity + ' x $' + price + ')</p>' +
                        '</div>' +
                        '<button class="btn-sm remove-item" onclick="removeFromCart(' + item.id + ')">X</button>' +
                        '</li>'
                    );
                });

                dropdownMenu.append(
                    '<li class="dropdown-item total-price">' +
                    '<strong><span>Total:</span> <span>$' + parseFloat(cartTotal || 0).toFixed(2) + '</span></strong>' +
                    '</li>'
                );

                dropdownMenu.append(
                    '<div class="checkout-btns1">' +
                    '<a class="btn-inline" href="{{ asset('cart') }}"> Cart </a>' +
                    '<a class="btn-inline" href="{{ route('checkout') }}"> Checkout </a>' +
                    '</div>'
                );
            } else {
                dropdownMenu.append('<li class="dropdown-item">No items in cart</li>');
            }
        }


        function updateOrderSummary(cartItems, subTotal, total) {
            var orderSummary = $('.item-cart1'); 
            orderSummary.empty(); 

            $.each(cartItems, function(index, item) {
                var itemHtml = `
                    <div class="checkout-item d-flex justify-content-between" data-product-id="${item.id}">
                        <input type="hidden" name="cartItems[${index}][product_id]" value="${item.id}">
                        <input type="hidden" name="cartItems[${index}][quantity]" value="${item.quantity}">
                        <input type="hidden" name="cartItems[${index}][price]" value="${item.price}">
                        
                        <div class="d-flex card-column"> 
                            <div class="cart-item-remove">
                                <button type="button" class="plain cart-item__remove-btn" title="Remove this item" onclick="removeFromCart(${item.id})">X</button>
                            </div>
                            <div class="cart-item-qty">
                                <span class="text">${item.quantity}x</span>
                            </div>
                            <div class="cart-item-name">
                                ${item.name}
                            </div>
                        </div>
                        <div class="cart-item-price">
                            $${(item.price * item.quantity).toFixed(2)}
                        </div>
                    </div>
                `;
                orderSummary.append(itemHtml); 
            });

            $('.sub-total').text(`$${subTotal.toFixed(2)}`);
            $('.total-price2').text(`$${total.toFixed(2)}`);
        }

        function removeFromCart(itemId) {
            console.log('Removing item with ID:', itemId);

            $.ajax({
                url: '/cart/remove/' + itemId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' 
                },
                success: function(response) {
                    console.log('Item successfully removed:', response); 

                    updateCartDropdown(response.cartItems, response.cartItemCount, response.cartTotal);
                    updateOrderSummary(response.cartItems, response.subTotal, response.total);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error removing item from cart.');
                }
            });
        }


        function openCartDropdown() {
            var $dropdown = $('#menu2');
            $dropdown.dropdown('toggle');

            setTimeout(function() {
                $dropdown.dropdown('toggle');
            }, 4000);
        }

        window.removeFromCart = function(productId) {
            $.ajax({
                url: '/cart/remove/' + productId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.message) {
                        toastr.success(response.message);
                        $('#cart-item-' + productId).remove();
                        fetchCartContents();
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error removing item from cart.');
                }
            });
        }

    });
</script>
<style>.btn-new-one{background:linear-gradient(135deg,#2c54a4,#28a745);color:#fff !Important;border:1px solid #2e69b2;border-radius:50px;padding:9px 20px;margin:20px;transition:transform .3s ease,box-shadow .3s ease}.btn-new-one:hover{transform:scale(1.05);box-shadow:0 8px 20px rgba(0,0,0,0.2)}
.news-form .btn {
    font-size: 14px;
    font-weight: 500;
    border: 2px solid #04b;
    border-radius: 8px;
    letter-spacing: .5px;
    text-transform: uppercase;
    text-shadow: var(--primary-tshadow);
    transition: .3s linear;
    -webkit-transition: .3s linear;
    -moz-transition: .3s linear;
    -ms-transition: .3s linear;
    -o-transition: .3s linear;
    position: absolute;
    top: 5px;
    right: 5px;
    height: 50px;
    width: 175px;
    padding: 10px 30px;
    color: #fff;
    background: #04b;
}
</style>

@include('layouts.common-footer')

</body>

</html>
