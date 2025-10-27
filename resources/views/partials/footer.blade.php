
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
                        <li><a href="{{ asset ('/') }}">Home</a></li>
                        <li><a href="{{ asset ('about-us') }}">About Us</a></li>
                        <li><a href="{{ asset ('blogs') }}">Blogs</a></li>
                        <li><a href="{{ asset ('pricing-list') }}">Pricing</a></li>
                        <li><a href="{{ asset ('contactus') }}">Contact Us</a></li>
                        <li><a href="{{ asset ('terms-of-use') }}">Terms of Use</a></li>
                        <li><a href="{{ asset ('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                        </div>
                    </div>

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-content">
                    <h3>Counters</h3>
                    <!-- <ul class="footer-address">

                        <li><i class="fas fa-envelope"></i>
                            <p><a href="mailto:eversabz.info@gmail.com">
                                    eversabz.info@gmail.com</a>
                            </p>
                        </li>

                    </ul> -->
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
                    <div class="footer-app" style="display: flex;margin-top:20px;">
                        <a href="https://play.google.com/store/apps/details?id=com.eversabz.twa"><img
                            src="https://eversabz.com/assets/images/play-store.png" alt="play-store"></a>
                            <a href="https://apps.apple.com/in/app/your-app-name/id1234567890">
                                            <img src="https://eversabz.com/assets/images/app-store.png" alt="app-store">
                                            </a>
                                            </a>     
                      </div>
                </div>
            </div>

        </div>

    </div>

    <div class="footer-end">
        <div class="container-fluide">
            <div class="footer-end-content">
                <p>Copyright © 2025, Eversabz Australia Pty Ltd ABN 326 121 886 37 ACN 612 188 637.</p>
                <div class="footer-app" style="display: flex;"><img src="https://eversabz.com/assets/images/payments.png" alt="playments" class="payments-icon" style="width: 100%;height: auto;float: right;">
                </div>
                <!-- <ul class="footer-social">
                    <li>
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                viewBox="0 0 48 48">
                                <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
                                <path fill="#fff"
                                    d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z">
                                </path>
                            </svg>
                        </li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                viewBox="0 0 48 48">
                                <path fill="#03A9F4"
                                    d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429">
                                </path>
                            </svg></li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                viewBox="0 0 48 48">
                                <path fill="#0288D1"
                                    d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z">
                                </path>
                                <path fill="#FFF"
                                    d="M12 19H17V36H12zM14.485 17h-.028C12.965 17 12 15.888 12 14.499 12 13.08 12.995 12 14.514 12c1.521 0 2.458 1.08 2.486 2.499C17 15.887 16.035 17 14.485 17zM36 36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698-1.501 0-2.313 1.012-2.707 1.99C24.957 25.543 25 26.511 25 27v9h-5V19h5v2.616C25.721 20.5 26.85 19 29.738 19c3.578 0 6.261 2.25 6.261 7.274L36 36 36 36z">
                                </path>
                            </svg></li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                viewBox="0 0 48 48">
                                <path fill="#FF3D00"
                                    d="M43.2,33.9c-0.4,2.1-2.1,3.7-4.2,4c-3.3,0.5-8.8,1.1-15,1.1c-6.1,0-11.6-0.6-15-1.1c-2.1-0.3-3.8-1.9-4.2-4C4.4,31.6,4,28.2,4,24c0-4.2,0.4-7.6,0.8-9.9c0.4-2.1,2.1-3.7,4.2-4C12.3,9.6,17.8,9,24,9c6.2,0,11.6,0.6,15,1.1c2.1,0.3,3.8,1.9,4.2,4c0.4,2.3,0.9,5.7,0.9,9.9C44,28.2,43.6,31.6,43.2,33.9z">
                                </path>
                                <path fill="#FFF" d="M20 31L20 17 32 24z"></path>
                            </svg></li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                                viewBox="0 0 48 48">
                                <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38" cy="42.035"
                                    r="44.899" gradientUnits="userSpaceOnUse">
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
                                <radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786" cy="5.54"
                                    r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)"
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
                            </svg></li>
                </ul> -->
            </div>
        </div>
    </div>
</footer>


  
 