<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Eversabz">
		<meta name="keywords" content="admin, Eversabz">
        <meta name="author" content="Eversabz">
        <meta name="robots" content="noindex, nofollow">
        <title>@yield('Admin | Login')</title>
		
		<meta name="description" content="@yield('description', config('app.description'))">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">

		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-datetimepicker.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin_assets/css/line-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin_assets/css/dataTables.bootstrap4.min.css') }}">

		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-select.css') }}">
        
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-iconpicker.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin_assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
		<!-- DataTable Css -->
		<link rel="stylesheet" href="{{ asset('assets/css/custom/main.css') }}">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.5/css/jquery.dataTables.css"/>
	
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.css"/>
		
		<!-- jQuery -->
        <!-- <script src="{{ asset('admin_assets/js/jquery-3.2.1.min.js') }}"></script> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

	

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="{{ asset('admin_assets/js/html5shiv.min.js') }}"></script>
			<script src="{{ asset('admin_assets/js/respond.min.js') }}"></script>
		<![endif]-->
		<style>
			.header .user-menu.nav > li > a i {
			    font-size: 29px;
			    margin-right: 10px;
			    line-height: 61px;
			}
			.custom-table {
				border-bottom: 1px solid #e2e5e8 !important;
			}
			.custom-table tbody tr:nth-child(even){background-color: transparent !important;}
			.btn{
				padding: 0.25rem 0.5rem;
			    border: none;
			}
			table.dataTable thead .sorting_desc{    background-image: none !important;}
			table.dataTable thead .sorting_asc{    background-image: none !important;}
			table.dataTable tbody th, table.dataTable tbody td {
			    padding: 8px 10px;
			    white-space: normal;color: #000 !important;
			    text-align-last: center !important;
			}

			/* Hide default unsorted icons */
			table.dataTable thead .sorting:before,
			table.dataTable thead .sorting:after {
			    display: none !important;
			}

			/* Base pagination */
			.dataTables_wrapper .dataTables_paginate .paginate_button {
			    background: transparent !important;
			    color: #333 !important;
			    padding: 6px 10px;
			    margin: 0 2px;
			    cursor: pointer;
			    border: none !important;
			    border-radius: 0 !important;
			}

			/* Hover (grey bg + blue text) */
			.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
			    background: #e9ecef !important;
			    color: #007bff !important;
			}

			/* Active page */
			.dataTables_wrapper .dataTables_paginate .paginate_button.current {
			    background: #007bff !important;
			    color: #fff !important;
			    font-weight: bold;
			}

			/* Disabled buttons */
			.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
			    color: #6c757d !important;
			    cursor: not-allowed;
			    background: transparent !important;
			}

			/* Replace "Previous" with left chevron */
			.dataTables_wrapper .dataTables_paginate .previous a {
			    font-size: 0; /* hide text */
			}
			.dataTables_wrapper .dataTables_paginate .previous a::before {
			    content: "◀"; /* or use "\f053" with FontAwesome */
			    font-size: 14px;
			    color: #333;
			}

			/* Replace "Next" with right chevron */
			.dataTables_wrapper .dataTables_paginate .next a {
			    font-size: 0; /* hide text */
			}
			.dataTables_wrapper .dataTables_paginate .next a::before {
			    content: "▶"; /* or use "\f054" with FontAwesome */
			    font-size: 14px;
			    color: #333;
			}

			/* Hover effect */
			.dataTables_wrapper .dataTables_paginate .paginate_button:hover::before {
			    color: #007bff; /* blue on hover */
			}

			/* Active page */
			.dataTables_wrapper .dataTables_paginate .paginate_button.current {
			    background: #007bff !important;
			    color: #fff !important;
			    font-weight: bold;
			}


			table.dataTable tbody td,
			table.dataTable thead th {
			    padding: 2px 6px !important;
			    font-size: 13px;   /* optional: smaller font */
			}

			/* Style DataTable header */
			table.dataTable thead th {
			    background-color: #fff !important;  /* light grey */
			    font-weight: bold;
			    color: #333;  /* dark text */
			    padding: 8px; /* adjust spacing */
			    text-align: center; /* optional: center text */
			    border-top: none;
			}

			/* Show & style ASC icon */
			table.dataTable thead .sorting_asc:after {
			    content: "▲"; /* up arrow */
			    font-size: 0.7rem;
			    margin-left: 5px;
			    color: #007bff; /* Bootstrap primary color */
			    display: inline-block;
			}

			/* Show & style DESC icon */
			table.dataTable thead .sorting_desc:after {
			    content: "▼"; /* down arrow */
			    font-size: 0.7rem;
			    margin-left: 5px;
			    color: #007bff;
			    display: inline-block;
			}


			table.dataTable td, table.dataTable th, .custom-table th, .custom-table td {
			    border-bottom: 1px;
			    border-color: #aaa;
			    border-radius: 0px;
			    border-right: 0px;
			    padding: 20px 10px !important;
			    border-left: 0px;
			    white-space: nowrap !important;
			    color: #595959;
			    font-size: 14px;
			}

			.custom-table tbody tr:hover{background-color: transparent !important;}
			table.dataTable th, .custom-table th {
			        /*background-color: #007bff36 !important;
			    color: #000000;*/
			    text-align-last: center;
			    text-transform: uppercase;
			    font-size: 14px;
			    padding: 10px;
			    }
				.sidebar{ background-color: #f2f4f5;
					border-right: 1px solid #ddd;}
					.sidebar .sidebar-menu ul li a{	color: #5e5e5e;	font-size: 14px;    padding: 12px 15px 12px 20px; text-decoration: none;
					    position: relative;
					    padding: .5rem 1.25rem;
					    line-height: 1.45;
					    color: var(--bs-app-sidebar-color);
					    display: flex;
					    align-items: center;
					    transition: all .2s ease-in-out;
					    border-radius: 0 1.25rem 1.25rem 0;}
							.sidebar .sidebar-menu ul ul a{padding: 9px 10px 9px 50px !important;}
							.sidebar .sidebar-menu ul li a:hover{    color: #222222; background: #e4e7eb;
					}

					.sidebar .sidebar-menu ul li a .menu-arrow {
						font-weight: 800 !important;
					}

			body{    background: #F7F9FB}
			.header{    background: #FFFFFF;}
			.header #toggle_btn .bar-icon span {
				background-color: #2b6eb6;}
				.header .mobile-user-menu {
			    display: block;
			    float: right;
			    font-size: 14px;
			    height: 60px;
			    line-height: 60px;
			    text-align: right;
			    width: 60px;
			    z-index: 10;
			    padding: 0 20px;
			    position: absolute;
			    top: 0;
			    right: 45px;
			}.header .mobile-user-menu a {
			    color: #0d6efd;}
				.mini-sidebar .sidebar .sidebar-menu > ul > li > a{    padding: 12px 15px 12px 20px;}
				.mini-sidebar.expand-menu .sidebar .sidebar-menu > ul > li > a i, .mini-sidebar .sidebar .sidebar-menu > ul > li > a i{
			        font-size: 23px;}

			        .page-link, .team-card ul li a i {
			        	width: 25px !important;
					    height: 25px !important;
					    line-height: 28px !important;
			        }
		
			</style>

			<script>
				$(document).ready(function() {
					$('.custom-table tbody').on('click', 'td img', function () {
		                let imgSrc = $(this).attr('src');
		                if (imgSrc) {
		                    window.open(imgSrc, '_blank');
		                }
            		});
				});
			</script>
    </head>

    <body class="mini-sidebar">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="{{ asset('/') }}" class="logo">
						<img src="{{ asset('assets/images/favicon.png') }}" width="40" height="40" alt="">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>{{ config('app.name') }}</h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<!-- <ul class="nav user-menu">
				
					
					<li class="nav-item dropdown has-arrow main-drop">
						
						@auth('admin')
						{{-- <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown"> --}}
							<i class="fa fa-user-circle-o"></i>
							<span>{{ Auth::guard('admin')->user()->name }}</span>
						{{-- </a> --}}
						@else
						<script>
							window.location.href = "{{ route('adminLogin') }}"; 
						</script>
						@endauth
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{ route('admin.adminProfile') }}">Settings</a>
							<a class="dropdown-item" href="{{ route('admin_logout')}}">Logout</a>
						</div>
					</li>
				</ul> -->
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
				 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user-circle-o"></i> Admin</a>
					<div class="dropdown-menu dropdown-menu-right">
					<!-- <a class="dropdown-item" href="{{ route('admin.adminProfile') }}">Settings</a> -->
					<a class="dropdown-item" href="{{ route('admin_logout')}}">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
		
			<!-- Sidebar -->
			<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu" style="overflow-x: hidden;">
						<ul>
							<li class="submenu_rem">
								<a href="{{ route('adminDashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span> </a>
							</li>
							
							<li class="submenu {{ setActive([
								'admin.category.*','admin.subcategory.*'
								])}} ">
								<a href="#"><i class="la la-connectdevelop"></i> <span> Category</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="{{ request()->routeIs('businessCategory*') ? 'active' : '' }}">
										<a href="{{ route('businessCategory.index') }}">Business Category</a>
									</li>
									<li class="{{ request()->routeIs('ngoCategory*') ? 'active' : '' }}">
										<a href="{{ route('ngoCategory') }}">NGO Category</a>
									</li>
									<li class="{{ request()->routeIs('fundarasingCategory*') ? 'active' : '' }}">
										<a href="{{ route('fundarasingCategory.index') }}">Fundraising Category</a>
									</li>
									<li class="{{ request()->routeIs('adminCategory*') ? 'active' : '' }}">
										<a href="{{ route('adminCategory') }}">Category</a>
									</li>
									<li class="{{ request()->routeIs('adminSubcategory*') ? 'active' : '' }}">
										<a href="{{ route('adminSubcategory') }}">Subcategory</a>
									</li>
									<li class="{{ request()->routeIs('eventsCategory*') ? 'active' : '' }}">
										<a href="{{ route('eventsCategory.index') }}">Events Category</a>
									</li>
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'admin.adPost.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> Ads Post</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['admin.adPost.*'])}}"><a href="{{ route('adPost.listing') }}">Post Listing</a></li>
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'admin.allProducts.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> All Products</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['admin.allProducts.*'])}}"><a href="{{ route('admin.allProducts') }}">Products Listing</a></li>
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'admin.adPost.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> Orders</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['admin.orderticket.*'])}}"><a href="{{ route('orderticket') }}">Ticket Orders</a></li>
									  <li class="{{ setActive(['admin.orderitem.*'])}}"><a href="{{ route('orderitem') }}">Product Orders</a></li>
								</ul>
							</li>
							<li class="submenu {{ setActive(['users.*']) }}">
								<a href="#"><i class="la la-user"></i> <span> Users</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="{{ setActive(['user.listing']) }}"><a href="{{ route('user.listing') }}">Users Listing</a></li>
									<li class="{{ setActive(['deleted.userListing']) }}"><a href="{{ route('deleted.userListing') }}">Deleted Users</a></li>
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'events.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> Events</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['events.*'])}}"><a href="{{ route('adminEvents') }}">Events Listing</a></li>
									  <li class="{{ setActive(['add.events.*'])}}"><a href="{{ route('adminEventsAdd') }}">Add Event</a></li>
									  <li class="{{ setActive(['admin.event.enquiries.*'])}}"><a href="{{ route('admin.event.enquiries') }}">Events Enquiries</a></li>
									  <li class="{{ setActive(['admin.event.reports.*'])}}"><a href="{{ route('admin.event.reports') }}">Events Reports</a></li>
									  <li class="{{ setActive(['admin.event.tickets.*'])}}"><a href="{{ route('admin.event.tickets') }}">Events Tickets</a></li>
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'events.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> Events Ticket Category</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['events.*'])}}"><a href="{{ route('eventTicketCategory.index') }}">Category List</a></li>
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'donationa_packages.*'
								])}}">
							    <a href="#">
							        <i class="fa fa-credit-card"></i>
							        <span> Donation Packages</span>
							        <span class="menu-arrow"></span>
							    </a>
							    <ul style="display: none;">
							        <li class="{{ setActive(['adminDonationPackages']) }}">
							            <a href="{{ route('adminDonationPackages') }}">Donation Packages</a>
							        </li>
							        <li class="{{ setActive(['adminDonationPackagesListing']) }}">
							            <a href="{{ route('adminDonationPackagesListing') }}">Donation List</a>
							        </li>
							    </ul>
							</li>

							<li class="submenu {{ setActive([
								'business.*'
								])}} ">
								<a href="#"><i class="la la-briefcase"></i> <span> Business</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								    <li class="{{ setActive(['admin.business-request.*'])}}"><a href="{{ route('businessRequest') }}">User Business Request</a></li>
								    <li class="{{ setActive(['admin.business-request.*'])}}"><a href="{{ route('businessByAdmin') }}">Business By Admin</a></li>
									<li class="{{ setActive(['admin.business.enquiries.*'])}}"><a href="{{ route('admin.business.enquiries') }}">Business Enquiries</a></li>
									<li class="{{ setActive(['admin.business.products_enquiries.*'])}}"><a href="{{ route('admin.business.products_enquiries') }}">Business Products Enquiries</a></li>
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'admin.adPost.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> NGOs</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['ngoByAdmin.*'])}}"><a href="{{ route('ngoByAdmin') }}">NGO By Admin</a></li>
									  <li class="{{ setActive(['admin.ngo-request.*'])}}"><a href="{{ route('ngoRequest') }}">User NGO Request</a></li>
									  
								</ul>
							</li>

							<li class="submenu {{ setActive([
								'admin.skillList.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> Skill</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['skillList.*'])}}"><a href="{{ route('skillList') }}">Skill Listing</a></li>
									  
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'admin.jobsList.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> Jobs</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li class="{{ setActive(['jobsCategoryList.*'])}}"><a href="{{ route('jobsCategoryList') }}">Jobs Category</a></li>
								      <li class="{{ setActive(['jobsList.*'])}}"><a href="{{ route('jobsList') }}">Jobs Listing</a></li>
									  
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'admin.professionalsList.*'
								])}} ">
								<a href="#"><i class="las la-users"></i> <span> Professionals</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['professionalsList.*'])}}"><a href="{{ route('professionalsList') }}">Professional Listings</a></li>
									 
									  
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'admin.adPost.*'
								])}} ">
								<a href="#"><i class="la la-file-pdf-o"></i> <span> Fundraiser</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['adminFundraising.*'])}}"><a href="{{ route('adminFundraising') }}">Funding List</a></li>
								</ul>
							</li>
							
							<li class="submenu {{ setActive([
								'faqs.*'
								])}} ">
								<a href="#"><i class="la la-briefcase"></i> <span> FAQ's</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								    <li class="{{ setActive(['admin.faqList.*'])}}"><a href="{{ route('faqList') }}">FAQ's Listing</a></li>
									<li class="{{ setActive(['admin.faqCategory.*'])}}"><a href="{{ route('faqCategory') }}">FAQ's Category</a></li>
									<li class="{{ setActive(['admin.faqSubcategory.*'])}}"><a href="{{ route('faqSubcategory') }}">FAQ's Subcategory</a></li>
								    
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'blogs.*'
								])}} ">
								<a href="#"><i class="la la-briefcase"></i> <span> Blogs</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								    <li class="{{ setActive(['admin.blogs.*'])}}"><a href="{{ route('blogs.list') }}">Blogs Listing</a></li>
								    
								</ul>
							</li>
							<li class="submenu {{ setActive([
								'contact.*'
								])}} ">
								<a href="#"><i class="la la-phone"></i> <span> Contacts</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['contact.*'])}}"><a href="{{ route('contact') }}">Contact</a></li>
								</ul>
							</li>

							<li class="submenu {{ setActive([
								'adminMessage.*'
								])}} ">
								<a href="#"><i class="la la-bullhorn"></i> <span> Announcement</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['adminMessage.*'])}}"><a href="{{ route('adminAnnouncement') }}">Announcement</a></li>
								</ul>
							</li>

							<li class="submenu {{ setActive([
                                'newsletter.*'
                                 ])}} ">
                                <a href="#"><i class="la la-envelope"></i> <span> Newsletter</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                      <li class="{{ setActive(['newsletter.*']) }}"><a href="{{ route('admin.newsletters') }}">Manage Newsletter</a></li>
                                </ul>
                            </li>


							

							<li class="submenu {{ setActive([
								'review.*'
								])}} ">
								<a href="#"><i class="la la-phone"></i> <span> Reviews</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
								      <li class="{{ setActive(['review.*'])}}"><a href="{{ route('review') }}">Reviews</a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
			<div class="page-wrapper">

			<div class="content container-fluid">
			
				<!-- Page Header -->
			
				<div class="page-header page-header12">
						<div class="row align-items-center">
							<div class="col">
								<ul class="breadcrumb">
									@foreach($breadcrumbs as $breadcrumb)
										@if($breadcrumb['url'])
											<li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
										@else
											<li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
										@endif
									@endforeach
								
								</ul>
								
							</div>
							<!-- <div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday</a>
							</div> -->
						</div>
					</div>
			
                    {{-- @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
					<script>
						@if($errors->any())
							@foreach($errors->all() as $error)
								toastr.error("{{ $error }}");
							@endforeach
						@endif
					</script>
					

					
                    {{-- @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif --}}
				<!-- /Page Header -->
				