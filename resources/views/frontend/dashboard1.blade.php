@extends('frontend.template.master')
@section('title', "User Dashboard")

@section('content')
@include('frontend.template.usermenu1')
<style>
    .announcement-item{display:flex;column-gap: 20px;
    margin: 10px 0px 0px 0px;}

    .delete-account h5 {
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }

    .delete-account .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
        color: #fff;
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: background 0.3s;
        float: right;
    }

    .sidebar-menu li a{
      justify-content: left;
    }


    .delete-account .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
        text-decoration: none;
    }

    .announcement-item {
        padding: 1px 0;
        border-bottom: 1px dashed #e0;
    }

    .announcement-item:last-child {
        border-bottom: none; /* remove border from the last item */
    }

    .account-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease-in-out;
}

/* Hover effect */
.account-card:hover {
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    transform: translateY(-3px);
}

/* Title section */
.account-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #f1f1f1;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.account-title h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
}

.account-title a {
    font-size: 0.9rem;
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.account-title a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Card list */
.account-card-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.account-card-list li {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px dashed #e0e0e0;
    gap: 20px;
}

.account-card-list li h5 {
    font-weight: 600;
    font-size: 0.95rem;
    color: #444;
    margin: 0;
}

.account-card-list li p {
    font-size: 0.9rem;
    color: #666;
    margin: 0;
    flex: 1;
}

/* Responsive layout */
@media (min-width: 767px) {
    .col-lg-6 {
        display: flex;
        flex-direction: column;
    }
}

</style> 

    <section class="dashboard-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="account-card">
        <div class="account-title">
            <h3>Announcement</h3>
        </div>
        <ul class="account-card-list">
            @forelse ($announcements as $announcement)
                <li>
                    <h5>{{ $announcement->heading }}</h5>
                    <p>{{ $announcement->description }}</p>
                </li>
            @empty
                <li>No announcements available.</li>
            @endforelse
        </ul>
    </div>
</div>

                <div class="col-lg-6 mb-5">
                    <div class="account-card alert fade show">
                        <div class="account-title">
                            <h3>Account Info</h3>
                        </div>
                        <ul class="account-card-list">
                            <li style="gap: 290px;">
                                <h5>Account Type</h5>
                                <p>{{ $acc_type }}</p>
                            </li>
                            <li  style="gap: 340px;">
                                <h5>Status</h5>
                                <p>{{ Auth::user()->status == 'active' ? 'Active' : 'Inactive' }}</p>
                            </li>
                            <li style="gap: 340px;">
                                <h5>Joined</h5>
                                <p>{{ Auth::user()->created_at->format('F d, Y') }}</p>
                            </li>
                            <li class="delete-account">
                                <h5>Delete your account</h5>
                                <p>
                                    <a href="{{ route('delete-account') }}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </p>
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