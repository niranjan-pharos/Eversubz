<link rel="stylesheet" href="{{ asset('assets/css/custom/login.css') }}">

<style>
    .form-group label, label{color: #000 !important;    font-weight: 600 !important;}
    .dash-menu-list ul li a:hover{    color: var(--primary);    border-bottom: 3px solid;
        border-color: var(--primary);}
</style>
<section class="single-banner dashboard-banner">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="dash-menu-list">
                        <ul>
                            <li><a class="" href="{{ asset('dashboard') }}">dashboard</a></li>
                            <li><a href="{{ asset('profile') }}" >Profile</a></li>
                            <li> 
                                <button class="drowpdown-button dropdown-toggle" type="button" id="menu1"
                                    data-toggle="dropdown" aria-expanded="false">My Posts
                                    <span class="caret"></span></button>
                                <ol class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="{{ asset('ad-post') }}">Post List</a></li>
                                    <li><a href="{{ route('ad-post.create') }}">Create</a></li>
                                </ol>
                            </li>

                            {{-- @if(session('is_admin_approved') == 1) --}}
                            @if (Auth::check() && Auth::user()->account_type == 2)
                                <li>
                                    <button class="dropdown-button dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" aria-expanded="false">
                                        My Businesses
                                        <span class="caret"></span>
                                    </button>
                                    <ol class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('business-info.index') }}">Business Info</a></li>
                                        <li><a href="{{ route('business-products.index') }}">Business Products</a></li>
                                        <li><a href="{{ route('business-products.productEnquiries') }}">Products Enquiries</a></li>
                                        <li><a href="{{ route('business-products.create') }}">Create</a></li>
                                        <li><a href="{{ route('business-products.order') }}"> Orders</a></li>
                                        @if(isset($is_approved) && !empty($businessName))
                                            <li><a href="{{ route('enquiries.business', ['business_name' => $businessName]) }}">Enquiries</a></li>
                                        @endif
                                    </ol>
                                </li>
                                @endif 

                                @if (Auth::check() && Auth::user()->account_type == 3)
                                <li>
                                    <button class="drowpdown-button dropdown-toggle" type="button" id="menu1"
                                        data-toggle="dropdown" aria-expanded="false">My Campaign
                                        <span class="caret"></span></button>
                                        <ol class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
                                        
                                        <li><a href="{{ route('fundraising.index') }}">Campaign List</a></li>
                                        <li><a href="{{ route('fundraising.add') }}">Create</a></li>
                                    </ol>
                                </li>
                                @endif

                                <li>
                                    <button class="drowpdown-button dropdown-toggle" type="button" id="menu1"
                                        data-toggle="dropdown" aria-expanded="false">My Jobs
                                        <span class="caret"></span></button>
                                        <ol class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
                                        
                                        <li><a href="{{ route('jobs') }}">Jobs List</a></li>
                                        <li><a href="{{ route('jobs.create') }}">Create Job</a></li>
                                    </ol>
                                </li>


                            {{-- @endif --}}
                            <li>
                                <button class="drowpdown-button dropdown-toggle" type="button" id="menu1"
                                    data-toggle="dropdown" aria-expanded="false">My Events
                                    <span class="caret"></span></button>
                                <ol class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="{{ route('events.index') }}">Events List</a></li>
                                    <li><a href="{{ route('events.add') }}">Create Event</a></li>
                                    <li><a href="{{ route('user.tickets') }}">Purchase Event</a></li>
                                    <li><a href="{{ route('events.seller-tickets-list') }}">Sell Tickets</a></li>
                                </ol>
                            </li>

                              <li>
                                <button class="drowpdown-button dropdown-toggle" type="button" id="menu1"
                                    data-toggle="dropdown" aria-expanded="false">My Orders
                                    <span class="caret"></span></button>
                                <ol class="dropdown-menu" role="menu" aria-labelledby="menu1" style="">
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="{{ route('orders.index') }}">Products Orders</a></li>
                                    <li><a href="{{ route('ordersticket.index') }}">Ticket Booking</a></li>
                                    <li><a href="{{ route('donation.index') }}">My Donation</a></li>
                                </ol>
                            </li>
                            
                            
                            <li><a href="{{ asset('wishlist/list') }}">wishlist</a></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.product-type{z-index:0}.dash-menu-list ul li button{width:100%;font-size:14px;font-weight:500;text-align:center;text-transform:uppercase;padding:12px 0;color:var(--heading);background:var(--white);border-bottom:2px solid var(--white)}.dash-avatar img{height:150px;width:150px}.dash-menu-list ul li ol li a{text-align:left;padding-left:10px}@media (max-width:767px){.dash-menu-list ul li ol{top:40px!important}.dash-header-part {
    margin-top: -20px;}}.dash-menu-list ul li .active{    border-bottom: none;}
.dash-menu-list::-webkit-scrollbar {
    height: 4px; width: 100px;/* Adjust height as needed */
}.dash-menu-list::-webkit-scrollbar-thumb {   background-color: rgba(0, 0, 0, 0.5); /* Adjust color as needed */  border-radius: 4px; /* Adjust border radius as needed */}
.dash-menu-list::-webkit-scrollbar-track { background-color: rgba(0, 0, 0, 0.1); /* Adjust color as needed */}
</style>
