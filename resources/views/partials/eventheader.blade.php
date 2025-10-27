<header
    class="h-[--m-top] fixed top-0 left-0 w-full flex items-center bg-white/100 sky-50 backdrop-blur-xl border-b border-slate-200   header12">
 
    <div class="flex items-center w-full max-lg:gap-3 xl:px-6">
        <div class="2xl:w-[--w-side] lg:w-[--w-side-sm]">

            <div class="flex items-center gap-1">

                <button id="menu-toggle"
                    class="mobile-serach-bar-box flex items-center justify-center w-10 h-10 text-xl rounded-full hover:bg-gray-100 mobile-menu sidebar-btn">
                    <ion-icon name="menu-outline" class="text-2xl"></ion-icon>
                    

                </button>
                <div id="logo">
                    <a href="/">
                        <img loading="eager"  src="{{ asset('main_assets/images/logo.png') }}" alt="Eversabz Logo" class="w-24 img12">

                    </a>
                </div>

            </div>
        </div>

        <div class="flex-1 relative">

            <div class="max-w-[1220px] mx-auto flex items-center">

                <div class="relative w-full">
                <form class="header-form" method="GET" action="{{ route('search.header') }}">
                        <div id="search--box"
                            class="xl:w-[680px] sm:w-96 sm:relative rounded-xl z-20 bg-secondery max-md:hidden w-screen left-0 max-sm:fixed max-sm:top-2">
                            <svg name="search" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                class="absolute left-4 top-1/2 -translate-y-1/2 ionicon s-ion-icon"
                                viewBox="0 0 512 512">
                                <title>Search</title>
                                <path
                                    d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z">
                                </path>
                            </svg>

                            <input id="liveSearchInput" type="text" name="search_term"
                                placeholder="Search, Whatever you needs..." value="{{ request('search_term') }}"
                                class="w-full !pl-10 !font-normal !bg-transparent h-12 !text-sm">

                            <div id="searchSuggestionBox"
                                class="absolute top-full left-0 right-0 z-50 hidden bg-white border border-gray-300 shadow-md rounded">
                            </div>
                        </div>
                    </form>

                    <div class="sm:hidden">
                        <div id="mobile-search-box"
                            class="absolute  right-0 hidden absolute mt-2  overflow-hidden z-20">
                            <form class="header-form bg-secondery" method="GET" action="{{ route('search.header') }}">
                        <div class="relative w-full">
                            <svg name="search" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                class="absolute left-4 top-1/2 -translate-y-1/2 ionicon s-ion-icon"
                                viewBox="0 0 512 512">
                                <title>Search</title>
                                <path
                                    d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z">
                                </path>
                            </svg>
                            <input id="mobileSearchInput" type="text" name="search_term"
                                placeholder="Search Friends, videos .." value="{{ request('search_term') }}"
                                class="w-full !pl-10 !font-normal !bg-transparent h-12 !text-sm">

                            <div id="mobileSearchSuggestionBox"
                                class="absolute top-full left-0 right-0 z-50 hidden bg-white border border-gray-300 shadow-md rounded">
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center sm:gap-4 gap-2 absolute right-5 top-1/2 -translate-y-1/2 text-black header-icons-mobile">
                  
                    @if((Auth::user()))
                    <a href="{{ asset('ad-post/create') }}"
                        class="sm:p-2 p-1 rounded-full relative sm:bg-secondery "><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 max-sm:hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                    </a>
            @endif


                       <button class="p-2 p-1 rounded-full md:hidden relative bg-secondery search-btn"
                onclick="document.getElementById('mobile-search-box').classList.toggle('hidden')">


                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>


                <span></span>
            </button>
                    <div class="relative">
    <button id="menu2" class="p-2 p-1 rounded-full relative bg-secondery " aria-haspopup="true" aria-expanded="false">
        <svg fill="#000000" width="24px" height="24px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M 5 7 C 4.449219 7 4 7.449219 4 8 C 4 8.550781 4.449219 9 5 9 L 7.21875 9 L 9.84375 19.5 C 10.066406 20.390625 10.863281 21 11.78125 21 L 23.25 21 C 24.152344 21 24.917969 20.402344 25.15625 19.53125 L 27.75 10 L 11 10 L 11.5 12 L 25.15625 12 L 23.25 19 L 11.78125 19 L 9.15625 8.5 C 8.933594 7.609375 8.136719 7 7.21875 7 Z M 22 21 C 20.355469 21 19 22.355469 19 24 C 19 25.644531 20.355469 27 22 27 C 23.644531 27 25 25.644531 25 24 C 25 22.355469 23.644531 21 22 21 Z M 13 21 C 11.355469 21 10 22.355469 10 24 C 10 25.644531 11.355469 27 13 27 C 14.644531 27 16 25.644531 16 24 C 16 22.355469 14.644531 21 13 21 Z M 13 23 C 13.5625 23 14 23.4375 14 24 C 14 24.5625 13.5625 25 13 25 C 12.4375 25 12 24.5625 12 24 C 12 23.4375 12.4375 23 13 23 Z M 22 23 C 22.5625 23 23 23.4375 23 24 C 23 24.5625 22.5625 25 22 25 C 21.4375 25 21 24.5625 21 24 C 21 23.4375 21.4375 23 22 23 Z"></path>
        </svg>
    </button>
    <ul id="dropdownMenu" class="absolute mt-2 w-64 bg-white py-2 z-10 hidden">
        Cart items will be dynamically inserted here
    </ul>
