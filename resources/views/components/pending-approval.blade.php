@extends('layouts.eventlayout')

@section('title', 'Sabz Future: Awaiting admin approval. | Eversabz')
@section('description', 'Explore Sabz Future at Eversabz: Discover innovative solutions for a sustainable tomorrow. Join
    us in creating a greener, more eco-friendly world.')

@section('content')
@include('components.page-banner')
<div class="row justify-content-center">
    <div class="col-md-8 text-center">
        <div class="alert alert-warning py-4">
            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
            
            <h4 class="alert-heading">Profile Pending Approval</h4>@section('content')

            @php
                $title = session('title', 'Pending Approval');
                $breadcrumbs = session('breadcrumbs', [
                    route('home') => 'Home',
                    '' => 'Pending Approval'
                ]);
            @endphp
            
            @include('components.page-banner', ['title' => $title, 'breadcrumbs' => $breadcrumbs])
            
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="alert alert-warning py-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h4 class="alert-heading">Profile Pending Approval</h4>
                        <p>Your profile is currently under review by our administrators. You’ll be able to access  pages once approved.</p>
                        <hr>
                        <small class="text-muted">You will receive an email once approved.</small>
                        <div class="mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">
                                <i class="fas fa-home"></i> Go to Dashboard
                            </a>
                            <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-user-edit"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            @endsection
            
            <p>Your profile is currently under review by our administrators. You’ll be able to access candidate listings once approved.</p>
            <hr>
            <small class="text-muted">You will receive an email once approved.</small>
            <div class="mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">
                    <i class="fas fa-home"></i> Go to Dashboard
                </a>
                <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

@endsection