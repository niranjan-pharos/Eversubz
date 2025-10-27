<link rel="stylesheet" href="{{ asset('assets/css/custom/login.css') }}">

<style>
    .form-group label, label{color: #000 !important;    font-weight: 600 !important;}
    .dash-menu-list ul li a:hover{    color: var(--primary);    border-bottom: 3px solid;
        border-color: var(--primary);}
</style>
<!-- Mobile Sidebar Toggle Button -->
<section class="single-banner dashboard-banner">
    <div class="mobile-sidebar-toggle d-lg-none p-2">
        <button id="sidebarToggle" class="btn">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>@yield('title', "default name")</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://eversabz.com/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title', "default name")</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="dash-header-part">
    <div class="container">
        <div class="dash-header-card">
            <div class="row">
                <div class="col-lg-5">
                    <div class="dash-header-left">
                        
                        <div class="dash-avatar">
                            @if (Auth::user()->image)
                            <a href="#">
                                <img loading="eager" src="{{ asset('storage/'.Auth::user()->image ) }}" alt="{{ Auth::user()->name }}">
                            </a>
                            @else
                            <img loading="eager" src="{{ asset('assets/images/user-image1.png') }}" alt="{{ Auth::user()->name }}">
                            @endif
                        </div>

                        <div class="dash-intro">
                            @if (Auth::check())
                            <h4><a href="#">{{ Auth::user()->name }}</a></h4>
                            <ul class="dash-meta">
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <span>
                                    <a href="tel:{{ Auth::user()->phone }}">{{ Auth::user()->phone }}</a>
                                </span>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span>
                                    <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
                                </span>
                            </li>

                                @if (Auth::user()->address)
                                <li><i class="fas fa-map-marker-alt"></i><span>{{ Auth::user()->address }}</span></li>
                                @endif

                                <li><i class="fa fa-user"></i><span> {{ Auth::user()->uid }}</span></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @php $user_id = Auth::id(); @endphp
                <x-counts :userId="$user_id" />
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="dash-header-alert alert fade show">
                        <p>From your account dashboard. you can easily check & view your recent orders, manage your
                            shipping and billing addresses and Edit your password and account details.</p><button
                            data-dismiss="alert"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>
            <!-- Mobile Sidebar -->
            <div id="mobileSidebar" class="mobile-sidebar d-lg-none">
                <div class="sidebar-header">
                    <h4>Menu</h4>
                    <button id="closeSidebar" class="close-btn">&times;</button>
                </div>

                <ul class="sidebar-menu">
                    <!-- Dashboard -->
                    <li style="justify-items: left;">
                        <a href="{{ asset('dashboard') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                            <i class="fa fa-home me-2"></i> Dashboard
                        </a>
                    </li>

                    <!-- Profile -->
                    <li style="justify-items: left;">
                        <a href="{{ asset('profile') }}" class="{{ request()->is('profile*') ? 'active' : '' }}">
                            <i class="fa fa-user me-2"></i> Profile
                        </a>
                    </li>

                    <!-- My Posts -->
                    <li class="collapsible">
                        <a href="#" class="collapsible-toggle {{ request()->is('ad-post*') ? 'active' : '' }}">
                            <span><i class="fa fa-file-alt me-2"></i> My Posts</span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="collapsible-content" style="{{ request()->is('ad-post*') ? 'display:block;' : '' }}">
                            <li><a href="{{ asset('ad-post') }}" class="{{ request()->is('ad-post') ? 'active' : '' }}">Post List</a></li>
                            <li><a href="{{ route('ad-post.create') }}" class="{{ request()->is('ad-post/create') ? 'active' : '' }}">Create</a></li>
                        </ul>
                    </li>

                    <!-- My Businesses -->
                    @if (Auth::check() && Auth::user()->account_type == 2)
                    <li class="collapsible">
                        <a href="#" class="collapsible-toggle {{ request()->is('business-*') ? 'active' : '' }}">
                            <span><i class="fa fa-building me-2"></i> My Businesses</span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="collapsible-content" style="{{ request()->is('business-*') ? 'display:block;' : '' }}">
                            <li><a href="{{ route('business-info.index') }}" class="{{ request()->is('business-info*') ? 'active' : '' }}">Business Info</a></li>
                            <li><a href="{{ route('business-products.index') }}" class="{{ request()->is('business-products') ? 'active' : '' }}">Business Products</a></li>
                            <li><a href="{{ route('business-products.productEnquiries') }}" class="{{ request()->is('business-products/productEnquiries') ? 'active' : '' }}">Products Enquiries</a></li>
                            <li><a href="{{ route('business-products.create') }}" class="{{ request()->is('business-products/create') ? 'active' : '' }}">Create</a></li>
                            <li><a href="{{ route('business-products.order') }}" class="{{ request()->is('business-products/order') ? 'active' : '' }}">Orders</a></li>
                            @if(isset($is_approved) && !empty($businessName))
                                <li><a href="{{ route('enquiries.business', ['business_name' => $businessName]) }}" class="{{ request()->is('enquiries/business*') ? 'active' : '' }}">Enquiries</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    <!-- My Campaign -->
                    @if (Auth::check() && Auth::user()->account_type == 3)
                    <li class="collapsible">
                        <a href="#" class="collapsible-toggle {{ request()->is('fundraising*') ? 'active' : '' }}">
                            <span><i class="fa fa-bullhorn me-2"></i> My Campaign</span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="collapsible-content" style="{{ request()->is('fundraising*') ? 'display:block;' : '' }}">
                            <li><a href="{{ route('fundraising.index') }}" class="{{ request()->is('fundraising') ? 'active' : '' }}">Campaign List</a></li>
                            <li><a href="{{ route('fundraising.add') }}" class="{{ request()->is('fundraising/add') ? 'active' : '' }}">Create</a></li>
                        </ul>
                    </li>
                    @endif

                    <!-- My Jobs -->
                    <li class="collapsible">
                        <a href="#" class="collapsible-toggle {{ request()->is('jobs*') ? 'active' : '' }}">
                            <span><i class="fa fa-briefcase me-2"></i> My Jobs</span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="collapsible-content" style="{{ request()->is('jobs*') ? 'display:block;' : '' }}">
                            <li><a href="{{ route('jobs') }}" class="{{ request()->is('jobs') ? 'active' : '' }}">Jobs List</a></li>
                            <li><a href="{{ route('jobs.create') }}" class="{{ request()->is('jobs/create') ? 'active' : '' }}">Create Job</a></li>
                        </ul>
                    </li>

                    <!-- My Events -->
                    <li class="collapsible">
                        <a href="#" class="collapsible-toggle {{ request()->is('events*') || request()->is('user/tickets') ? 'active' : '' }}">
                            <span><i class="fa fa-calendar-alt me-2"></i> My Events</span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="collapsible-content" style="{{ request()->is('events*') || request()->is('user/tickets') ? 'display:block;' : '' }}">
                            <li><a href="{{ route('events.index') }}" class="{{ request()->is('events') ? 'active' : '' }}">Events List</a></li>
                            <li><a href="{{ route('events.add') }}" class="{{ request()->is('events/add') ? 'active' : '' }}">Create Event</a></li>
                            <li><a href="{{ route('user.tickets') }}" class="{{ request()->is('user/tickets') ? 'active' : '' }}">Purchase Event</a></li>
                            <li><a href="{{ route('events.seller-tickets-list') }}" class="{{ request()->is('events/seller-tickets-list') ? 'active' : '' }}">Sell Tickets</a></li>
                        </ul>
                    </li>

                    <!-- My Orders -->
                    <li class="collapsible">
                        <a href="#" class="collapsible-toggle {{ request()->is('orders*') || request()->is('ordersticket*') || request()->is('donation*') ? 'active' : '' }}">
                            <span><i class="fa fa-shopping-cart me-2"></i> My Orders</span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="collapsible-content" style="{{ request()->is('orders*') || request()->is('ordersticket*') || request()->is('donation*') ? 'display:block;' : '' }}">
                            <li><a href="{{ route('orders.index') }}" class="{{ request()->is('orders') ? 'active' : '' }}">Products Orders</a></li>
                            <li><a href="{{ route('ordersticket.index') }}" class="{{ request()->is('ordersticket*') ? 'active' : '' }}">Ticket Booking</a></li>
                            <li><a href="{{ route('donation.index') }}" class="{{ request()->is('donation*') ? 'active' : '' }}">My Donation</a></li>
                        </ul>
                    </li>

                    <!-- Wishlist -->
                    <li style="justify-items: left;">
                        <a href="{{ asset('wishlist/list') }}" class="{{ request()->is('wishlist/list') ? 'active' : '' }}">
                            <i class="fa fa-heart me-2"></i> Wishlist
                        </a>
                    </li>
                </ul>
            </div>



            <!-- Desktop Menu -->
            <div class="row d-none d-lg-block">
                <div class="col-lg-12">
                    <div class="dash-menu-list">
                        <ul>
                            <li>
                                <a class="{{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ asset('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>

                            <li>
                                <a class="{{ request()->is('profile*') ? 'active' : '' }}" href="{{ asset('profile') }}">
                                    Profile
                                </a>
                            </li>

                            <li>
                                <button class="drowpdown-button dropdown-toggle {{ request()->is('ad-post*') ? 'active' : '' }}" type="button" id="menu1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    My Posts <span class="caret"></span>
                                </button>
                                <ol class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li><a class="{{ request()->is('ad-post') ? 'active' : '' }}" href="{{ asset('ad-post') }}">Post List</a></li>
                                    <li><a class="{{ request()->is('ad-post/create') ? 'active' : '' }}" href="{{ route('ad-post.create') }}">Create</a></li>
                                </ol>
                            </li>

                            @if (Auth::check() && Auth::user()->account_type == 2)
                                <li>
                                    <button class="dropdown-button dropdown-toggle {{ request()->is('business-*') ? 'active' : '' }}" type="button" id="menu1" data-toggle="dropdown" aria-expanded="false">
                                        My Businesses <span class="caret"></span>
                                    </button>
                                    <ol class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li><a class="{{ request()->is('business-info*') ? 'active' : '' }}" href="{{ route('business-info.index') }}">Business Info</a></li>
                                        <li><a class="{{ request()->is('business-products') ? 'active' : '' }}" href="{{ route('business-products.index') }}">Business Products</a></li>
                                        <li><a class="{{ request()->is('business-products/productEnquiries') ? 'active' : '' }}" href="{{ route('business-products.productEnquiries') }}">Products Enquiries</a></li>
                                        <li><a class="{{ request()->is('business-products/create') ? 'active' : '' }}" href="{{ route('business-products.create') }}">Create</a></li>
                                        <li><a class="{{ request()->is('business-products/order') ? 'active' : '' }}" href="{{ route('business-products.order') }}">Orders</a></li>
                                        @if(isset($is_approved) && !empty($businessName))
                                            <li><a class="{{ request()->is('enquiries/business*') ? 'active' : '' }}" href="{{ route('enquiries.business', ['business_name' => $businessName]) }}">Enquiries</a></li>
                                        @endif
                                    </ol>
                                </li>
                            @endif

                            @if (Auth::check() && Auth::user()->account_type == 3)
                                <li>
                                    <button class="drowpdown-button dropdown-toggle {{ request()->is('fundraising*') ? 'active' : '' }}" type="button" id="menu1"
                                        data-toggle="dropdown" aria-expanded="false">My Campaign
                                        <span class="caret"></span></button>
                                        <ol class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                            <li><a class="{{ request()->is('fundraising') ? 'active' : '' }}" href="{{ route('fundraising.index') }}">Campaign List</a></li>
                                            <li><a class="{{ request()->is('fundraising/add') ? 'active' : '' }}" href="{{ route('fundraising.add') }}">Create</a></li>
                                        </ol>
                                </li>
                            @endif

                            <li>
                                <button class="drowpdown-button dropdown-toggle {{ request()->is('jobs*') ? 'active' : '' }}" type="button" id="menu1"
                                    data-toggle="dropdown" aria-expanded="false">My Jobs
                                    <span class="caret"></span></button>
                                    <ol class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li><a class="{{ request()->is('jobs') ? 'active' : '' }}" href="{{ route('jobs') }}">Jobs List</a></li>
                                        <li><a class="{{ request()->is('jobs/create') ? 'active' : '' }}" href="{{ route('jobs.create') }}">Create Job</a></li>
                                    </ol>
                            </li>

                            <li>
                                <button class="drowpdown-button dropdown-toggle {{ request()->is('events*') ? 'active' : '' }}" type="button" id="menu1"
                                    data-toggle="dropdown" aria-expanded="false">My Events
                                    <span class="caret"></span></button>
                                <ol class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li><a class="{{ request()->is('events') ? 'active' : '' }}" href="{{ route('events.index') }}">Events List</a></li>
                                    <li><a class="{{ request()->is('events/add') ? 'active' : '' }}" href="{{ route('events.add') }}">Create Event</a></li>
                                    <li><a class="{{ request()->is('user/tickets') ? 'active' : '' }}" href="{{ route('user.tickets') }}">Purchase Event</a></li>
                                    <li><a class="{{ request()->is('events/seller-tickets-list') ? 'active' : '' }}" href="{{ route('events.seller-tickets-list') }}">Sell Tickets</a></li>
                                </ol>
                            </li>

                            <li>
                                <button class="drowpdown-button dropdown-toggle {{ request()->is('orders*') || request()->is('ordersticket*') || request()->is('donation*') ? 'active' : '' }}" type="button" id="menu1"
                                    data-toggle="dropdown" aria-expanded="false">My Orders
                                    <span class="caret"></span></button>
                                <ol class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li><a class="{{ request()->is('orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">Products Orders</a></li>
                                    <li><a class="{{ request()->is('ordersticket*') ? 'active' : '' }}" href="{{ route('ordersticket.index') }}">Ticket Booking</a></li>
                                    <li><a class="{{ request()->is('donation*') ? 'active' : '' }}" href="{{ route('donation.index') }}">My Donation</a></li>
                                </ol>
                            </li>

                            <li>
                                <a class="{{ request()->is('wishlist/list*') ? 'active' : '' }}" href="{{ asset('wishlist/list') }}">
                                    Wishlist
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<style>
    .mobile-sidebar {
    position: fixed;
    top: 0;
    left: -280px;
    width: 280px;
    margin-top: 65px;
    height: 80%;
    background: #fff;
    box-shadow: 2px 0 12px rgba(0,0,0,0.2);
    overflow-y: auto;
    transition: left 0.3s ease;
    z-index: 9999;
    padding: 5px;
}

.mobile-sidebar {
    left: -280px;
    transition: left 0.3s ease;
}

.mobile-sidebar.active {
    left: 0;
}

.mobile-sidebar .sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.mobile-sidebar .close-btn {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
}

.mobile-sidebar .sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-sidebar .sidebar-menu li {
    margin-bottom: 5px;
}

.mobile-sidebar .sidebar-menu li a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    color: #333;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.2s;
    cursor: pointer;
    gap: 20px;
}

