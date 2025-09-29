@extends('frontend.template.master')

@section('title', 'Candidate Details')
@section('description', 'Welcome to Eversubz')

@section('content')
@push('style')
<style>
        .gray-simple {
            background: linear-gradient(135deg, #2c54a4, #28a745);
            padding: 60px 0 80px;
        }
        .loading-spinner {
            animation: spin 1s linear infinite;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            width: 1em;
            height: 1em;
            display: inline-block;
        }
        .sidefr-usr-block {
            padding: 30px;
            background: #f2f6f9;
            border-radius: 0.6rem;
        }
        .send-message{
                border-radius: 50px !important;
            font-size: 12px !important;
            padding: 6px 20px !important;
            height: 41px !important;
        }
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
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
            padding-left: 3rem;
        }

        .cndt-yior-1 {
            position: relative;
            margin-bottom: 10px;
        }

        .cndt-yior-1 .label {
          padding: 4px 15px;
        color: #fff !important;
        font-weight: 500;
        border: none;
        border-radius: 50px;
        font-size: 12px;
        background-color: orange;
        margin-bottom: 20px !important;
        }

        .cndt-yior-2 {

            margin-bottom: 5px;
        }

        .cndt-yior-2 .cndt-title {
               margin: 0;
        font-size: 24px;
        color: white;
        margin-top: 15px;
        }

        .cndt-yior-3 {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
                margin-top: 10px;
        }

        .cndt-yior-3 span {
            font-weight: 500;
            font-size: 13px;
            margin-right: 1.2rem;
            color:white;
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
            color:white;
        }

        .cndt-yior-skills span {
     color: white;
    border: 1px solid #eeeeeebf;
    height: 24px;
    width: auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 1px 15px;
    background: #0044bb;
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

    .alert-warning {
        color: #856404;
        background-color: white;
        border-color: #ffeeba;
        padding: 2px 10px !important;
        border-radius: 4px !important;
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
        background: #f2f6f9;
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
    width: 100%;
    display: block;
    align-items: flex-start;
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
    width: 45px;
    height: 45px;
    font-size: 22px;
    color: #0043b9b5;
    margin-bottom: 11px;
    background: #fff;
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
            padding: 0 0 1rem 0;
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
                box-shadow: 0 11px 85px 0 rgb(0 0 0 / .1), 0 1px 2px 19px rgb(0 0 0 / .1);
        }
        hr {
    margin-top: 1rem;
    margin-bottom: 2px;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, .1);
    }

        .single-experinc-rght {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            padding-left: 0px;
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
            background: white;
            color: #0000009e;
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
            background:white;
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
                margin-bottom: 2rem;
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
@php
    use Illuminate\Support\Str;
@endphp
<section class="gray-simple">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cndt-head-block">

                    <div class="cndt-head-left">
                        <div class="cndt-head-thumb">
                            <figure>
                                <img src="{{ asset('storage/'.$candidate->image ?? 'storage/default-avatar.png') }}" 
                                     class="img-fluid circle" alt="{{ $candidate->name }}">
                            </figure>
                        </div>
                        <div class="cndt-head-caption">
                            <div class="cndt-head-caption-top">
                                <div class="cndt-yior-1">
                                    <span class="label text-sm-muted text-success bg-light-success">Featured</span>
                                </div>
                                <h4 class="cndt-title text-white">
                                        {{ $candidate->name }}
                                </h4>
                                <div class="cndt-yior-3">
                                    <span>
                                        <i class='fas fa-map-marker-alt'></i>
                                        @if(Auth::check())
                                            {{ $candidate->candidateProfile->city ?? 'Address not specified' }}
                                        @else
                                            @php
                                                $city = $candidate->candidateProfile->city ?? 'Address not specified';
                                            @endphp
                                            {{ Str::substr($city, 0, 2) . str_repeat('*', max(0, strlen($city)-2)) }}
                                        @endif
                                    </span>
                                    <span>
                                        <i class="fas fa-dollar-sign"></i>
                                        @if(Auth::check())
                                            {{ $candidate->candidateProfile->salary ?? 'Salary not specified' }}
                                        @else
                                            @php
                                                $salary = $candidate->candidateProfile->salary ?? '';
                                            @endphp
                                            {{ $salary ? (Str::substr($salary, 0, 2) . str_repeat('*', max(0, strlen($salary)-2))) : '********' }}
                                        @endif
                                    </span>
                                </div>
                                @if(!Auth::check())
                                    <div class="alert alert-warning mt-2">
                                        Please <a href="{{ route('user.login') }}">login</a> to view candidate details.
                                    </div>
                                @endif                                
                            </div>
                            <div class="cndt-head-caption-bottom">
                                <div class="cndt-yior-skills">
                                    @if(!empty($candidate->candidateProfile->skills) && $candidate->candidateProfile->skills->isNotEmpty())
                                        @foreach($candidate->candidateProfile->skills as $skill)
                                            <span>{{ $skill->skill_name }}</span>
                                        @endforeach
                                    @else
                                        <p>No skills available for this candidate.</p>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="cndt-head-right">
                        @if(Auth::check())
                            @if(!empty($candidate->candidateProfile->resume))
                                <a href="{{ route('download.resume', $candidate->candidateProfile->user_id) }}" class="btn btn-inline">
                                    Download CV &nbsp; <i class='fas fa-download'></i>
                                </a>
                            @else
                                <a href="#" class="btn btn-inline disabled">
                                    No CV Uploaded
                                </a>
                            @endif
                        @else
                            <a href="{{ route('user.login') }}" class="btn btn-inline">
                                Login to Download CV
                            </a>
                        @endif
                        @php
                            $isBookmarked = false;
                            if(Auth::check()) {
                                $isBookmarked = DB::table('candidate_bookmarks')
                                    ->where('user_id', auth()->id())
                                    ->where('candidate_profile_id', $candidate->candidateProfile->user_id)
                                    ->exists();
                            }
                        @endphp
                        
                        <meta name="is-logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">
                        <button type="button" 
                                class="btn btn-outline-primary mx-2 bookmark-btn" 
                                data-profile-id="{{ $candidate->candidateProfile->user_id }}" 
                                data-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}">
                            <i class="{{ $isBookmarked ? 'fas fa-bookmark' : 'far fa-bookmark' }}"></i>
                        </button>

                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="cdtsr-groups-block">

                    <!-- About Section -->
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>About Candidate</h5>
                            <hr/>
                        </div>
                        <div class="single-cdtsr-body">
                            <p>{{ strip_tags($candidate->candidateProfile->about) ?? 'This candidate has not provided their profile details yet.' }}</p>
                        </div>
                    </div>

                    <!-- All Information Section -->
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>All Information</h5>
                            <hr>
                        </div>
                        <div class="single-cdtsr-body">
                            <div class="row align-items-center justify-content-between gy-4">
                                <div class="col-xl-6 col-lg-6 col-md-6 mb-2">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class='fas fa-envelope-open-text'></i></div>
                                        <div class="cdtx-infr-captions">
                                            @php
                                                $email = $candidate->email;
                                            @endphp

                                            <h5>
                                            @if(Auth::check())
                                                {{ $email }}
                                            @else
                                                @php
                                                    // Mask: show first 2 chars, then stars, then (optionally) the @domain part
                                                    $atPos = strpos($email, '@');
                                                    if($atPos !== false){
                                                        $visible = substr($email, 0, 2);
                                                        $masked = str_repeat('*', max(0, $atPos - 2));
                                                        $domain = substr($email, $atPos);
                                                        echo $visible . $masked . $domain;
                                                    } else {
                                                        // If not a valid email, just mask all but 2 chars
                                                        echo substr($email, 0, 2) . str_repeat('*', max(0, strlen($email) - 2));
                                                    }
                                                @endphp
                                                <br>
                                                <span class="text-muted">(<a href="{{ route('user.login') }}">Login to view full email</a>)</span>
                                            @endif
                                            </h5>
                                            <p>Mail Address</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 mb-2">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-phone-volume"></i></div>
                                        <div class="cdtx-infr-captions">
                                            

                                            <p>Phone No.</p>
                                            @php
                                                $phone = $candidate->phone ?? '';
                                            @endphp

                                            <h5>
                                            @if(Auth::check())
                                                {{ $phone }}
                                            @else
                                                @php
                                                    // Show first 2 digits, then stars for the rest
                                                    $maskedPhone = substr($phone, 0, 2) . str_repeat('*', max(0, strlen($phone) - 2));
                                                    echo $maskedPhone;
                                                @endphp
                                                <span class="text-muted ml-2">(<a href="{{ route('user.login') }}">Login to view full number</a>)</span>
                                            @endif
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 mb-2">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-user"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>
                                                @if(Auth::check())
                                                    {{ ucfirst($candidate->candidateProfile && $candidate->candidateProfile->gender ? $candidate->candidateProfile->gender : 'Not disclosed') }}
                                                @else
                                                    @php
                                                        // Fully mask the gender for non-logged-in users
                                                        $gender = $candidate->candidateProfile && $candidate->candidateProfile->gender ? $candidate->candidateProfile->gender : 'Not disclosed';
                                                        $maskedGender = str_repeat('*', strlen($gender));
                                                        echo $maskedGender;
                                                    @endphp
                                                    <span class="text-muted ml-2">(<a href="{{ route('user.login') }}">Login to view full gender</a>)</span>
                                                @endif
                                            </h5>                                            
                                            
                                            <p>Gender</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-6 mb-2">
                                    <div class="cdtx-infr-box">
                                        <div class="cdtx-infr-icon"><i class="fas fa-birthday-cake"></i></div>
                                        <div class="cdtx-infr-captions">
                                            <h5>
                                                @if(Auth::check())
                                                    @if(!empty($candidate->candidateProfile->dob))
                                                        {{ \Carbon\Carbon::parse($candidate->candidateProfile->dob)->format('jS-M-Y') }}
                                                    @else
                                                        DOB not specified
                                                    @endif
                                                @else
                                                    @if(!empty($candidate->candidateProfile->dob))
                                                        @php
                                                            $dob = \Carbon\Carbon::parse($candidate->candidateProfile->dob);
                                                            $maskedDob = $dob->format('jS-M') . str_repeat('*', 4); // Mask year
                                                            echo $maskedDob;
                                                        @endphp
                                                        <span class="text-muted ml-2">(<a href="{{ route('login') }}">Login to view full DOB</a>)</span>
                                                    @else
                                                        DOB not specified
                                                    @endif
                                                @endif
                                            </h5>
                                                                                         
                                            <p>Birthdate</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Other Sections (Education, Experience, Skills, Languages) -->
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>All Experience</h5>
                            <hr>
                        </div>
                        <div class="single-cdtsr-body">
                            @foreach($candidate->experiences as $experience)
                                <div class="single-experinc-block">
                                    <div class="single-experinc-rght">
                                        <h5>{{ $experience->company }}</h5>
                                        <p>{{ $experience->job_title }}</p>
                                        <p>{{ $experience->from_date }} - {{ $experience->to_date }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- Educations --}}
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>Educations</h5>
                            <hr>
                        </div>
                        <div class="single-cdtsr-body">
                            @if(!empty($candidate->educations) && $candidate->educations->isNotEmpty())
                                <div class="educations-usr-groups">
                                    @forelse ($candidate->educations as $education)
                                        <div class="single-educations-block">
                                            <div class="single-educations-rght">
                                                <div class="educations-emp-title">
                                                    <h5>{{ $education->institution  ?? 'Institution Name Not Provided' }}</h5>
                                                </div>
                                                <div class="educations-post-title">
                                                    <h6>{{ $education->degree ?? 'Degree Not Provided' }}</h6>
                                                </div>
                                                <div class="educations-infos-list">
                                                    <span class="exp-start">{{ $education->from_date ? $education->from_date->format('M Y') : 'Start Date Not Provided' }}</span>

                                                    <span class="work-exp-date">{{ $education->location ?? 'Location Not Provided' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No education records found.</p>
                            @endif
                        </div>
                    </div>
                    
                    {{--Skills  --}}
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>Candidate Skills</h5>
                            <hr>
                        </div>
                        <div class="single-cdtsr-body">
                            @if(!empty($candidate->candidateProfile->skills) && $candidate->candidateProfile->skills->isNotEmpty())
                                <div class="cndts-all-skills-list">
                                    @foreach($candidate->candidateProfile->skills as $skill)
                                        <span>{{ $skill->skill_name }} - {{ $skill->pivot->proficiency_level }}</span>
                                    @endforeach
                                </div>
                            @else
                                <p>No skills have been added yet.</p>
                            @endif
                        </div>
                        
                    </div>
                    
                    {{-- Languages --}}
                    <div class="single-cdtsr-block">
                        <div class="single-cdtsr-header">
                            <h5>Language</h5>
                            <hr>
                        </div>
                        <div class="single-cdtsr-body">
                            @if(!empty($candidate->candidateLanguages) && $candidate->candidateLanguages->isNotEmpty())
                                <div class="row gy-4">
                                    @foreach($candidate->candidateLanguages as $language)
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                            <div class="cndts-lgs-blocks">
                                                <div class="cndts-lgs-ico">
                                                    <h6>{{ strtoupper(substr($language->language_name, 0, 2)) }}</h6>
                                                </div>
                                                <div class="cndts-lgs-captions">
                                                    <h5>{{ $language->language_name }}</h5>
                                                    <p>{{ ucfirst($language->proficiency_level) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No languages have been specified.</p>
                            @endif
                        </div>
                    </div>
                    
                    {{--  --}}
                </div>
            </div>

            <!-- Sidebar (Contact Section) -->
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="sidefr-usr-block">
                    <h4>Contact {{ $candidate->name }}</h4>
                    <hr>
                    <form action="#" id="frm_contact" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="to_email" value="{{$candidate->email}}">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" >
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-inline send-message">Send Message</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@push('scripts')
<script>
    const shareBtn = document.querySelector('#shareBtn');
    if (shareBtn) {
        shareBtn.addEventListener('click', event => {
            if (navigator.share) {
                navigator.share({
                    title: '',
                    url: '{{ generateCanonicalUrl() }}'
                }).then(() => {
                    console.log('Thanks for sharing!')
                }).catch(err => {
                    console.log("Error while using Web share API:");
                    console.log(err)
                });
            } else {
                alert("Browser doesn't support this API!");
            }
        });
    } 


</script>

<script>
    document.addEventListener('DOMContentLoaded', function () { 
        const bookmarkButtons = document.querySelectorAll('.bookmark-btn');
        const isLoggedIn = document.querySelector('meta[name="is-logged-in"]').getAttribute('content') === 'true';

        bookmarkButtons.forEach(button => {
            button.addEventListener('click', function () {
                if (!isLoggedIn) {
                    toastr.error('You must be logged in to bookmark.');
                    return;
                }

                const profileId = this.getAttribute('data-profile-id');
                const icon = this.querySelector('i');

                this.disabled = true;
                icon.classList.add('loading-spinner');

                fetch(`/toggle-bookmark/${profileId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        this.setAttribute('data-bookmarked', data.bookmarked ? 'true' : 'false');

                        if (data.bookmarked) {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                            toastr.success(data.message || 'Bookmark added successfully.');
                        } else {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                            toastr.info(data.message || 'Bookmark removed successfully.');
                        }
                    } else {
                        toastr.error(data.message || 'Something went wrong!');
                    }
                })
                .catch(error => {
                    toastr.error('An error occurred. Please try again later.');
                    console.error('Error:', error);
                })
                .finally(() => {
                    this.disabled = false;
                    icon.classList.remove('loading-spinner');
                });
            });
        });
    });





</script>
<script>
    $(document).ready(function () {
        $('#frm_contact').on('submit', function (e) {
            e.preventDefault();

            let formData = {
                _token: $('input[name="_token"]').val(),
                to_email: $('input[name="to_email"]').val(),
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                message: $('textarea[name="message"]').val()
            };

            $.ajax({
                url: '{{ route("contact.send") }}',
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $('#frm_contact')[0].reset();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('An error occurred. Please try again later.');
                    }
                }
            });
        });
    });

</script>

@endpush
@endsection