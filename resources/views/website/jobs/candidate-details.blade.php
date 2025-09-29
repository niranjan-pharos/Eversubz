@extends('frontend.template.master')


@section('title', 'Jobs')
@section('description', 'Welcome to Eversubz')

@section('content')
@push('style')
    <style>
        .gray-simple {
            background: #f1f5f8 !important;
            padding: 80px 0 80px;
        }

        .cndt-head-block {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cndt-head-left {
            position: relative;
            display: flex;
            flex: 1;
            align-items: center;
            justify-content: flex-start;
        }

        .cndt-head-thumb {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .cndt-head-thumb figure {
            margin: 0;
        }

        .circle {
            border-radius: 100%;
        }

        .cndt-head-caption {
            position: relative;
            padding-left: 1rem;
        }

        .cndt-yior-1 {
            position: relative;
            margin-bottom: 5px;
        }

        .cndt-yior-1 .label {
            padding: 4px 15px;
            color: #009868 !important;
            font-weight: 500;
            border-radius: 4px;
            font-size: 75%;
            background-color: rgba(0, 152, 104, 0.1) !important;
        }

        .cndt-yior-2 {

            margin-bottom: 5px;
        }

        .cndt-yior-2 .cndt-title {
            margin: 0;
            font-size: 1.5rem;
        }

        .cndt-yior-3 {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .cndt-yior-3 span {
            font-weight: 500;
            font-size: 13px;
            margin-right: 1.2rem;
        }

        .cndt-head-caption-bottom {
            position: relative;
            display: block;
            margin-top: 1rem;
        }

        .cndt-yior-skills {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .cndt-yior-skills span {
            height: 24px;
            width: auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1px 15px;
            background: #dce2e7;
            border-radius: 0.2rem;
            margin: 4px 10px;
            margin-left: 0;
            font-weight: 400;
            font-size: 13px;
        }

        .gray-simple .btn-outline-primary {
            background: #ffffff;
            border-color: #0044bb;
            color: #0044bb;
        }

        .btn {
            padding: 10px 20px;
            height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            -webkit-transition: all ease 0.4s;
            -o-transition: all ease 0.4s;
            transition: all ease 0.4s;
            border-radius: 0.4rem;
        }

        section {
            padding: 80px 0 80px;
        }

        .cdtsr-groups-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            position: relative;
            width: 100%;
        }

        .single-cdtsr-block {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            border: 1px dashed #e4e9ec;
            border-radius: 0.6rem;
            margin-bottom: 1.5rem;
        }

        .single-cdtsr-block .single-cdtsr-header {
            padding: 1rem 1rem 0.8rem;
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .single-cdtsr-block .single-cdtsr-header h5 {
            margin: 0;
            font-size: 1.25rem;
        }

        .single-cdtsr-body {
            position: relative;
            width: 100%;
            display: block;
            padding: 0 1rem 1rem;
        }

        .cdtx-infr-box {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .cdtx-infr-icon {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            font-size: 22px;
            color: #96aab7;
            background: #f4f5f7;
            border-radius: 0.3rem;
        }

        .cdtx-infr-captions {
            position: relative;
            padding-left: 15px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .cdtx-infr-captions h5 {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
            line-height: 1.2;
        }

        .cdtx-infr-captions p {
            font-size: 12px;
            font-weight: 500;
            margin: 0;
            color: rgba(0, 44, 63, 0.6);
        }

        .col-xl-6.col-lg-6.col-md-6 {
            margin-top: 25px;
        }

        .resumes-groups-blox {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .single-resumes-blocks {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .single-resumes-left {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .single-resumes-icons {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #96aab7;
            background: #f4f5f7;
            border-radius: 0.3rem;
            font-size: 22px;
        }

        .single-resumes-captions {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-left: 10px;
        }

        .single-resumes-captions h5 {
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
        }

        .single-resumes-captions h5 span {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: rgba(0, 44, 63, 0.6);
        }

        .btn-light-success {
            border-color: rgba(0, 68, 187, 0.2);
            background: rgb(0 68 187 / 15%);
            color: #0044bb;

        }

        .experinc-usr-groups {
            position: relative;
            width: 100%;
        }

        .single-experinc-block {
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            margin-bottom: 0;
            padding: 1rem 0;
            border-bottom: 1px solid #e4e9ec;
        }

        .single-experinc-lft .experinc-thumbs {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-fluid {
            max-width: 100%;

            height: auto;
        }

        .single-experinc-rght {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            padding-left: 15px;
        }

        .experinc-emp-title {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 5px;
        }

        .experinc-emp-title h5 {
            position: relative;
            margin-right: 10px;
            margin-bottom: 0;
            font-weight: 700;
        }

        .experinc-emp-title .label {
            padding: 4px 15px;
            color: #009868;
            font-weight: 500;
            border-radius: 4px;
            font-size: 75%;
            background-color: rgba(0, 152, 104, 0.1) !important;
        }

        .experinc-post-title {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 5px;
        }

        .experinc-post-title h6 {
            margin: 0;
            font-weight: 600;
            font-size: 13px;
        }

        .experinc-infos-list span {
            position: relative;
            font-size: 12px;
            font-weight: 500;
            color: rgba(0, 44, 63, 0.6);
            margin: 0 0.4rem;
        }

        .single-educations-block {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid #e4e9ec;
        }

        .single-educations-lft .educations-thumbs {
            width: 60px;
            height: 60px;
        }

        .single-educations-rght {

            padding-left: 15px;
        }

        .educations-emp-title,
        .educations-post-title {
            margin-bottom: 2px;
        }

        .educations-emp-title h5 {
            margin-bottom: 0;
        }

        .educations-post-title h6 {
            margin: 0;
            font-weight: 600;
            font-size: 13px;
        }

        .educations-infos-list span {
            font-size: 12px;
            font-weight: 500;
            color: rgba(0, 44, 63, 0.6);
            margin: 0 0.8rem 0 0;
        }

        .cndts-all-skills-list {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        .cndts-all-skills-list span {
            /* position: relative; */
            height: 26px;
            width: auto;
            padding: 2px 0.8rem;
            background: #0248c340;
            color: var(--primary);
            border-radius: 0.2rem;
            margin: 4px 10px 4px 0px;
            display: inline-flex
        ;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
        }
        .cndts-lgs-blocks {
            position: relative;
            display: flex
        ;
            align-items: center;
            border: 1px solid var(--primary);
            padding: 1rem;
            border-radius: 0.4rem;
        }.cndts-lgs-ico {
            width: 45px;
            height: 45px;
            display: flex
        ;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgb(0 68 187 / 15%);
            box-shadow: 0 0 0 4px rgb(0 68 187 / 25%);
            color: #0044bb;
        }.cndts-lgs-ico h6 {
            margin: 0;
            color: #0044bb;
        }.cndts-lgs-captions {
        
            padding-left: 10px;
        }.cndts-lgs-captions h5 {
            margin: 0;
            font-size: 14px;
            line-height: 1;
        }.cndts-lgs-captions p {
            font-weight: 500;
            margin-bottom: 0;
            color: rgba(0, 44, 63, 0.7);
            font-size: 12px;
        }
        .sidefr-usr-block {
            background: #f2f6f9;
            border-radius: 0.6rem;
        }.sidefr-usr-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #dfe4e9;
        }.sidefr-usr-header .sidefr-usr-title {
            margin: 0;
            font-size: 18px;
        }.sidefr-usr-body {
            padding: 1.5rem;
        }.form-group {
            margin-bottom: 15px;position:relative;
        }.form-control {
            height: 56px;
            font-size: 14px;
            box-shadow: none;
            border: 1px solid #e7edf1;
            background-clip: initial;

            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            background-color: #fff;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .375rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .form-group .btn.btn-inline {
            width: 100%;
        }


        .sidefr-usr-body label {
            position: absolute;
            left: 25px;
            top: 12px;
            font-size: 14px;
            color: #777;
            pointer-events: none;
            transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1), font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.3s ease;
        }
        .sidefr-usr-body input:focus+label, .sidefr-usr-body input:not(:placeholder-shown)+label, .sidefr-usr-body textarea:focus+label, .sidefr-usr-body textarea:not(:placeholder-shown)+label {
            top: -20px;
            font-size: 12px;
            color: #2d6bb4;
            padding: 0 4px;
            border-radius: 4px;
            left: 17px;
            background-color: #ffffff;
            box-shadow: 0px 0px 4px rgba(45, 107, 180, 0.2);
            transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1), font-size 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.3s ease, box-shadow 0.3s ease;
        }
        .cndts-share-block {
            position: relative;
            display: flex
        ;
            align-items: center;
            padding: 1rem 1.5rem;
        }.cndts-share-title h5 {
            font-size: 15px;
            margin: 0;
        }
        .cndts-share-list ul button {
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
        .cndts-share-list ul button:hover {
            color: var(--white);
            background: var(--primary);
            border-color: var(--primary);
            box-shadow: var(--primary-tshadow);
        }

        @media only screen and (max-width: 767px) {
            .cndt-head-block {
                display: flex
        ;
                flex-direction: column;
                align-items: flex-start;
            }
            .cndt-head-left {
                flex-direction: column;
                align-items: flex-start;
            }.cndt-head-thumb {
                margin-bottom: 1rem;
            }    .cndt-head-caption {
                padding: 0;
                margin-bottom: 1rem;
            }.cndt-head-block .cndt-yior-3, .emplr-head-caption .emplr-yior-3 {
                flex-wrap: wrap;
                justify-content: center;
            }.cndt-yior-3 span, .emplr-yior-3 span {
                flex: 0 0 50%;
                width: 50%;
                margin: 0.5rem 0;
                align-items: center;
                display: flex
        ;column-gap:4px;
            }
        }
    </style>
@endpush
<section class="gray-simple">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cndt-head-block">

                    <div class="cndt-head-left">
                        <div class="cndt-head-thumb">
                            <figure><a
                                    href="https://eversabz.com/storage/profile_images/hzsZE6QBsd6NyJgclwFy3IpfwjaAgbpRXNLXo8Rm.jpg"><img
                                        src="https://eversabz.com/storage/profile_images/hzsZE6QBsd6NyJgclwFy3IpfwjaAgbpRXNLXo8Rm.jpg"
                                        class="img-fluid circle" alt=""></a></figure>
                        </div>
                        <div class="cndt-head-caption">
                            <div class="cndt-head-caption-top">
                                <div class="cndt-yior-1"><span
                                        class="label text-sm-muted text-success bg-light-success">Featured</span></div>
                                <div class="cndt-yior-2">
                                    <h4 class="cndt-title">Vishal Jagadale</h4>
                                </div>
                                <div class="cndt-yior-3">
                                    <span><i class='fas fa-user-graduate'></i> Developer</span>
                                    <span><i class='fas fa-map-marker-alt'></i> Pune, India</span>
                                    <span><i class="fas fa-dollar-sign"></i> 25000/PA</span>
                                    <span><i class='fas fa-birthday-cake'></i> 02 Dec 1994</span>
                                </div>
                            </div>
                            <div class="cndt-head-caption-bottom">
                                <div class="cndt-yior-skills">
                                    <span>Design</span>
                                    <span>Python</span>
                                    <span>Java</span>
                                    <span>PHP</span>
                                    <span>WordPress</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cndt-head-right">
                        <button type="button" class="btn btn-inline">Download CV &nbsp; <i
                                class='fas fa-download'></i></button>
                        <button type="button" class="btn btn-outline-primary mx-2"><i
                                class='far fa-bookmark'></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <!-- row Start -->
        <div class="row">

            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="cdtsr-groups-block">

                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>About Candidate</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <p>
                            </p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>

                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>All Information</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="row align-items-center justify-content-between gy-4">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class='fas fa-envelope-open-text'></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>vishal.pharos@gmail.com</h5>
                                            <p>Mail Address</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-phone-volume"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>8237293399</h5>
                                            <p>Phone No.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-user"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>Male</h5>
                                            <p>Gender</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-birthday-cake"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>02 Dec 1994</h5>
                                            <p>Birthdate</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-wallet"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>$1000/month</h5>
                                            <p>Offerd Sallary</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-briefcase"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>5 Years</h5>
                                            <p>Experience</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-user-graduate"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>Master Degree</h5>
                                            <p>Qualification</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-layer-group"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>Fulltime, Remote, Freelance</h5>
                                            <p>Work Type</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-cdtsr-block d-none">
                        <div class="single-cdtsr-header">
                            <h5>Resumes</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="resumes-groups-blox">

                                <div class="single-resumes-blocks">
                                    <div class="single-resumes-left">
                                        <div class="single-resumes-icons"><i class="fas fa-file-word"></i></div>
                                        <div class="single-resumes-captions">
                                            <h5>Daniel-Resume.doc-2022<span>1 Year ago</span></h5>
                                        </div>
                                    </div>
                                    <div class="single-resumes-right">
                                        <button type="button" class="btn btn-md btn-light-success">Download<i
                                                class="fas fa-circle-down ms-1"></i></button>
                                    </div>
                                </div>

                                <div class="single-resumes-blocks">
                                    <div class="single-resumes-left">
                                        <div class="single-resumes-icons"><i class="fas fa-file-word"></i></div>
                                        <div class="single-resumes-captions">
                                            <h5>Daniel-Resume.doc-2023<span>10 Days ago</span></h5>
                                        </div>
                                    </div>
                                    <div class="single-resumes-right">
                                        <button type="button" class="btn btn-md btn-light-success">Download<i
                                                class="fas fa-circle-down ms-1"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>All Experience</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="experinc-usr-groups">

                                <div class="single-experinc-block">
                                    <div class="single-experinc-lft">
                                        <div class="experinc-thumbs">
                                            <figure><img src="https://eversabz.com/assets/images/logo.png"
                                                    class="img-fluid" alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="single-experinc-rght">
                                        <div class="experinc-emp-title">
                                            <h5>Linked In</h5><span class="label text-success bg-light-success">Full
                                                Time</span>
                                        </div>
                                        <div class="experinc-post-title">
                                            <h6>Sr. Web Designer</h6>
                                            <div class="experinc-infos-list"><span class="exp-start">5 Years 1
                                                    Month</span><span class="work-exp-date">May 2010 - Jun 2015</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-experinc-block">
                                    <div class="single-experinc-lft">
                                        <div class="experinc-thumbs">
                                            <figure><img
                                                    src="https://eversabz.com/storage/profile_images/dwGfLIwIzwMe8j2F285BBaQObrCXmW3pakUM0M5H.png"
                                                    class="img-fluid" alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="single-experinc-rght">
                                        <div class="experinc-emp-title">
                                            <h5>Pharoscion Global</h5><span
                                                class="label text-warning bg-light-warning">Part
                                                Time</span>
                                        </div>
                                        <div class="experinc-post-title">
                                            <h6>Sr. Web Designer</h6>
                                            <div class="experinc-infos-list"><span class="exp-start">2 Years 3
                                                    Month</span><span class="work-exp-date">Aug 2015 - Jan 2017</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>Educations</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="educations-usr-groups">

                                <div class="single-educations-block">
                                    <div class="single-educations-lft">
                                        <div class="educations-thumbs">
                                            <figure><img
                                                    src="https://upload.wikimedia.org/wikipedia/en/thumb/0/07/Shivaji_Univesity_Logo.jpeg/220px-Shivaji_Univesity_Logo.jpeg"
                                                    class="img-fluid" alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="single-educations-rght">
                                        <div class="educations-emp-title">
                                            <h5>Shivaji University Kolhapur</h5>
                                        </div>
                                        <div class="educations-post-title">
                                            <h6>Bachlor Degree in Computer Science</h6>
                                        </div>
                                        <div class="educations-infos-list"><span class="exp-start">Jun 2018</span><span
                                                class="work-exp-date">Karad, Maharshtra</span></div>
                                    </div>
                                </div>

                                <div class="single-educations-block">
                                    <div class="single-educations-lft">
                                        <div class="educations-thumbs">
                                            <figure><img
                                                    src="https://upload.wikimedia.org/wikipedia/en/thumb/0/07/Shivaji_Univesity_Logo.jpeg/220px-Shivaji_Univesity_Logo.jpeg"
                                                    class="img-fluid" alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="single-educations-rght">
                                        <div class="educations-emp-title">
                                            <h5>Shivaji University Kolhapur</h5>
                                        </div>
                                        <div class="educations-post-title">
                                            <h6>Masters Degree in Computer Science</h6>
                                        </div>
                                        <div class="educations-infos-list"><span class="exp-start">Jun 2020</span><span
                                                class="work-exp-date">Karad, Maharshtra</span></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>Candidate Skills</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="cndts-all-skills-list">
                                <span>Java</span>
                                <span>Python</span>
                                <span>Bootstrap</span>
                                <span>HTML5</span>
                                <span>UI/UX</span>
                                <span>Laravel</span>
                                <span>WordPress</span>
                            </div>
                        </div>
                    </div>

                    <div class="single-cdtsr-block d-none">
                        <div class="single-cdtsr-header">
                            <h5>Portfolio</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="row gx-3 gy-3">

                                <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                    <div class="cndts-prt-block">
                                        <div class="cndts-prt-thumb">
                                            <img src="assets/img/blog-1.jpg" class="img-fluid rounded" alt="">
                                        </div>
                                        <div class="cndts-prt-link"><a href="JavaScript:Void(0);"><i
                                                    class="fas fa-arrow-up-right-from-square"></i></a></div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                    <div class="cndts-prt-block">
                                        <div class="cndts-prt-thumb">
                                            <img src="assets/img/blog-2.jpg" class="img-fluid rounded" alt="">
                                        </div>
                                        <div class="cndts-prt-link"><a href="JavaScript:Void(0);"><i
                                                    class="fas fa-arrow-up-right-from-square"></i></a></div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                    <div class="cndts-prt-block">
                                        <div class="cndts-prt-thumb">
                                            <img src="assets/img/blog-3.jpg" class="img-fluid rounded" alt="">
                                        </div>
                                        <div class="cndts-prt-link"><a href="JavaScript:Void(0);"><i
                                                    class="fas fa-arrow-up-right-from-square"></i></a></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>Language</h5>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="row gy-4">

                                <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                    <div class="cndts-lgs-blocks">
                                        <div class="cndts-lgs-ico">
                                            <h6>MR</h6>
                                        </div>
                                        <div class="cndts-lgs-captions">
                                            <h5>Marathi</h5>
                                            <p>Advance</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                    <div class="cndts-lgs-blocks">
                                        <div class="cndts-lgs-ico">
                                            <h6>EN</h6>
                                        </div>
                                        <div class="cndts-lgs-captions">
                                            <h5>English</h5>
                                            <p>Medium</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                    <div class="cndts-lgs-blocks">
                                        <div class="cndts-lgs-ico">
                                            <h6>HR</h6>
                                        </div>
                                        <div class="cndts-lgs-captions">
                                            <h5>Hindi</h5>
                                            <p>Basic</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="sidefr-usr-block mb-4">
                    <div class="sidefr-usr-header">
                        <h4 class="sidefr-usr-title">Contact Vishal Jagadale</h4>
                    </div>
                    <div class="sidefr-usr-body">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="">
                                <label>Name:</label>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="">
                                <label>Email:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="">
                                <label>Phone:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="">
                                <label>Subject:</label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder=""></textarea>
                                <label>Message:</label>
                            </div>
                            <div class="form-group m-0">
                                <button type="button" class="btn btn-inline">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="sidefr-usr-block">
                    <div class="cndts-share-block">
                        <div class="cndts-share-title">
                            <h5>Share Profile</h5>
                        </div>
                        <div class="cndts-share-list">
                            <ul>
                                <li>                                        <button id="shareBtn"> <i class="fas fa-share-alt"></i> </button>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /row -->
    </div>
</section>



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















@endsection