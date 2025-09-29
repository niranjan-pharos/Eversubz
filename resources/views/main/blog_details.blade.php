@extends('layouts.eventlayout')

@section('title', 'Home')
@section('description', 'Welcome to Eversubz')

@section('content')



<div class="flex 2xl:gap-12 max-lg:flex-col gap-10 2xl:max-w-[1220px] max-w-[1065px] mx-auto"
                id="js-oversized">

                <div class="flex-1">

                    <div class="box overflow-hidden">

                        <div class="relative">

                            <img  loading="eager" src="{{ asset('storage/blog_images/' . $blog->blog_image) }}" alt="{{ $blog->alt_text }}" class="h-36 mb-4 w-full h-full object-cover">

                            <div class="p-6 w-full z-10 absolute bg-gradient-to-t bottom-0 from-black/60 hidden">
                                <h1 class="text-xl font-semibold !text-white"> {{ $blog->title }}
                                </h1>

                                <div class="flex items-center gap-5 mt-4 !text-white">
                                    <div class="w-6 h-6 flex-shrink-0 rounded-md relative">
                                        <img  loading="eager" src="assets/images/avatars/avatar-7.jpg"
                                            class="absolute w-full h-full inset-0 rounded-full object-cover" alt="">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium !text-white"> Steeve </h4>
                                        <div class="font-medium text-xs"> 2 hours ago</div>
                                    </div>
                                    <div class="text-sm ml -auto text-gray-400"> Business </div>
                                    <div class="text-sm ml-auto text-gray-400"> {{ $blog->date }}</div>
                                </div>

                            </div>

                        </div>
                        <div class="p-6">

                            <h1 class="text-xl font-semibold mt-1"> {{ $blog->title }} </h1>

                            <div class="flex gap-3 text-sm mt-6">
                                <img  loading="eager" src="{{ asset('main_assets/images/avatars/avatar-5.jpg') }}" alt="" class="w-9 h-9 rounded-full">
                                <div class="flex-1">
                                    <h4 class="text-black font-medium"> Eversabz </h4>
                                </div>
                                <div class="font-normal text-gray-500 gap-1">
                                    <span class="text-sm ml-auto text-gray-400">  {{ \Carbon\Carbon::parse($blog->date)->format('Y-m-d') }}</span>
                                </div>

                            </div>


                            <div class="space-y-2 text-sm font-normal mt-6 leading-6 text-black">
                                <p>
                                {!! $blog->blog_description !!}
                                </p>
                            </div>

                        </div>


                    </div>

                    <br>

               


                </div>

                <div class="2xl:w-[380px] lg:w-[330px] w-full">

                    <div class="lg:space-y-6 space-y-4 lg:pb-8  sm:grid-cols-2 max-lg:gap-6"
                        uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                        <div class="box p-5 px-6">

                            <div class="flex items-baseline justify-between text-black">
                                <h3 class="font-bold text-base"> Trending Articles</h3>
                                <a href="https://eversabz.com/blogs" class="text-sm text-blue-500">See all</a>
                            </div>

                            <div class="mt-4 space-y-4">
                            @foreach($new_blogs as $blogs)

                                <div>
                                    <a href="{{ asset('blog/' . $blogs->slug) }}">
                                        <h4
                                            class="text-sm font-normal text-black duration-200 hover:opacity-80">
                                            {{ $blogs->title }}</h4>
                                    </a>
                                    <div class="text-xs text-gray-400 mt-2 flex items-center gap-2">
                                        <div> {{ \Carbon\Carbon::parse($blogs->date)->format('Y-m-d') }} </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                        </div>

                       

                    </div>

                </div>

            </div>

            
            
@endsection