<div id="site__sidebar mobile"
    class="site__sidebar mobile fixed top-0 left-0 z-[99] pt-[--m-top] overflow-hidden transition-transform xl:duration-500 max-xl:w-full max-xl:-translate-x-full">

    <div
        class="p-2 max-xl:bg-white shadow-sm 2xl:w-72 sm:w-64 w-[80%] h-[calc(100vh-64px)] relative z-30 max-lg:border-r">

        <div class="pr-4" data-simplebar>

        <nav id="side">
                <ul>
                    <li>
                        <a href="{{ asset ('/') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('main_assets/images/icons/home.png') }}" alt="Home" class="w-6">
                            <span> Home </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route ('products.category_list') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/category-list.png') }}" alt="Category List" class="w-5">
                            <span> Category List </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ asset ('business/list') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/business-list.png') }}" alt="Business List" class="w-5">
                            <span> Business Lisasat </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route ('adsList') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/market.png') }}" alt="Marketplace" class="w-5">
                            <span> Marketplace </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ asset ('shop/products') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/shop.png') }}" alt="Shop Now" class="w-5">
                            <span>Shop Now </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route ('events.list') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/event-2.png') }}" alt="Events List" class="w-5">
                            <span> Events List </span>
                        </a>
                    </li>
                    <li>
                            <a href="{{ route ('fundaraising.list') }}"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                                <img src="{{ asset('assets/images/icons/fund.png') }}" alt="Fundraiser" class="w-5">
                                <span>Fundraiser </span>
                            </a>
                        </li>

                    <li class="navbar-item ">
                        <a class="flex items-center gap-2 p-2 rounded hover:bg-gray-100"
                            href="{{ route ('blogs') }}">

                            <img class="w-5" src="{{ asset('assets/images/icons/blog.png') }}" alt="Blogs"><span>
                                Blogs</span></a>

                    </li>


                </ul>

                <hr>

                <ul>
                    <p class="navbar-link" style="font-size: 14px;padding: 10px 15px;">Quick Links</p>

                    <li>
                        <a href="{{ asset ('about-us') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/aboutus.png') }}" alt="About Us" class="w-6">
                            <span> About Us </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route ('show.contact-us') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/contactus.png') }}" alt="Contact Us" class="w-5">
                            <span> Contact Us </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ asset ('terms-of-use') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/terms-condition.png') }}" alt="Terms of Use "
                                class="w-5">
                            <span> Terms of Use</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ asset ('privacy-policy') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
                            <img src="{{ asset('assets/images/icons/privacy-policy.png') }}" alt="Privacy Policy" class="w-5">
                            <span> Privacy Policy </span>
                        </a>
                    </li>



                </ul>
            </nav>
            <div class="text-xs font-medium flex flex-wrap gap-2 gap-y-0.5 p-2 mt-2">
                <p>© Eversabz 2025. <br>All Rights Reserved.</p>
            </div>



        </div>

    </div>

    <div id="site__sidebar__overly" class="absolute top-0 left-0 z-20 w-screen h-screen xl:hidden backdrop-blur-sm"
        uk-toggle="target: #site__sidebar ; cls :!-translate-x-0">
    </div>
</div>