.dash-menu-list ul li a.active,
.dash-menu-list ul li button.active {
    color: #fff;
    background: #007bff;
    border-bottom: 3px solid;
    border-color: var(--primary);
    border-radius: 8px;
}


.mobile-sidebar .sidebar-menu li a:hover {
    background: #f0f0f0;
}

/* Collapsible submenu */
.collapsible-content {
    max-height: 0;
    overflow: hidden;
    padding-left: 15px;
    transition: max-height 0.3s ease;
}

.collapsible.open .collapsible-content {
    max-height: 500px; /* large enough to show all child links */
}

.sidebar-menu a.active {
    color: #007bff !important;
    font-weight: bold;
    border-left: 3px solid #007bff;
}


/* Arrow rotation */
.collapsible a i {
    transition: transform 0.3s;
}

.collapsible.open a i {
    transform: rotate(180deg);
}

.sidebar-menu li a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    color: #333;
    text-decoration: none;
}

.sidebar-menu li a span {
    display: flex;
    align-items: center;
    gap: 20px
}

.sidebar-menu li a i.fa {
    font-size: 14px;
}

.collapsible-content {
    display: none;
    padding-left: 20px;
}

.collapsible.open .collapsible-content {
    display: block;
}

.collapsible-toggle .fa-chevron-down {
    transition: transform 0.3s ease;
}

