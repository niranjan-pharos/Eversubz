@extends('frontend.template.master')


@section('title', 'Jobs')
@section('description', 'Welcome to Eversubz')

@section('content')
@push('style')
<style>
    .main-section1 {
        background-color: #081721;
        background-size: cover;
        background-position: center;
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        position: relative;
    }

    .main-section1 .main-section-img-div {
        display: block;
        right: 0;
        position: absolute;
        top: 0;
        bottom: 0
    }

    .main-section1 .main-section-img-div img {
        border-bottom-left-radius: 50rem;
        border-top-left-radius: 50rem;
        width: 700px;
    }


    .breadcrumbs.light nav a {
        color: #ffffff;
        opacity: 0.75;
    }

    .breadcrumbs.light .breadcrumb-item.active {
        color: #ffffff;
        opacity: 1;
    }

    .breadcrumbs.light .breadcrumb-item {
        font-size: 13px;
    }

    .job-head-bodys-top .job-roots-y1 .primary-2-bg {
        background-color: #7bbd15 !important;
        padding: 4px 15px;
        color: #ffffff;
        font-weight: 500;
        border-radius: 4px;
        font-size: 75%;
    }

    .job-roots-y1-last .job-title-iop h2 {
        font-size: 2rem;
        line-height: 1.2;
    }

    .job-roots-y1-last .job-locat-oiu {
        font-size: 12px;
    }

    .job-roots-y1 .job-roots-y6 p {
        font-size: 14px;
    }

    .btn-save-job {
        background: #fff
    }

    .btn-save-job:hover {}

    .job-roots-y6 .btn {
        text-transform: capitalize;
    }

    .explot-job-info-details .single-explot-job-last span {
        opacity: .75 !important;
        font-size: 14px
    }

    .explot-job-info-details .single-explot-job-last p {
        font-size: 14px;
    }

    .main-section2 {
        background: #f1f5f8 !important;
        padding: 80px 0px 80px;
    }

    .job-blocs.style_03 {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        background: #ffffff;
        border-radius: 0.4rem;
        border: 2px solid #ebeff2;
    }

    .job-blocs.style_03 .job-blocs-body h5 {
        color: #000;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .job-blocs.style_03 .job-blocs-body h6 {
        color: #000;
        font-weight: 700;
    }

    .job-blocs.style_03 .job-blocs-body p {
        margin-bottom: 10px;
        color: #000;
        font-size: 14px;
    }

    ul.simple-list li,
    ul.colored-list li {
        list-style: none;
        position: relative;
        color: #000;
        font-size: 14px;

        padding: 0.2rem 0rem 0.2rem 1.4rem;
    }

    ul.simple-list li i,
    ul.colored-list li i {padding-right:7px;}

    .job-blox-footer ul {
        display: flex;
        column-gap: 5px;
        align-items: center;
    }

    .job-blox-footer ul button {
        width: 38px;
        height: 38px;
        font-size: 14px;
        line-height: 36px;
        text-align: center;
        margin: 0 10px;
        color: var(--gray);
        background: var(--chalk);
        border-radius: 50%;
        border: 1px solid var(--border);
        transition: .3s linear;
        -webkit-transition: .3s linear;
        -moz-transition: .3s linear;
        -ms-transition: .3s linear;
        -o-transition: .3s linear;
    }

    .job-blox-footer ul button:hover {
        color: var(--white);
        background: var(--primary);
        border-color: var(--primary);
        box-shadow: var(--primary-tshadow);
    }


    .detail-side-block {
        position: relative;
        display: flex;
        flex-direction: column;
        border-radius: 0.4rem;
        padding: 1rem;
    }

    .detail-side-block .detail-side-heads h3 {
        color: #000;
    }

    .detail-side-block .detail-side-heads p {
        font-size: 14px;
        margin: 0 0 10px;
        line-height: 1.8;
        color: #000
    }

    .detail-side-block .detail-side-middle .form-floating {
        position: relative;
    }

    .detail-side-block .detail-side-middle .form-floating label {
        position: absolute;
        left: 25px;
        top: 12px;
        font-size: 14px;
        color: #777;
        pointer-events: none;
        transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1), font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.3s ease;
    }


    .detail-side-block .detail-side-middle .form-floating input:focus+label,
    .detail-side-block .detail-side-middle .form-floating input:not(:placeholder-shown)+label {
        top: -20px;
        font-size: 12px;
        color: #2d6bb4;
        padding: 0 4px;
        border-radius: 4px;
        left: 17px;
        /* Optional background effect for smoother label visibility */
        background-color: #ffffff;
        box-shadow: 0px 0px 4px rgba(45, 107, 180, 0.2);
        transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            color 0.3s ease,
            box-shadow 0.3s ease;
    }
    .detail-side-middle .form-group{    margin-bottom: 10px;
    }
    .form-control {
        border-radius: 6px;
        width: 100%;
        background: var(--white);
        border: 1px solid #a0a0a0;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
    }

    .upload-btn-wrapper .product-widget-btn {
        border: none;
        padding: 8px 20px;
        border-radius: 0.3rem;
        font-size: 14px;
        height: 56px;
        font-weight: 500;
        width: 100%;
        cursor: pointer !important;
        text-transform: capitalize;
    }

    .upload-btn-wrapper input[type=file] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        height: 56px;
        cursor: pointer;
    }

    .form-group label {
        margin-bottom: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .form-group .btn.btn-inline {
        width: 100%
    }
    .side-job-info-blox {
        position: relative;
        display: flex
    ;
        flex-direction: column;
        border-radius: 0.4rem;
        padding: 1rem;
    }
    .side-job-info-header {
        display: flex
    ;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 2rem;
    }
    .side-job-info-thumbs figure img {
        width: 125px;
        height: 100%;
    }
    .side-job-info-thumbs figure {
        margin: 0;
    }

    .side-job-info-captionyo h5{       color: #000;
        font-weight: 700; font-size: 1.25rem;}
        .side-job-info-captionyo .sld-info-title .job-locat-oiu {
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 44, 63, 0.6);
    }
    .side-job-info-middle {
        position: relative;
        display: block;
        width: 100%;
    }
    .side-full-info-groups {
        position: relative;
        display: flex
    ;
        flex-wrap: wrap;
        width: 100%;
    }
    .side-full-info-groups .single-side-info {
        width: 50%;
        display: flex
    ;
        flex-direction: column;
        flex: 0 0 50%;
        margin-bottom: 1rem;
    }
    .side-full-info-groups .single-side-info .sld-subtitle {
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 44, 63, 0.6);
    }
    .side-full-info-groups .single-side-info .sld-title{    color: #000;
        font-weight: 700;    font-size: 1rem;}

    @media only screen and (max-width:767px) {
        .main-section2 {
            padding: 50px 0px 80px;
        }
    }
