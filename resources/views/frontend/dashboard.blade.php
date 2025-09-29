@extends('frontend.template.master')
@section('title', "User Dashboard")

@section('content')
@include('frontend.template.usermenu')
<style>
    .announcement-item{display:flex;column-gap: 20px;
    margin: 10px 0px 0px 0px;}
</style> 

    <section class="dashboard-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="account-card alert fade show">
                        <div class="account-title">
                            <h3>Announcement</h3>
                        </div>
                        <div class="dash-content row">
                            @forelse ($announcements as $announcement)
                                <div class="announcement-item col-md-6">
                                    <h4>{{ $announcement->heading }}</h4>
                                    <p>{{ $announcement->description }}</p>
                                </div>
                            @empty
                                <p>No announcements available.</p>
                            @endforelse
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="account-card alert fade show">
                        <div class="account-title">
                            <h3>Account Info</h3>
                        </div>
                        <ul class="account-card-list">
                            <li>
                                <h5>Account Type</h5>
                                <p>{{ $acc_type }}</p>
                            </li>
                            <li>
                                <h5>Status</h5>
                                <p>{{ Auth::user()->status == 'active' ? 'Active' : 'Inactive' }}</p>
                            </li>
                            <li>
                                <h5>Joined</h5>
                                <p>{{ Auth::user()->created_at->format('F d, Y') }}</p>
                            </li>
                            <li>
                                <h5>Delete your account</h5>
                                <p><a href="{{ route('delete-account')}}">Delete</a></p>
                            </li>
                              @if($user->account_type == 2)
                        <li>
                            <h5>Business A/c. Status</h5>
                            @php
                            $status = '';
                            $backgroundColor = '';

                            switch ($user->account_type) {
                            case 2: // Business account type
                            if ($user->is_admin_approved == 1) {
                            $status = 'Enable';
                            $backgroundColor = 'green';
                            } else {
                            $status = 'Pending';
                            $backgroundColor = 'orange';
                            }
                            break;
                            default:
                            $status = 'Disable';
                            $backgroundColor = 'gray';
                            break;
                            }
                            @endphp

                            <div
                                style="background-color: {{ $backgroundColor }}; color: white; padding: 0px 10px; border-radius: 5px;">
                                {{ $status }}
                            </div>
                        </li>
                        @endif
                        @if($user->account_type == 3)
    <li>
        <h5>organization A/c. Status</h5>
        @php
        $status = '';
        $backgroundColor = '';

        switch ($user->account_type) {
            case 3: // Handle account type 3
                if ($user->is_admin_approved == 1) {
                    $status = 'Enable';
                    $backgroundColor = 'green';
                } else {
                    $status = 'Pending';
                    $backgroundColor = 'orange';
                }
                break;
            default:
                $status = 'Disable';
                $backgroundColor = 'gray';
                break;
        }
        @endphp

        <div
            style="background-color: {{ $backgroundColor }}; color: white; padding: 0px 10px; border-radius: 5px;">
            {{ $status }}
        </div>
    </li>
@endif

                        @if($user->account_type == 2)
                        <li>
                            <div>
                                <small>To activate your business account or update your business
                                    information, click on "Info" under the "My Business" menu, or <a
                                        href="{{ route('business-info.index') }}">click here</a>.</small>
                            </div>
                        </li>
                        @endif

                        @if($user->account_type == 3)
                        <li>
                            <div>
                                <small>To activate your organization's account or update your organization
                                    information, please fill  all information from <a href="{{ asset('profile') }}"> here</a>. and wait for admin approval  </small>
                            </div>
                        </li>
                        @endif
                        @if($user->account_type == 4) 
                        <li>
                            <div>
                                <small>If you want to change your candidate profile or update your personal information, click on "Info" under the "My Profile" menu, or <a href="{{ route('candidate-info.index',$user->id) }}">click here</a>.</small>
                            </div>
                        </li>
                        @endif
                        </ul>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>




@endsection