</div>
                    @if(!empty(Auth::user()))
                    

                    

                    <div
                        class=" dropdown-toggle1 header-widget">
                        @if(!empty(Auth::user()->image))
                        <img loading="eager"  src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->username }}"
                            class="sm:w-9 sm:h-9 w-7 h-7 rounded-full shadow shrink-0">
                        @else
                        <img loading="eager"  src="{{ asset('assets/images/user-image1.png') }}" alt="{{ Auth::user()->username }}">
                        @endif
                    </div>
                    <div class="hidden bg-white rounded-lg drop-shadow-xl  w-64 border2"
                        uk-drop="offset:6;pos: bottom-right;animate-out: true; animation: uk-animation-scale-up uk-transform-origin-top-right ">
                        <div class="p-4 py-5 flex items-center gap-4 header-widget">

                            @if(!empty(Auth::user()->image))
                            <img loading="eager"  src="{{ asset('storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->username }}"
                                class="w-10 h-10 rounded-full shadow">
                            @else
                            <img loading="eager"  src="{{ asset('assets/images/user-image1.png') }}" alt="{{ Auth::user()->username }}">
                            @endif
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-black">{{ Auth::user()->name }} </h4>
                                <div class="text-sm mt-1 text-blue-600 font-light ">
                                    {{ '@' . Auth::user()->username }}</div>
                            </div>
                        </div>
                        <hr class="">
                        <nav class="p-2 text-sm text-black font-normal ">
                            <a href="{{ route('dashboard') }}">
                                <div
                                    class="flex items-center gap-2.5 hover:bg-secondery p-2 px-2.5 rounded-md ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                    </svg>
                                    My Dashboard
                                </div>
                            </a>
                            <a href="{{ route('profile') }}">
                                <div
                                    class="flex items-center gap-2.5 hover:bg-secondery p-2 px-2.5 rounded-md ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    My Account
                                </div>
                            </a>
                            <hr class="-mx-2 my-2 ">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <div class="flex items-center gap-2.5 hover:bg-secondery p-2 px-2.5 rounded-md "
                                    style="display: flex;column-gap: 12px;">
                                    <button type="submit" style="display:flex; column-gap:15px;">
                                        <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Log Out
                                    </button>
                                </div>
                            </form>
                        </nav>
                    </div>
                    @else
                    


                    <div class="">
                        <a href="{{ route('user.login') }}" class="header-widget header-user">
                            <img loading="eager"  src="{{ asset('assets/images/icons/user.png') }}" alt="user"
                                class="sm:w-9 sm:h-9 w-7 h-7 rounded-full shadow shrink-0">
                        </a>
                    </div>
                    @endif

                </div>
            </div>


        </div>

    </div>

</header>

<nav class="mobile-nav">
    <div class="container">
        <div class="mobile-group">

            <button type="button" class="mobile-widget back-btn" onclick="window.history.back()">
              <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 18l-6-6 6-6" />
              </svg>
              <span>Back</span>
            </button>

            <a href="{{ route ('adsList') }}" class="mobile-widget ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                </svg>
                <span>Market</span>
            </a>


            <a href="{{ asset ('/') }}" class="mobile-widget">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                </svg>
                <span>home</span>
            </a>

            <a href="{{ asset('ad-post/create') }}" class="mobile-widget ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                <span>Ad
                    Post</span>
            </a>

         <!--    <button class="mobile-widget  search-btn"
                onclick="document.getElementById('mobile-search-box').classList.toggle('hidden')">


                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>


                <span>Search</span>
            </button> -->

             <!-- <a href="https://eversabz.com/events/events-list" class="mobile-widget ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
  <path d="M19 4h-1V2h-2v2H8V2H6v2H5C3.9 4 3 4.9 3 6v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zm-7-8h5v5h-5z"/>
</svg>

                <span>Events</span>
            </a> -->


            <button id="menu-toggle1"
                class="flex items-center justify-center text-xl rounded-full hover:bg-gray-100 xl:hidden  group mobile-widget  search-btn">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 6h8M6 10h12M8 14h8M6 18h12" />
                </svg>

                <span>Menu</span>
            </button>
        </div>
    </div>
</nav>


<style>
#search--box {
    position: relative;

}

#searchSuggestionBox {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    margin-top: 6px;
    z-index: 9999;
    background: #fff;
    border: 1px solid #ccc;
    max-height: 300px;
    overflow-y: auto;
    padding: 10px 0;
    display: none;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

#mobileSearchSuggestionBox {
    position: relative;
    top: 100%;
    left: 0;
    right: 0;
    margin-top: 6px;
    z-index: 9999;
    background: #fff;
    border: 1px solid #ccc;
    max-height: 300px;
    overflow-y: auto;
    padding: 10px 0;
    display: none;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px){
    .container{
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }
}
</style>
<script>
function attachLiveSearch(inputId, suggestionBoxId) {
    const input = document.getElementById(inputId);
    const box = document.getElementById(suggestionBoxId);

    input.addEventListener('input', function() {
        const term = this.value.trim();

        if (term.length < 3) {
            box.style.display = 'none';
            return;
        }

        fetch(`{{ route('search.suggest') }}?search_term=${encodeURIComponent(term)}`)
            .then(res => res.text())
            .then(data => {
                box.innerHTML = data;
                box.style.display = 'block';
            })
            .catch(() => {
                box.style.display = 'none';
            });
    });

    document.addEventListener('click', function(e) {
        if (!input.closest('.relative').contains(e.target)) {
            box.style.display = 'none';
        }
    });
}

attachLiveSearch('liveSearchInput', 'searchSuggestionBox');
attachLiveSearch('mobileSearchInput', 'mobileSearchSuggestionBox');
</script>