</style>
@endpush


<section class="main-section1">
    <div class="main-section-img-div position-absolute end-0 top-0 bottom-0 d-lg-block d-none">
        <img src="{{asset('storage/'.$job->image)}}" class="img-fluid rounded-start-pill h-100" alt="{{$job->title}}">
    </div>


    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-9 col-md-12">
                <div class="pr-4">
                    <div class="bread-wraps breadcrumbs light">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{'/'}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('jobs.list')}}">Jobs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Job Details</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="job-head-bodys-top mt-3 mb-2">
                        <div class="job-roots-y1 flex-column justify-content-start align-items-start">
                            <div class="job-roots-y1-last">
                                <div class="job-urt mb-2">
                                    @foreach($job->tags as $tag)
                                    <span class="label text-light primary-2-bg">{{ $tag->tag_name }}</span>
                                    @endforeach                                    
                                </div>
                                <div class="job-title-iop mb-1">
                                    <h2 class="m-0 fs-2 text-light">{{$job->title}}</h2>
                                </div>
                                <div class="job-locat-oiu text-sm-muted text-light d-flex align-items-center">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0C5.239 0 3 2.239 3 5c0 4.25 5 10.25 5 10.25S13 9.25 13 5c0-2.761-2.239-5-5-5zm0 14.562S4 9.104 4 5c0-2.209 1.791-4 4-4s4 1.791 4 4c0 4.104-4 9.562-4 9.562zM8 2C6.346 2 5 3.346 5 5s1.346 3 3 3 3-1.346 3-3S9.654 2 8 2zm0 5C7.346 7 7 6.654 7 6s.346-1 1-1 1 .346 1 1-.346 1-1 1z">
                                            </path>
                                        </svg>
                                        {{ $job->city }}</span>

                                </div>
                            </div>
                            <div class="job-roots-y6 py-3">
                                <p class="text-light">{{ Str::words(strip_tags($job->description), 60) }}</p>
                            </div>
                            <div class="job-roots-y6 py-3">
                                @auth
                                    @if($alreadyApplied === true)
                                        <button class="btn btn-secondary px-lg-5 px-4 me-3" disabled>Applied</button>
                                    @else
                                    <button class="btn btn-inline px-lg-5 px-4 me-3" type="button" data-toggle="modal" data-target="#applyJobModal">Apply Job</button>
                                    @endif
                                @else
                                    <!-- If the user is not authenticated, show the login prompt -->
                                    <a href="{{ route('user.login') }}" class="btn btn-inline px-lg-5 px-4 me-3">Login to Apply</a>
                                @endauth
                            </div>
                        
                            <!-- Show success or error messages -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                        </div>
                    </div>

                    <div class="explot-job-info-details d-inline-flex flex-wrap">
                        <div class="single-explot d-flex align-items-center me-md-5 mr-4 my-2">
                            <div class="single-explot-job-first">
                                <i class="fas fa-briefcase" style="font-size: 2.5rem!important;color: #ffffff;"></i>
                            </div>
                            <div class="single-explot-job-last px-2">
                                <span class="text-light opacity-75">Department</span>
                                <p class="text-light fw-bold fs-6 m-0">{{$job->category->name}}</p>
                            </div>
                        </div>
                        <div class="single-explot d-flex align-items-center me-md-5 mr-4 my-2">
                            <div class="single-explot-job-first">
                                <i class='fas fa-map-marker-alt'
                                    style="font-size: 2.5rem!important;color: #ffffff;"></i>
                            </div>
                            <div class="single-explot-job-last px-2">
                                <span class="text-light opacity-75">Location</span>
                                <p class="text-light fw-bold fs-6 m-0">{{ $job->city.", ".$job->state.", ".$job->country }}</p>
                            </div>
                        </div>
                        <div class="single-explot d-flex align-items-center">
                            <div class="single-explot-job-first">
                                <i class='fas fa-dollar-sign' style="font-size: 2.5rem!important;color: #ffffff;"></i>
                            </div>
                            <div class="single-explot-job-last px-2">
                                <span class="text-light opacity-75">Salary</span>
                                <p class="text-light fw-bold fs-6 m-0">
                                    @if ($job->salary) 
                                        ${{ number_format($job->salary, 2) }} / 
                                        {{ $job->payment_type }}
                                    @else
                                        Not specified
                                    @endif
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="main-section2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mb-4">

                <div class="job-blocs style_03 b-0 mb-md-4 mb-sm-4">
                    <div class="job-blocs-body px-4 py-4">
                        <div class="job-content mb-4">
                            <h5>Job Description</h5>
                            <p>{!! $job->description !!}</p>
                        </div>
                        <div class="job-content-body mb-4">
                            <h5 class="mb-3">Job Requirements</h5>
                            <div class="job-content mb-3">
                                {!! $job->requirements !!}
                            </div>

                        </div>

                        <div class="job-blox-footer">
                            <div class="blox-first-footer">
                                <div class="ftr-share-block">
                                    <ul>
                                        <li><strong>Share This Job:</strong></li>
                                        <button id="shareBtn"> <i class="fas fa-share-alt"></i> </button>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="col-lg-4 col-md-12">
                <div class="detail-side-block bg-white mb-4">
                    <div class="detail-side-heads mb-2">
                        <h3>Ready To Apply?</h3>
                        <p>Complete the eligibilities checklist now and get started with your online application</p>
                    </div>
                    <div class="detail-side-middle">
                        <form id="guestJobApplicationForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jobId" value="{{ encrypt($job->id) }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                                <label for="name">Name:</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="" required>
                                <label for="email">Email:</label>
                            </div>
                            
                            <div class="form-group mb-3">
                                <div class="upload-btn-wrapper full-width">
                                    <button type="button" class="product-widget-btn">Upload Resume</button>
                                    <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-inline" id="submitApplication">Submit Application</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
                

                <div class="side-job-info-blox bg-white mb-4">
                    <div class="side-job-info-header">
                        <div class="side-job-info-thumbs">
                            <figure><img src="{{ asset('storage/'.$job->image) }}" class="img-fluid img-thumbnail" alt="{{$job->company_name}}">
                            </figure>
                        </div>
                        <div class="side-job-info-captionyo px-3">
                            <div class="sld-info-title">
                                <h5 class="rtls-title mb-1">EverSabz Australia</h5>
                                <div class="job-locat-oiu text-sm-muted">
                                    <span class="me-1"><i class='fas fa-location-arrow pr-2'></i>Noble Park
                                        Victoria</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="side-job-info-middle">
                        <div class="side-full-info-groups">
                            <div class="single-side-info">
                                <span class="text-sm-muted sld-subtitle">Company Founder:</span>
                                <h6 class="sld-title">
                                   Mr. Ali
                                </h6>
                                
                            </div>
                            <div class="single-side-info">
                                <span class="text-sm-muted sld-subtitle">Industry:</span>
                                <h6 class="sld-title">Technology</h6>
                            </div>
                            <div class="single-side-info">
                                <span class="text-sm-muted sld-subtitle">Founded:</span>
                                <h6 class="sld-title">2016</h6>
                            </div>
                            <div class="single-side-info">
                                <span class="text-sm-muted sld-subtitle">Head Office:</span>
                                <h6 class="sld-title">Melbourne, Australia</h6>
                            </div>
                            
                            <div class="single-side-info">
                                <span class="text-sm-muted sld-subtitle">Company Size:</span>
                                <h6 class="sld-title">Medium</h6>
                            </div>
                          
                            {{-- <div class="single-side-info">
                                <span class="text-sm-muted sld-subtitle">Openings</span>
                                <h6 class="sld-title">06 Openings</h6>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="side-rtl-job-block d-none">
                    <div class="side-rtl-job-head">
                        <h5 class="side-job-titles">Related Jobs</h5>
                    </div>
                    <div class="side-rtl-job-body">
                        <div class="side-rtl-job-groups">

                            <div class="single-side-rtl-job">
                                <div class="single-fliox">
                                    <div class="single-rtl-job-thumb">
                                        <a href="job-detail.html">
                                            <figure><img src="assets/img/l-1.png" class="img-fluid" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="single-rtl-job-caption">
                                        <div class="hjs-rtls-titles">
                                            <div class="job-types mb-1"><span
                                                    class="label text-success bg-light-success">Full Time</span></div>
                                            <h5 class="rtls-title"><a href="joob-detail.html">Software Engineer</a>
                                            </h5>
                                            <div class="job-locat-oiu text-sm-muted">
                                                <span><i class="fa-solid fa-location-dot me-1"></i>California,
                                                    USA</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-rtl-job-hot">
                                    <div class="single-tag-rtls"><span class="label text-warning bg-light-warning"><i
                                                class="fa-brands fa-hotjar me-1"></i>New</span></div>
                                    <div class="single-tag-rtls"><span class="label text-success bg-light-success"><i
                                                class="fa-solid fa-star me-1"></i>Featured</span></div>
                                </div>
                            </div>

                            <div class="single-side-rtl-job">
                                <div class="single-fliox">
                                    <div class="single-rtl-job-thumb">
                                        <a href="job-detail.html">
                                            <figure><img src="assets/img/l-2.png" class="img-fluid" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="single-rtl-job-caption">
                                        <div class="hjs-rtls-titles">
                                            <div class="job-types mb-1"><span
                                                    class="label text-success bg-light-success">Full Time</span></div>
                                            <h5 class="rtls-title"><a href="joob-detail.html">Jr. PHP Developer</a></h5>
                                            <div class="job-locat-oiu text-sm-muted">
                                                <span><i class="fa-solid fa-location-dot me-1"></i>Canada, USA</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-rtl-job-hot">
                                    <div class="single-tag-rtls"><span class="label text-success bg-light-success"><i
                                                class="fa-solid fa-star me-1"></i>Featured</span></div>
                                </div>
                            </div>

                            <div class="single-side-rtl-job">
                                <div class="single-fliox">
                                    <div class="single-rtl-job-thumb">
                                        <a href="job-detail.html">
                                            <figure><img src="assets/img/l-3.png" class="img-fluid" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="single-rtl-job-caption">
                                        <div class="hjs-rtls-titles">
                                            <div class="job-types mb-1"><span
                                                    class="label text-danger bg-light-danger">Internship</span></div>
                                            <h5 class="rtls-title"><a href="joob-detail.html">Project Manager For
                                                    PHP</a></h5>
                                            <div class="job-locat-oiu text-sm-muted">
                                                <span><i class="fa-solid fa-location-dot me-1"></i>Liverpool, UK</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-rtl-job-hot">
                                    <div class="single-tag-rtls"><span class="label text-warning bg-light-warning"><i
                                                class="fa-brands fa-hotjar me-1"></i>New</span></div>
                                    <div class="single-tag-rtls"><span class="label text-success bg-light-success"><i
                                                class="fa-solid fa-star me-1"></i>Featured</span></div>
                                </div>
                            </div>

                            <div class="single-side-rtl-job">
                                <div class="single-fliox">
                                    <div class="single-rtl-job-thumb">
                                        <a href="job-detail.html">
                                            <figure><img src="assets/img/l-5.png" class="img-fluid" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="single-rtl-job-caption">
                                        <div class="hjs-rtls-titles">
                                            <div class="job-types mb-1"><span
                                                    class="label text-warning bg-light-warning">Full Time</span></div>
                                            <h5 class="rtls-title"><a href="joob-detail.html">Sr. Magento Developer
                                                    2.0</a></h5>
                                            <div class="job-locat-oiu text-sm-muted">
                                                <span><i class="fa-solid fa-location-dot me-1"></i>California,
                                                    USA</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-rtl-job-hot">
                                    <div class="single-tag-rtls"><span class="label text-success bg-light-success"><i
                                                class="fa-solid fa-star me-1"></i>Featured</span></div>
                                </div>
                            </div>

                            <div class="single-side-rtl-job">
                                <div class="single-fliox">
                                    <div class="single-rtl-job-thumb">
                                        <a href="job-detail.html">
                                            <figure><img src="assets/img/l-6.png" class="img-fluid" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="single-rtl-job-caption">
                                        <div class="hjs-rtls-titles">
                                            <div class="job-types mb-1"><span
                                                    class="label text-danger bg-light-danger">Internship</span></div>
                                            <h5 class="rtls-title"><a href="joob-detail.html">Shopify Developer
                                                    Fresher</a></h5>
                                            <div class="job-locat-oiu text-sm-muted">
                                                <span><i class="fa-solid fa-location-dot me-1"></i>New York, USA</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-rtl-job-hot">
                                    <div class="single-tag-rtls"><span class="label text-warning bg-light-warning"><i
                                                class="fa-brands fa-hotjar me-1"></i>New</span></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        @auth 
            <div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="applyJobModalLabel">Apply for {{ $job->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="applyJobForm">
                                @csrf  
                                <input type="hidden" name="jobId" value="{{ encrypt($job->id) }}">

                                <div class="mb-3">
                                    <label for="cover_letter" class="form-label">Cover Letter</label>
                                    <textarea class="form-control" name="cover_letter" id="cover_letter" rows="5" placeholder="Write your cover letter here..." required></textarea>
                                    <small class="text-danger d-none" id="coverLetterError"></small>
                                </div>

                                <button type="button" class="btn btn-primary w-100" id="applyJobBtn">Submit Application</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Job Application Button -->
            <div class="job-roots-y6 py-3">
                @if($alreadyApplied === true) 
                    <button class="btn btn-secondary px-lg-5 px-4 me-3" disabled>Applied</button>
                @else
                    <button class="btn btn-primary px-lg-5 px-4 me-3" type="button" data-bs-toggle="modal" data-bs-target="#applyJobModal" id="applyJobTrigger">Apply Job</button>
                @endif

            </div>
        @else
            <div class="job-roots-y6 py-3">
                <a href="{{ route('user.login', ['redirect' => request()->fullUrl()]) }}" class="btn btn-inline px-lg-5 px-4 me-3">Login to Apply</a>
            </div>
        @endauth


        

    </div>
</section>

@push('scripts')
<script>
document.querySelector('#shareBtn').addEventListener('click', event => {
    if (navigator.share) {
        navigator.share({
            title: '',
            url: '{{ generateCanonicalUrl() }}'
        }).then(() => {
            console.log('Thanks for sharing!')
        }).catch(err => {
            console.log("Error while using Web share API:");
            console.log(err)
        })
    } else {
        alert("Browser doesn't support this API !")
    }
})
</script>
<script>
    $(document).ready(function() {
        $('#applyJobBtn').on('click', function(e) {
            e.preventDefault(); 

            let formData = new FormData($('#applyJobForm')[0]); 
            let url = "{{ route('apply.job', $job->id) }}";
            $('#applyJobBtn').attr('disabled', true).text('Submitting...');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    
                    $('#applyJobBtn').attr('disabled', false).text('Submit Application');

                    if (response.success) {
                        toastr.success(response.message); 
                        $('#applyJobModal').modal('hide');
                        $('#applyJobForm')[0].reset();

                        $('#applyJobTrigger').replaceWith('<button class="btn btn-secondary px-lg-5 px-4 me-3" disabled>Applied</button>');
                    }
                },
                error: function(xhr) {
                    $('#applyJobBtn').attr('disabled', false).text('Submit Application');
                    
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.cover_letter) {
                            $('#coverLetterError').text(errors.cover_letter[0]).removeClass('d-none');
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('Something went wrong. Please try again.');
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#guestJobApplicationForm').on('submit', function (e) {
            e.preventDefault();
            
            let formData = new FormData(this); 

            $.ajax({
                url: "{{ route('guest.job.apply') }}", 
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#submitApplication').attr('disabled', true).text('Submitting...');
                },
                success: function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#guestJobApplicationForm')[0].reset();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) { 
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            toastr.error(errors[field][0]); 
                        }
                    } else {
                        toastr.error('Something went wrong. Please try again.');
                    }
                },
                complete: function () {
                    $('#submitApplication').attr('disabled', false).text('Submit Application');
                }
            });
        });
    });


</script>


@endpush

@endsection