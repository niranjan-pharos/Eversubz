@extends('layouts.eventlayout')

@section('title', 'Home')
@section('description', 'Welcome to Eversubz')

@section('content') 

<div class="container mx-auto grid grid-cols-1 md:grid-cols-12 gap-4" id="js-oversized">
    <div class="lg:col-span-3 xl:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
            <div>
                <div class="bg-white p-4 rounded shadow-md filter-desktop">
                    <h6 class="font-semibold mb-4">Filter by Category</h6>
                    <form>
                        <ul class="bg-white p-4 rounded-md shadow-md">
                            @foreach ($categories as $category)
                            <li class="flex items-center space-x-2 mb-2 ml-1">
                                <input type="checkbox" id="cat{{ $category->id }}" name="categories[]" value="{{ $category->slug }}"
                                    class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded-sm focus:ring-0">
                                <label for="cat{{ $category->id }}" class="flex-1 flex items-center justify-between text-gray-700">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-gray-500">{{ $category->fundraisings_infos_count }}</span>
                                </label>
                            </li>
                            @endforeach
                            
                        </ul>

                        <div class="mt-5 flex space-x-2">
                            {{-- <a href=""
                                class="bg-gray-300 text-black px-3 py-1.5 rounded-md flex items-center shadow hover:bg-gray-400 transition duration-300 text-sm"> --}}
                                <i class="fa fa-scissors mr-2" aria-hidden="true"></i>Reset
                            {{-- </a> --}}
                            <button type="submit"
                                class="bg-blue-500 text-white px-3 py-1.5 rounded-md flex items-center shadow hover:bg-blue-600 transition duration-300 text-sm">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                        </div>
                    </form>

                </div>



            </div>

        </div>

    </div>
    <div class="lg:col-span-5 xl:col-span-6">


        <div class="page-heading">

            <h1 class="page-title"> Featured Campaign </h1>

          

        </div>

      


        <div tabindex="-1" uk-slider="finite:true">

            <div class="uk-slider-container pb-1">

            @if ($featuredfundraisings->isEmpty())
            <p class="text-gray-500 text-center">No featured fundraisings available at the moment.</p>
        @else
            <ul class="uk-slider-items grid-small">
                @foreach ($featuredfundraisings as $featuredfundraising)
                <li class="sm:w-1/3 w-1/2">
                    <div class="card">
                        <a href="{{ route('fundaraising.show', $featuredfundraising->slug) }}">
                            <div class="card-media h-32">
                                <img src="{{ asset('storage/' . $featuredfundraising->main_image) }}" alt="">
                                <div class="card-overly"></div>
                            </div>
                        </a>
                        <div class="card-body">
                            <a href="{{ route('fundaraising.show', $featuredfundraising->slug) }}">
                                <h4 class="card-title text-sm line-clamp-2">{{ $featuredfundraising->title }}</h4>
                            </a>
                            <div class="text-blue-500 font-medium text-xs mt-3">
                                <span>0</span> <span>of</span> <span>{{ $featuredfundraising->amount }}</span> Raised
                            </div>
                        </div>
                        <div class="bg-secondary rounded-2xl h-1 w-full relative overflow-hidden">
                            <div class="bg-blue-600 w-1/3 h-full"></div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
             <a class="nav-prev !top-24" href="#" uk-slider-item="previous">
                <ion-icon name="chevron-back" class="text-2xl"></ion-icon>
            </a>
            <a class="nav-next !top-24" href="#" uk-slider-item="next">
                <ion-icon name="chevron-forward" class="text-2xl"></ion-icon>
            </a>

        @endif

            </div>

           
        </div>


        <div class="flex items-center justify-between text-black  py-3 mt-10">
            <h3 class="text-xl font-semibold"> All Campaign</h3>
        </div>

        <div class="box p-5 mt-6">
        @foreach ($fundraisings as $fundraising)

            <div class="card-list">
                <a href="{{ route('fundaraising.show', $fundraising->slug) }}">
                    <div class="card-list-media sm:w-56 sm:h-full">
                        <img src="{{ asset('storage/' . $fundraising->main_image) }}" alt="">
                    </div>
                </a>
                <div class="card-list-body">
                    <a href="{{ route('fundaraising.show', $fundraising->slug) }}">
                        <h3 class="card-list-title">{{ $fundraising->title }}</h3>
                    </a>
                    <div class="card-list-text">
                        <p>{!! $fundraising->fundraising_description !!}</p>
                    </div>
                    <div class="mt-3">
                        <div class="text-blue-500 font-medium text-sm mb-2"> <span> 0</span> <span>
                                of</span> <span> {{ $fundraising->amount }}</span> Raised </div>
                        <div class="bg-secondery rounded-2xl h-1 w-full relative overflow-hidden">
                            <div class="bg-blue-600 w-1/3 h-full"></div>
                        </div>
                    </div>
                </div>

            </div>

            <hr class="card-list-divider">

            @endforeach

        </div>

        <div class="flex justify-center my-6">
            <button type="button"
                class="bg-white py-2 px-5 rounded-full shadow-md font-semibold text-sm ">Load
                more...</button>
        </div>


    </div>

    <div class="2xl:w-[380px] lg:w-[330px] w-full lg:col-span-4 xl:col-span-3">

        <div class="lg:space-y-6 space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6"
            uk-sticky="media: 1024; end: #js-oversized; offset: 80;bottom:true">

            <div class="box overflow-hidden">

                <div class="w-full h-24 relative">
                    <img src="main_assets/images/funding/funder-1.jpg" alt=""
                        class="w-full h-full absolute object-cover">
                </div>

                <div class="p-5">
                    <h3 class="font-bold text-base"> Create a fundraiser </h3>

                    <p class="text-sm mt-1"> Fundraisers provide a simple way to stand with your friends,
                        family, and the causes that hold significance for you such as:</p>

                    <div class="mt-4 text-sm font-medium space-y-2">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                    clip-rule="evenodd"></path>
                                <path
                                    d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z">
                                </path>
                            </svg>
                            Medical
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path
                                    d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                                <path
                                    d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                                <path
                                    d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
                            </svg>
                            Education
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path
                                    d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                            </svg>
                            Nunprofits and more
                        </div>
                    </div>

                    <a href="#" class="text-center text-sm text-blue-500">
                        <div class="flex items-center justify-center gap-2 mt-3"> Raise Money <ion-icon
                                name="arrow-forward-outline" class="flex"></ion-icon>
                        </div>
                    </a>

                </div>

            </div>

            <div class="bg-white rounded-xl shadow p-5 px-6 border1 ">
                <h3 class="font-semibold text-base"> We're here to help </h3>
                <p class="text-sm mt-1"> Answers to common questions about fundraisers </p>

                <ul class="relative space-y-2.5 text-sm mt-3" uk-accordion="active: 0">

                    <li class="rounded-md bg-secondery">
                        <a class="flex items-center justify-between p-3 py-2 font-semibold group text-black  uk-accordion-title"
                            href="#">
                            Who can create fundraiser?
                            <ion-icon name="chevron-down-outline"
                                class="duration-200 -mr-0.5 text-base group-aria-expanded:rotate-180"></ion-icon>
                        </a>
                        <div class="p-3 pt-0 /80 uk-accordion-content">
                            <p>Anyone who is passionate about a cause can create a fundraiser. This includes
                                individuals, groups, and organizations</p>
                            <a href="#" class="block font-medium mt-3 text-blue-600"> See full article</a>
                        </div>
                    </li>
                    <li class="rounded-md bg-secondery">
                        <a class="flex items-center justify-between p-3 py-2 font-semibold group text-black  uk-accordion-title"
                            href="#">
                            How do taxes work?
                            <ion-icon name="chevron-down-outline"
                                class="duration-200 -mr-0.5 text-base group-aria-expanded:rotate-180"></ion-icon>
                        </a>
                        <div class="p-3 pt-0 /80 uk-accordion-content">
                            <p>There is no fee to start or manage your fundraiser. The transaction fee
                                covers the costs of credit and debit charges, safely delivering donations,
                            </p>
                            <a href="#" class="block font-medium mt-3 text-blue-600"> See full article</a>
                        </div>
                    </li>
                    <li class="rounded-md bg-secondery">
                        <a class="flex items-center justify-between p-3 py-2 font-semibold group text-black  uk-accordion-title"
                            href="#">
                            How do fees work?
                            <ion-icon name="chevron-down-outline"
                                class="duration-200 -mr-0.5 text-base group-aria-expanded:rotate-180"></ion-icon>
                        </a>
                        <div class="p-3 pt-0 /80 uk-accordion-content">
                            <p>Fundraising tax laws define donations as gifts, which recipients do not have
                                to report on their tax returns.</p>
                            <a href="#" class="block font-medium mt-3 text-blue-600"> See full article</a>
                        </div>
                    </li>

                </ul>



            </div>

        </div>

    </div>

</div>



@endsection