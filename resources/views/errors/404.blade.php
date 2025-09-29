@extends('frontend.template.master')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/custom/404.css') }}">

<section class="error-part">
    <div class="container">
        <div class="error">
            <h1>404</h1>
            <h2>Oopss! Something Went Wrong?</h2>
            <a href="{{ url('/') }}" class="btn btn-outline">
                <i class="fas fa-home"></i>
                <span>go to homepage</span>
            </a>
        </div>
    </div>
</section>
@endsection
