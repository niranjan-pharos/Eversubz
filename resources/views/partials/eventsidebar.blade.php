<div id="menu-dropdown"
    class="fixed top-0 left-0 z-50 w-56 bg-white shadow-lg h-full transform -translate-x-full transition-transform duration-300 hidden">
    <div class="flex items-center justify-between p-4 border-b ">
        <h2 class="text-lg font-bold ">Menu</h2>
        <button id="menu-close" class="text-2xl">
            <svg fill="#000000" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <g data-name="Layer 2">
                    <g data-name="close">
                        <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0"></rect>
                        <path
                            d="M13.41 12l4.3-4.29a1 1 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1 1 0 0 0-1.42 1.42l4.3 4.29-4.3 4.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l4.29-4.3 4.29 4.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z">
                        </path>
                    </g>
                </g>
            </svg>
        </button>
    </div>

    <div class="p-2" data-simplebar>

        <nav id="side">
            <ul>
                <li>
                    <a href="{{ asset ('/') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        <span class="spriticon spriticon-home"></span>
                        <span> Home </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route ('products.category_list') }}"
                        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                    
                        <span class="spriticon spriticon-category"></span>

                        <span> Category List </span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset ('business/list') }}"
                        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                       
                        <span class="spriticon spriticon-business"></span>

                        <span> Business List </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route ('ngo.list') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                       
                        <span class="spriticon spriticon-ngo"></span>

                        <span class="">Sabz-Future </span>
                    </a>

                </li>
                <li>
                    <a href="{{ route ('adsList') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        <span class="spriticon spriticon-market"></span>

                        <span> Marketplace </span>
                    </a>
                </li>

                <li>
                    <a href="{{ asset ('shop/products') }}"
                        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        <span class="spriticon spriticon-shop"></span>

                        <span>Shop Now </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route ('events.list') }}"
                        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        <span class="spriticon spriticon-event"></span>

                        <span> Events List </span>
                    </a>
                </li>

                <li>
                        <a href="{{ route ('jobs.list') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                            <span class="spriticon spriticon-business"></span>

                            <span> Job List </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route ('candidates.index') }}"
                            class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">

                            <span class="spriticon spriticon-category"></span>

                            <span> Professional List </span>
                        </a>
                    </li>


                <li class="navbar-item ">
                    <a class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 " href="{{ route ('blogs') }}">

                        <span class="spriticon spriticon-blog"></span>


                        <span>
                            Blogs</span>
                    </a>

                </li>


            </ul>

            <hr>

            <ul>
                <p class="navbar-link" style="font-size: 14px;padding: 10px 15px;">Quick Links</p>

                <li>
                    <a href="{{ asset ('about-us') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        <span class="spriticon spriticon-about"></span>

                        <span> About Us </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route ('show.contact-us') }}"
                        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        
                        <span class="spriticon spriticon-contact"></span>

                        <span> Contact Us </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route ('helpcenter.list') }}"
                        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        
                        <span class="spriticon spriticon-contact"></span>

                        <span> Help Center </span>
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
                        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 ">
                        
                        <span class="spriticon spriticon-privacy"></span>

                        <span> Privacy Policy </span>
                    </a>
                </li>



            </ul>
        </nav>
        <div class="text-xs font-medium flex flex-wrap gap-2 gap-y-0.5 p-2 mt-2">
            <p>© Eversabz 2025. <br>All Rights Reserved.</p>
        </div>
        <div class="bottom-footer-height"></div>


    </div>
</div>