@extends('layouts.eventlayout')
@section('content')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    .user-images1{object-fit: contain;}

    .footer-part{margin-top:25px;}.ad-details-desc,.ad-details-desc p{text-align:justify}h1{font-weight:600;font-size:21px}h2,h3,h4,h5,h6{font-size:18px!important}.h61{font-size:15px!important}.single-content h2{font-size:38px!important}.ad-details-desc p{font-size:14px}.events-para12{column-gap:30px}.events-para12 .location12{color:#000}.events-para13,.events-para14{display:flex;column-gap:5px}.swal2-container{z-index:9999999}.swal2-title{text-align:left;font-size:20px;padding:0 1em .8em;border-bottom:1px solid #dee2e6}.swal2-title h3{font-size:22px}.swal2-html-container div{display:flex;justify-content:center}.swal2-html-container div a{margin:15px;font-size:15px;font-weight:500}.swal2-html-container div a .logo{width:20px;height:20px;font-size:20px;padding:14px;border-radius:50%;margin-bottom:5px;text-align:center;color:#fff;background:#04b}@media only screen and (max-width:767px){.into-para{flex-direction:column}.events-para15{display:block}.events-para14{display:flex;column-gap:5px;margin-top:13px;justify-content:center}}

 </style>

@if($profileType == 'user')
            @foreach($user->adPosts as $adPost)
            @endforeach
            @else
            @foreach($business->user->adPosts as $adPost)

            @endforeach
            @endif

            @if($profileType == 'business')
            @foreach($business->products as $product)
            @endforeach
            @endif

            @if($profileType == 'user')
            @foreach($user->events as $event)
            @endforeach
            @else
            @foreach($business->user->events as $event)
            @endforeach
            @endif




<div class="max-w-[1065px] mx-auto max-lg:-m-2.5">

    <div class="bg-white shadow lg:rounded-b-2xl lg:-mt-10">

        <div class="relative overflow-hidden w-full lg:h-72 h-48">
            <img loading="eager" src="{{ $user->image ? asset('storage/'.$user->image) : asset('storage/no-image.jpg') }}" alt="profile cover" class="h-full w-full object-cover inset-0"> 

            <div class="w-full bottom-0 absolute left-0 bg-gradient-to-t from-black/60 pt-20 z-10"></div>

            {{-- <div class="absolute bottom-0 right-0 m-4 z-20">
                <div class="flex items-center gap-3">
                    <button
                        class="button bg-white/20 text-white flex items-center gap-2 backdrop-blur-small">Crop</button>
                    <button
                        class="button bg-black/10 text-white flex items-center gap-2 backdrop-blur-small">Edit</button>
                </div>
            </div> --}}

        </div>

        <div class="p-3">
            
            <div class="flex flex-col justify-center md:items-center  -mt-28">
                <div class="relative  w-32 h-28 mb-4 z-10">
                    <div
                        class="relative overflow-hidden rounded-full md:border-[6px] border-gray-100 shrink-0 shadow">
                        <img loading="eager" src="{{ $user->image ? asset('storage/'.$user->image) : asset('storage/no-image.jpg') }}"
                            alt="{{$user->image}}" class=" w-full  h-28 inset-0" style="background: #eee; object-fit: contain;">
                    </div>
                    <!-- <button type="button"
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-white shadow p-1.5 rounded-full sm:flex hidden">
                        <ion-icon name="camera" class="text-2xl md hydrated" role="img" aria-label="camera"></ion-icon>
                    </button> -->
                </div>

                <h3 class="md:text-3xl text-base font-bold text-black">
                     {{ $user->name }}
                </h3>
           

                <p class="mt-2 max-w-xl text-sm md:font-normal font-light text-center hidden">
                    I love beauty and emotion. 🥰 I’m passionate about photography and learning. 📚 I explore genres and
                    styles. 🌈 I think photography is storytelling. 😊
                </p>
            </div>

            


        </div>

        <div class="flex items-center justify-between mt-3 border-t border-gray-100 px-2 max-lg:flex-col       "
            uk-sticky="offset:50; cls-active: bg-white/80 shadow rounded-b-2xl z-50 backdrop-blur-xl animation:uk-animation-slide-top ; media: 992">

            {{-- <div class="flex items-center gap-2 text-sm py-2 pr-1 max-md:w-full lg:order-2">
                <button class="button bg-primary flex items-center gap-2 text-white py-2 px-3.5 max-md:flex-1">
                    <ion-icon name="add-circle" class="text-xl"></ion-icon>
                    <span class="text-sm"> Add Your Story </span>
                </button>

                <button type="submit" class="rounded-lg bg-secondery flex px-2.5 py-2">
                    <ion-icon name="search" class="text-xl">
                </button>

                <div>
                    <button type="submit" class="rounded-lg bg-secondery flex px-2.5 py-2">
                        <ion-icon name="ellipsis-horizontal" class="text-xl">
                    </button>
                    <div class="w-[240px]"
                        uk-dropdown="pos: bottom-right; animation: uk-animation-scale-up uk-transform-origin-top-right; animate-out: true; mode: click;offset:10">
                        <nav>
                            <a href="#">
                                <ion-icon class="text-xl" name="pricetags-outline"></ion-icon> Unfollow
                            </a>
                            <a href="#">
                                <ion-icon class="text-xl" name="time-outline"></ion-icon> Mute story
                            </a>
                            <a href="#">
                                <ion-icon class="text-xl" name="flag-outline"></ion-icon> Report
                            </a>
                            <a href="#">
                                <ion-icon class="text-xl" name="share-outline"></ion-icon> Share profile
                            </a>
                            <hr>
                            <a href="#" class="text-red-400 hover:!bg-red-50">
                                <ion-icon class="text-xl" name="stop-circle-outline"></ion-icon> Block
                            </a>
                        </nav>
                    </div>
                </div>
            </div> --}}

            <nav
                class="flex gap-0.5 rounded-xl -mb-px text-gray-600 font-medium text-[15px]  max-md:w-full max-md:overflow-x-auto">
                <a href="#"
                    class="inline-block  py-3 leading-8 px-3.5 border-b-2 border-blue-600 text-blue-600">Timeline</a>

            </nav>

        </div>

    </div>

    <div class="flex 2xl:gap-12 gap-10 mt-8 max-lg:flex-col" id="js-oversized">


        <div class="flex-1 xl:space-y-6 space-y-3">

            
            {{-- Business Profile--}}
            @if($user->businessInfos)

            <h1>Business Info</h1>
            <div class="bg-white rounded-xl shadow-sm text-sm font-medium border1">

                <div class="flex gap-3 sm:p-4 p-2.5 text-sm font-medium">
                    <a href="#"> <img loading="eager"
                            src="{{ $user->image ? asset('storage/'.$user->image) : asset('storage/no-image.jpg') }}"
                            alt="no image" class="w-9 h-9 rounded-full user-images1"> </a>
                    <div class="flex-1">
                        <a href="#">
                            <h4 class="text-black">{{ $user->name }} </h4>
                        </a>

                    </div>
                    
                </div>

                <div class="relative w-full lg:h-96 h-full sm:px-4">
                    <img loading="eager" src="{{ asset('storage/'.$user->businessInfos->logo_path) }}"
                        alt="{{ $user->businessInfos->business_name }}"
                        class="sm:rounded-lg w-full h-full object-contain user-images1">
                </div>

                @if($user->businessInfos->business_name)
                <div class="sm:px-8 ">
                    <h1>{{ $user->businessInfos->business_name }}</h1>
                </div>
                @endif

                <div class="p-4 ad-details-desc">
                    <p>{!! $user->businessInfos->business_description !!}</p>
                </div>

            </div>
            @endif


            {{-- AdPost --}}
            @if($user->adPosts->isNotEmpty())
            <h1>Latest Post</h1>
            @foreach($user->adPosts as $post)
                @php
                    $wordLimit = 30;
                    $preview = html_word_truncate($post->description, $wordLimit);
                    $textOnly = strip_tags($post->description);
                    $words = str_word_count($textOnly);
                    $showReadMore = $words > $wordLimit;
                @endphp

                <div class="bg-white rounded-xl shadow-sm text-sm font-medium border1 mb-4">
                    <div class="flex gap-3 sm:p-4 p-2.5 text-sm font-medium">
                        <a href="#">
                            <img loading="eager"
                                src="{{ $user->image ? asset('storage/'.$user->image) : asset('storage/no-image.jpg') }}"
                                alt="no image" class="w-9 h-9 rounded-full user-images1">
                        </a>
                        <div class="flex-1">
                            <a href="#">
                                <h4 class="text-black">{{ $user->name }} </h4>
                            </a>
                            <div class="text-xs text-gray-500"> {{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    @if($post->primaryImage)
                        <div class="relative w-full lg:h-96 h-full sm:px-4">
                            <a href="{{route('product.show',['item_url'=>$post->item_url])}}">
                                <img loading="eager" src="{{ asset('storage/'.$post->primaryImage->url) }}" alt="{{ $post->title }}"
                                    class="sm:rounded-lg w-full h-full object-contain user-images1">
                            </a>
                        </div>
                    @endif

                    <div class="p-4 ad-details-desc">
                        <div id="desc-{{ $post->id }}">
                            {!! $showReadMore ? $preview : $post->description !!}
                        </div>
                        @if($showReadMore)
                            <button
                                id="readMoreBtn-{{ $post->id }}"
                                class="inline-block mt-2 px-4 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full shadow hover:bg-blue-700 transition-colors duration-200"
                            >
                                Read More
                            </button>
                            <div id="fullDesc-{{ $post->id }}" style="display:none;">{!! $post->description !!}</div>
                        @endif

                    </div>
                </div>
            @endforeach
            @endif
            {{-- end adPost --}}


            {{-- BusinessProduct --}}
            @if($profileType == 'business')
            @if($business->products->isNotEmpty())
                <h1>Latest Products</h1>
            
            @foreach($business->products as $product)
            <div class="bg-white rounded-xl shadow-sm text-sm font-medium border1">

                <div class="flex gap-3 sm:p-4 p-2.5 text-sm font-medium">
                    <a href="#"> <img loading="eager"
                            src="{{ $user->image ? asset('storage/'.$user->image) : asset('storage/no-image.jpg') }}"
                            alt="no image" class="w-9 h-9 rounded-full user-images1"> </a>
                    <div class="flex-1">
                        <a href="#">
                            <h4 class="text-black">{{ $user->name }} </h4>
                        </a>
                        <div class="text-xs text-gray-500"> {{ $product->created_at->diffForHumans() }}
                        </div>
                    </div>

                </div>

                @if($product->main_image)
                <div class="relative w-full lg:h-96 h-full sm:px-4">
                    <a href="{{ route('BusinessProduct.view',['item_url'=>$product->item_url])}}">
                    <img loading="eager" src="{{ asset('storage/'.$product->main_image) }}" alt="{{$product->title }}"
                        class="sm:rounded-lg w-full h-full object-contain user-images1"></a>
                </div>
                @endif

                <div class="p-4  ad-details-desc">
                    <p>{!! $product->description !!}</p>
                </div>


            </div>
            @endforeach
            @endif
            @endif
            {{-- end BusinessProduct --}}


            {{-- Events --}}
            
            @if($user->events->isNotEmpty())
            <h1>Latest Events</h1>
            @foreach($user->events as $event)
            <div class="bg-white rounded-xl shadow-sm text-sm font-medium border1">

                <div class="flex gap-3 sm:p-4 p-2.5 text-sm font-medium">
                    <a href="#"> <img loading="eager"
                            src="{{ $user->image ? asset('storage/'.$user->image) : asset('storage/no-image.jpg') }}"
                            alt="no image" class="w-9 h-9 rounded-full user-images1"> </a>
                    <div class="flex-1">
                        <a href="#">
                            <h4 class="text-black">{{ $user->name }} </h4>
                        </a>
                        <div class="text-xs text-gray-500"> {{ $event->created_at->diffForHumans() }}
                        </div>
                    </div>

                </div>

                <div class="relative w-full lg:h-96 h-full sm:px-4">
                    <a href="{{ route('event.show',['slug'=>$event->slug])}}">
                    <img loading="eager" src="{{ $event->main_image ? asset('storage/'.$event->main_image) : asset('storage/no-image.jpg') }}" alt="{{ $event->title }}"
                        class="sm:rounded-lg w-full h-full object-contain user-images1">
                    </a>
                </div>
                

                <div class="p-4  ad-details-desc">
                    <p>{!! $event->event_description !!}</p>
                </div>


            </div>
            @endforeach
            @endif
            {{-- end event --}}

            


        </div>


        <div class="lg:w-[400px]">

            <div class="lg:space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6"
                uk-sticky="media: 1024; end: #js-oversized; offset: 80">

                <div class="box p-5 px-6">

                    <div class="flex items-ce justify-between text-black">
                        <h3 class="font-bold text-lg"> Intro </h3>
                    </div>

                    <ul class="text-gray-700 space-y-4 mt-4 text-sm">

                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            @if($profileType == 'business' )
                            @if($user->businessInfos->business_city)
                            <div> Live In <span class="font-semibold text-black">
                                    {{$user->businessInfos->business_city.", ".$user->businessInfos->business_state}}
                                </span> 
                            </div>
                            @elseif($profileType == 'user')
                            <div> Live In <span class="font-semibold text-black">
                                    {{$user->userDetails->billing_city.", ".$user->userDetails->billing_state}}
                                </span> 
                            </div>
                            @endif
                            @endif
                        </li>
                        
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>

                            <div> Number of Ads Post <span class="font-semibold text-black"> {{$totalAdPosts}}
                                </span> </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            <div> Number of Products <span class="font-semibold text-black"> {{$totalProducts}} </span>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12.75 19.5v-.75a7.5 7.5 0 00-7.5-7.5H4.5m0-6.75h.75c7.87 0 14.25 6.38 14.25 14.25v.75M6 18.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            <div> Number of Events <span class="font-semibold text-black"> {{ $totalEvents}}
                                </span> </div>
                        </li>

                    </ul>

                    @if($profileType == 'business')
                    
                    <div class="flex flex-wrap gap-1 text-sm mt-4 font-semibold capitalize">
                        <h3>Deals In </h3>
                        @if($business->deals->isNotEmpty())
                        @foreach($business->deals as $deal)
                        
                        <div
                            class="inline-flex items-center gap-2 py-0.5 px-2.5 border shadow rounded-full border-gray-100">
                            {{ $deal->deal }}
                        </div>
                        @endforeach
                        @endif
                        
                    </div>
                    @endif

                    <!-- <div class="hidden grid grid-cols-2 gap-1 text-center text-sm mt-4 mb-2 rounded-lg overflow-hidden">

                        <div class="relative w-full aspect-[4/3]">
                            <img loading="eager" src="https://eversabz.com/main_assets/images/avatars/avatar-5.jpg" alt="avatar"
                                class="object-contain w-full h-full inset-0">
                        </div>
                        <div class="relative w-full aspect-[4/3]">
                            <img loading="eager" src="https://eversabz.com/main_assets/images/avatars/avatar-7.jpg" alt="avatar"
                                class="object-contain w-full h-full inset-0">
                        </div>
                        <div class="relative w-full aspect-[4/3]">
                            <img loading="eager" src="https://eversabz.com/main_assets/images/avatars/avatar-4.jpg" alt="avatar"
                                class="object-contain w-full h-full inset-0">
                        </div>
                        <div class="relative w-full aspect-[4/3]">
                            <img loading="eager" src="https://eversabz.com/main_assets/images/avatars/avatar-6.jpg" alt="avatar"
                                class="object-contain w-full h-full inset-0">
                        </div>

                    </div> -->

                </div>


            </div>

        </div>

    </div>

</div>
@push('scripts')
<script>
document.querySelectorAll('[id^="readMoreBtn-"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var postId = this.id.replace('readMoreBtn-', '');
        var descElem = document.getElementById('desc-' + postId);
        var fullDescElem = document.getElementById('fullDesc-' + postId);
        if (descElem && fullDescElem) {
            descElem.innerHTML = fullDescElem.innerHTML;
            this.style.display = 'none';
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush


@endsection