.collapsible.open .fa-chevron-down {
    transform: rotate(180deg);
}


/* Sidebar container */
.dash-menu-list {
    padding: 0px;
}

/* Menu list */
.dash-menu-list ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

/* Menu items */
.dash-menu-list ul li {
    margin-bottom: 10px;
    position: relative;
}

/* Menu links */
.dash-menu-list ul li a,
.dash-menu-list ul li button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    width: 100%;
    border: none;
    color: #333;
    font-weight: 500;
    text-align: left;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
}

/* Hover effect */
.dash-menu-list ul li a:hover,
.dash-menu-list ul li button:hover {
    background: #007bff;
    color: #fff;
}

/* Dropdown caret */
.dash-menu-list ul li button .caret {
    transition: transform 0.3s;
}

/* Rotate caret when open */
.dash-menu-list ul li.show > button .caret {
    transform: rotate(180deg);
}

/* Dropdown menu styling */
.dash-menu-list ul li ol.dropdown-menu {
    display: none;
    list-style: none;
    padding: 5px 0 5px 15px;
    margin: 5px 0 0 0;
    border-left: 2px solid #007bff;
}

/* Show dropdown on parent active */
.dash-menu-list ul li.show > ol.dropdown-menu {
    display: block;
}

/* Dropdown menu items */
.dash-menu-list ul li ol.dropdown-menu li a {
    padding: 8px 12px;
    color: #333;
    border-radius: 5px;
    font-size: 14px;
    display: block;
}

