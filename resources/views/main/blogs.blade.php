@extends('layouts.eventlayout')

@section('title', 'EverSabz Blogs: Insights, Tips & Trends for a Sustainable Lifestyle')
@section('description', 'Explore insightful articles on sustainable living, eco-friendly tips, and green innovations. Join us on a journey towards a more sustainable future.')

@section('content')







<div class="relative 2xl:max-w-[1220px] max-w-[1065px] mx-auto" id="js-oversized">

    <div class="page-heading">

        <h1 class="page-title"> Blogs </h1>



    </div>



    <div class="grid 2xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-4 mt-6 grid-cols-2"
       >

        @if($blogs->isEmpty())
        <p>No blogs available at the moment.</p>
        @else
        @foreach($blogs as $blog)
        <div class="card">
            <a href="{{ asset('blog/' . $blog->slug) }}">
                <div class="card-media h-36">
                    <img  loading="eager" src="{{ asset('storage/blog_images/' . $blog->blog_image) }}" alt="{{ $blog->alt_text }}">
                    <div class="card-overly"></div>
                    <span
                        class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 left-2 rounded text-white text-xs z-10">
                        Eversabz
                    </span>
                </div>
            </a>
            <div class="card-body">

                <p class="text-teal-600 font-semibold text-xs">{{ \Carbon\Carbon::parse($blog->date)->format('Y-m-d') }}
                </p>
                <a href="{{ asset('blog/' . $blog->slug) }}">
                    <h4 class="card-title text-sm line-clamp-2 mt-1.5">{{ $blog->title }}</h4>
                </a>
                  
            </div>
        </div>
        @endforeach
        @endif






    </div>




</div>
<div style="height: 75px;"></div>



<style>
.h-36 {
    height: 130px;
}

@media not all and (min-width: 765px) {
    .h-36 {
        height: 92px;
    }
}


</style>


@endsection