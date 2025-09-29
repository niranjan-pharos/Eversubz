<?php die();?>
<footer class="footer-part d-none">
    <div class="container-fluide">
        <div class="row newsletter">
            <div class="col-lg-8">
                <div class="news-content">
                    <h2>Unlock Exclusive Deals: Straight to Your Inbox!</h2>
                    <p>Subscribe now to receive unbeatable offers and insider deals directly in your inbox!</p>
                </div>
            </div>
            <!-- <div class="col-lg-6">
                    <form class="news-form" action="{{ route('newsletter-form.submit') }}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="Enter Your Email Address"><button type="submit"
                            class="btn btn-inline"><i class="fas fa-envelope"></i><span>Subscribe</span></button></form>
                </div> -->
            <div class="col-lg-4">
                <form class="news-form" id="newsletterForm">
                    @csrf
                    <input type="email" name="email" id="email" placeholder="Enter Your Email Address">
                    <button type="submit" class="btn btn-inline"><i
                            class="fas fa-envelope"></i><span>Subscribe</span></button>
                </form>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-6 col-md-6 col-lg-5">
                <div class="footer-info">

                    <a href="#"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
                    <p>
                        Welcome to EverSabz, your premier online marketplace for a wide array of categories including
                        Electronics, Food & Dining, Entertainment, Sports, Automotive, Fashion & Clothing, Furniture,
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
                        <li><a href="{{ asset ('category-list') }}">Category List</a></li>
                        <li><a href="{{ asset ('business') }}">Business List</a></li>
                        <li><a href="{{ asset ('ads-list') }}">Market Place</a></li>
                        <li><a href="{{ asset ('contactus') }}">Contact Us</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-2">
                <div class="footer-content">
                    <h3>Information</h3>
                    <ul class="footer-widget">
                        <li><a class="" href="{{ asset ('/') }}"> Home</a></li>
                        <li><a href="{{ asset ('about-us') }}">About Us</a></li>
                        <li><a href="{{ asset ('terms-and-condition') }}">Terms & Conditions</a></li>
                        <li><a href="{{ asset ('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-content">
                    <h3>Contact Information</h3>
                    <ul class="footer-address">
                        <!-- <li><i class="fas fa-map-marker-alt"></i>
                                <p>1420 West Jalkuri Fatullah, <span>Narayanganj, BD</span></p>
                            </li> -->
                        <li><i class="fas fa-envelope"></i>
                            <p><a href="mailto:info.eversabz@gmail.com">
                                    info.eversabz@gmail.com</a>
                                <!-- <span>info@classicads.com</span> -->
                            </p>
                        </li>
                        <!-- <li><i class="fas fa-phone-alt"></i>
                                <p>+8801838288389 <span>+8801941101915</span></p>
                            </li> -->
                    </ul>
                    <br>
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
                </div>
            </div>

        </div>
        <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="footer-card-content">
                        <div class="footer-payment"><a href="#"><img src="{{ asset('assets/images/pay-card/01.jpg') }}" alt="01"></a><a
                                href="#"><img src="{{ asset('assets/images/pay-card/02.jpg') }}" alt="02"></a><a href="#"><img
                                    src="{{ asset('assets/images/pay-card/03.jpg') }}" alt="03"></a><a href="#"><img
                                    src="{{ asset('assets/images/pay-card/04.jpg') }}" alt="04"></a></div>
                        <div class="footer-option"><button type="button" data-toggle="modal" data-target="#language"><i
                                    class="fas fa-globe"></i>English</button><button type="button" data-toggle="modal"
                                data-target="#currency"><i class="fas fa-dollar-sign"></i>USD</button></div>
                        <div class="footer-app"><a href="#"><img src="{{ asset('assets/images/play-store.png') }}" alt="play-store"></a><a
                                href="#"><img src="{{ asset('assets/images/app-store.png') }}" alt="app-store"></a></div>
                    </div>
                </div>
            </div> -->
    </div>
    <br><br>
    <div class="footer-end">
        <div class="container-fluide">
            <div class="footer-end-content">
                <p>&copy; 2024 Eversabz. All Rights Reserved.</p>
                <ul class="footer-social">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <!-- <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li> -->
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    <!-- <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li> -->
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <!-- <li><a href="#"><i class="fab fa-dribbble"></i></a></li> -->
                </ul>
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

<style>
.footer-widget li a,
.footer-info p,
.footer-count li p {
    color: #bebebe;
}
</style>

<script>
//wishlist
$(document).ready(function() {
    let storedAdId = localStorage.getItem('wishlistProductId');
    if (storedAdId) {
        let wishlistButton = $(`.wishlistButton[data-ad-id='${storedAdId}']`);
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
                wishable_type: wishableType,
            },
            success: function(response) {
                if (isInWishlist) {
                    $(this).removeClass('fas').addClass('far');
                } else {
                    $(this).removeClass('far').addClass('fas');
                }
                isInWishlist = !isInWishlist;
                displayToastr(response.success, 'success');
                updateWishlistCount();
            }.bind(this),
            error: function(xhr) {
                if (xhr.status === 401) {
                    localStorage.setItem('wishlistProductId', wishableId);
                    window.location.href =
                        `/login?redirect=${encodeURIComponent(window.location.href)}`;
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
                $('#wishlistCount').text(response.count);
            }
        });
    }
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('newsletterForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('{{ route("newsletter-form.submit") }}', {
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
                console.error('Error:', error);
                toastr.error('Email ID already exist.');
            });
    });
});
</script>

<script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/slick.js') }}"></script>
<script src="{{ asset('assets/js/custom/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.min.js"></script>
<!-- Krajee File Input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/themes/fa/theme.min.js"></script>

@include('layouts.common-footer');
</body>
<!-- Mirrored from mironmahmud.com/classicads/assets/ltr/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Jan 2024 08:04:21 GMT -->
</html?>