.dash-menu-list ul li, .nav-tabs li, .product-card.standard .product-content, .table-list {
    width: 128px;
}

.dash-menu-list ul li ol.dropdown-menu li a:hover {
    background: #007bff;
    color: #fff;
}
#sidebarToggle{
    border: 0px solid #561919;
}
#sidebarToggle i{
    font-size: 25px;
    color: #fff;
    margin-top: -36px;
    margin-left: -20px;
}



.product-type{z-index:0} @media (max-width:767px){.dash-menu-list ul li ol{top:40px!important}.dash-header-part {
    margin-top: -20px;}}.dash-menu-list ul li .active{    border-bottom: none;}
.dash-menu-list::-webkit-scrollbar {
    height: 4px; width: 100px;/* Adjust height as needed */
}.dash-menu-list::-webkit-scrollbar-thumb {   background-color: rgba(0, 0, 0, 0.5); /* Adjust color as needed */  border-radius: 4px; /* Adjust border radius as needed */}
.dash-menu-list::-webkit-scrollbar-track { background-color: rgba(0, 0, 0, 0.1); /* Adjust color as needed */}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('mobileSidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('closeSidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.add('active');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });

    const collapsibles = document.querySelectorAll('.collapsible');

    collapsibles.forEach(item => {
        const toggle = item.querySelector('.collapsible-toggle');
        const content = item.querySelector('.collapsible-content');

        toggle.addEventListener('click', (e) => {
            e.preventDefault(); 
            item.classList.toggle('open');

            if (item.classList.contains('open')) {
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                content.style.maxHeight = "0";
            }
        });
    });
});
</script>
