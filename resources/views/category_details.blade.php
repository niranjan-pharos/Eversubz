@extends('frontend.template.master')

@section('content')
    <section class="inner-section single-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>category details</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('category-list')}}">category-list</a></li>
                            <li class="breadcrumb-item active" aria-current="page">category-details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="inner-section ad-list-part">
        <div class="container">
            <div class="row ">
                <div class="col-lg-4 col-xl-3">
                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by Price</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-group"><input type="text" placeholder="min - 00"><input
                                            type="text" placeholder="max - 1B"></div><button type="submit"
                                        class="product-widget-btn"><i
                                            class="fas fa-search"></i><span>search</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by types</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek1">
                                            </div><label class="product-widget-label" for="chcek1"><span
                                                    class="product-widget-type sale">sales</span><span
                                                    class="product-widget-number">(15)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek2">
                                            </div><label class="product-widget-label" for="chcek2"><span
                                                    class="product-widget-type rent">rental</span><span
                                                    class="product-widget-number">(25)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek3">
                                            </div><label class="product-widget-label" for="chcek3"><span
                                                    class="product-widget-type booking">booking</span><span
                                                    class="product-widget-number">(35)</span></label>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by rating</h6>
                                <form class="product-widget-form">
                                    <ul class="product-widget-list">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek4">
                                            </div><label class="product-widget-label" for="chcek4"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i></span><span
                                                    class="product-widget-number">(45)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek5">
                                            </div><label class="product-widget-label" for="chcek5"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(55)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek6">
                                            </div><label class="product-widget-label" for="chcek6"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(65)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek7">
                                            </div><label class="product-widget-label" for="chcek7"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="fas fa-star"></i><i class="far fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(75)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek8">
                                            </div><label class="product-widget-label" for="chcek8"><span
                                                    class="product-widget-star"><i class="fas fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i><i
                                                        class="far fa-star"></i><i class="far fa-star"></i></span><span
                                                    class="product-widget-number">(85)</span></label>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by cities</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search"><input type="text" placeholder="Search"></div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek9">
                                            </div><label class="product-widget-label" for="chcek9"><span
                                                    class="product-widget-text">Los Angeles</span><span
                                                    class="product-widget-number">(95)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek10">
                                            </div><label class="product-widget-label" for="chcek10"><span
                                                    class="product-widget-text">San Francisco</span><span
                                                    class="product-widget-number">(82)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek11">
                                            </div><label class="product-widget-label" for="chcek11"><span
                                                    class="product-widget-text">California</span><span
                                                    class="product-widget-number">(1t)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek12">
                                            </div><label class="product-widget-label" for="chcek12"><span
                                                    class="product-widget-text">Manhattan</span><span
                                                    class="product-widget-number">(46)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek13">
                                            </div><label class="product-widget-label" for="chcek13"><span
                                                    class="product-widget-text">Baltimore</span><span
                                                    class="product-widget-number">(24)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek14">
                                            </div><label class="product-widget-label" for="chcek14"><span
                                                    class="product-widget-text">Avocados</span><span
                                                    class="product-widget-number">(34)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek15">
                                            </div><label class="product-widget-label" for="chcek15"><span
                                                    class="product-widget-text">new york</span><span
                                                    class="product-widget-number">(82)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek16">
                                            </div><label class="product-widget-label" for="chcek16"><span
                                                    class="product-widget-text">Houston</span><span
                                                    class="product-widget-number">(45)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek17">
                                            </div><label class="product-widget-label" for="chcek17"><span
                                                    class="product-widget-text">Chicago</span><span
                                                    class="product-widget-number">(19)</span></label>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">Filter by popularity</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search"><input type="text" placeholder="Search"></div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek9">
                                            </div><label class="product-widget-label" for="chcek9"><span
                                                    class="product-widget-text">laptop</span><span
                                                    class="product-widget-number">(68)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek10">
                                            </div><label class="product-widget-label" for="chcek10"><span
                                                    class="product-widget-text">camera</span><span
                                                    class="product-widget-number">(78)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek11">
                                            </div><label class="product-widget-label" for="chcek11"><span
                                                    class="product-widget-text">television</span><span
                                                    class="product-widget-number">(34)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek12">
                                            </div><label class="product-widget-label" for="chcek12"><span
                                                    class="product-widget-text">by cycle</span><span
                                                    class="product-widget-number">(43)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek13">
                                            </div><label class="product-widget-label" for="chcek13"><span
                                                    class="product-widget-text">bike</span><span
                                                    class="product-widget-number">(57)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek14">
                                            </div><label class="product-widget-label" for="chcek14"><span
                                                    class="product-widget-text">private car</span><span
                                                    class="product-widget-number">(67)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek15">
                                            </div><label class="product-widget-label" for="chcek15"><span
                                                    class="product-widget-text">air condition</span><span
                                                    class="product-widget-number">(98)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek16">
                                            </div><label class="product-widget-label" for="chcek16"><span
                                                    class="product-widget-text">apartment</span><span
                                                    class="product-widget-number">(45)</span></label>
                                        </li>
                                        <li class="product-widget-item">
                                            <div class="product-widget-checkbox"><input type="checkbox" id="chcek17">
                                            </div><label class="product-widget-label" for="chcek17"><span
                                                    class="product-widget-text">watch</span><span
                                                    class="product-widget-number">(76)</span></label>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="product-widget">
                                <h6 class="product-widget-title">filter by category</h6>
                                <form class="product-widget-form">
                                    <div class="product-widget-search"><input type="text" placeholder="search"></div>
                                    <ul class="product-widget-list product-widget-scroll">
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>electronics (234)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}mixer (56)

                                                {{-- </a> --}}
                                                </li>
                                                <li>{{-- <a href="#">--}}freez (78)
                                                    {{-- </a> --}}
                                                </li>
                                                <li>{{-- <a href="#">--}}LED tv (78)
                                                    {{-- </a> --}}
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>automobiles (767)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}private car (56)
                                                    {{-- </a> --}}</li>
                                                <li>{{-- <a href="#">--}}motorbike (78)
                                                    {{-- </a> --}}</li>
                                                <li>{{-- <a href="#">--}}truck (78)
                                                    {{-- </a> --}}</li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>properties (456)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}free land (56)
                                                    {{-- </a>--}}</li> 
                                                <li>{{-- <a href="#">--}}apartment (78)
                                                    {{-- </a>--}}</li>
                                                <li>{{-- <a href="#">--}}shop (78)
                                                    {{-- </a>--}}
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>fashion (356)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}jeans (56)
                                                    {{-- </a>--}}</li>
                                                <li>{{-- <a href="#">--}}t-shirt (78)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}jacket (78)
                                                    {{-- </a>--}}
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>gadgets (768)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}computer (56)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}mobile (78)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}drone (78)
                                                    {{-- </a>--}}
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>furnitures (977)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}chair (56)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}sofa (78)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}table (78)
                                                    {{-- </a>--}}
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>hospitality (124)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}jeans (56)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}t-shirt (78)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}jacket (78)
                                                    {{-- </a>--}}
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="product-widget-dropitem"><button type="button"
                                                class="product-widget-link"><i class="fas fa-tags"></i>agriculture (565)
                                            </button>
                                            <ul class="product-widget-dropdown">
                                                <li>{{-- <a href="#">--}}jeans (56)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}t-shirt (78)
                                                    {{-- </a>--}}
                                                </li>
                                                <li>{{-- <a href="#">--}}jacket (78)
                                                    {{-- </a>--}}
                                                </li>
                                            </ul>
                                        </li>
                                    </ul><button type="submit" class="product-widget-btn"><i
                                            class="fas fa-broom"></i><span>Clear Filter</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-filter">
                                <div class="filter-show"><label class="filter-label">Show :</label><select
                                        class="custom-select filter-select">
                                        <option value="1">12</option>
                                        <option value="2">24</option>
                                        <option value="3">36</option>
                                    </select></div>
                                <div class="filter-short"><label class="filter-label">Short by :</label><select
                                        class="custom-select filter-select">
                                        <option selected>default</option>
                                        <option value="3">trending</option>
                                        <option value="1">featured</option>
                                        <option value="2">recommend</option>
                                    </select></div>
                                {{-- <div class="filter-action"><a href="ad-list-column3.html" title="Three Column"><i
                                            class="fas fa-th"></i></a><a href="ad-list-column2.html"
                                        title="Two Column"><i class="fas fa-th-large"></i></a><a
                                        href="ad-list-column1.html" title="One Column"><i
                                            class="fas fa-th-list"></i></a></div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/07.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge booking">booking</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}Luxury
                                            {{-- </a>--}}
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">resort</li>
                                    </ol>
                                    {{-- <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$1590<span>/per week</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/08.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge sale">sale</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}gadget
                                            {{-- </a>--}}
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">mobile</li>
                                    </ol>
                                    {{-- <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$454<span>/fixed</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/09.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge sale">sale</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}animal
                                            {{-- </a>--}}
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">cat</li>
                                    </ol>
                                    {{-- <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$235<span>/Negotiable</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/10.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge rent">rent</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}automobile
                                            {{-- </a>--}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">private car</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$768<span>/per month</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/11.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge booking">booking</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}Luxury
                                            {{-- </a> --}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">Duplex house</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$1470<span>/per day</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/13.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge sale">sale</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}electronics</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">laptop</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$1550<span>/fixed</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/14.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge rent">rent</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}automobile
                                            {{-- </a> --}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">bike</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$90<span>/per hour</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/15.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge sale">sale</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}gadget
                                            {{-- </a> --}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">camera</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$1200<span>/Negotiable</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/16.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge booking">booking</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}luxury</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">ship</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$1200<span>/per day</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/02.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge sale">sale</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}fashion</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">shoes</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$578<span>/fixed</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/03.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge rent">rent</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}education
                                            {{-- </a> --}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">book</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$57<span>/per week</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/04.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge sale">sale</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}electronics
                                            {{-- </a> --}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">television</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$246<span>/Negotiable</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/05.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge sale">sale</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}gadgets
                                            {{-- </a> --}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">headphone</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$723<span>/fixed</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/06.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge rent">rent</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}automobiles
                                            {{-- </a>--}}</li> 
                                        <li class="breadcrumb-item active" aria-current="page">by cycle</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$35<span>/per hour</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product-card">
                                <div class="product-media">
                                    <div class="product-img"><img src="assets/images/product/01.jpg" alt="product"></div>
                                    <div class="product-type"><span class="flat-badge booking">booking</span></div>
                                    <ul class="product-action">
                                        <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                                        <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                        <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                                    </ul>
                                </div>
                                <div class="product-content">
                                    <ol class="breadcrumb product-category">
                                        <li><i class="fas fa-tags"></i></li>
                                        <li class="breadcrumb-item">{{-- <a href="#">--}}properties
                                            {{-- </a> --}}</li>
                                        <li class="breadcrumb-item active" aria-current="page">house</li>
                                    </ol>
                                    <h5 class="product-title"><a href="ad-details-left.html">Lorem ipsum dolor sit amet
                                            consect adipisicing elit</a></h5>
                                    <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Uttara,
                                            Dhaka</span><span><i class="fas fa-clock"></i>30 min ago</span></div>
                                    <div class="product-info">
                                        <h5 class="product-price">$234<span>/per month</span></h5>
                                        <div class="product-btn"><a href="compare.html" title="Compare"
                                                class="fas fa-compress"></a><button type="button" title="Wishlist"
                                                class="far fa-heart"></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-pagection">
                                <p class="page-info">Showing 12 of 60 Results</p>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" 
                                        {{-- href="#" --}}><i
                                                class="fas fa-long-arrow-alt-left"></i>
                                            {{-- </a> --}}</li>
                                    <li class="page-item"><a class="page-link active" 
                                        {{-- href="#" --}}>1
                                    {{-- </a> --}}</li>
                                        
                                    <li class="page-item"><a class="page-link" 
                                        {{-- href="#"</a> --}}>2</li>
                                    <li class="page-item"><a class="page-link" 
                                        {{-- href="#"--}}>3
                                    {{-- </a>  --}}</li>
                                    <li class="page-item">...</li>
                                    <li class="page-item"><a class="page-link" 
                                        {{-- href="#" --}}>67
                                    {{-- </a>--}}</li> 

                                    
                                    <li class="page-item"><a class="page-link" 
                                        {{-- href="#" --}}><i
                                                class="fas fa-long-arrow-alt-right"></i>
                                            {{-- </a> --}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
    