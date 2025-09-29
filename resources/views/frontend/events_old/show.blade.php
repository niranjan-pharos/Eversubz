@extends('frontend.template.master')

@section('content')

<link rel="stylesheet" href="{{ asset ('assets/css/custom/ad-details.css') }}">


<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>event details </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ '/'}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ asset('events') }}">Event List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Event Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="inner-section ad-details-part">
    <div class="container">
        <h1>{{ $event->title }}</h1>
        <p><strong>Host Name:</strong> {{ $event->host_name }}</p>
        <p><strong>About Host:</strong> {{ $event->about_host }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>
        <p><strong>Price:</strong> ${{ $event->price }}</p>
        <p><strong>Description:</strong> {{ $event->event_description }}</p>
        <p><strong>From Date:</strong> {{ $event->from_date }}</p>
        <p><strong>To Date:</strong> {{ $event->to_date }}</p>
        <p><strong>Refund Policy:</strong> {{ $event->refund_policy }}</p>
        <p><strong>Keywords:</strong> {{ $event->keywords }}</p>
        <p><strong>Facebook Link:</strong> <a href="{{ $event->facebook_link }}">{{ $event->facebook_link }}</a></p>
        <p><strong>LinkedIn Link:</strong> <a href="{{ $event->linkedin_link }}">{{ $event->linkedin_link }}</a></p>
        <p><strong>X Link:</strong> <a href="{{ $event->x_link }}">{{ $event->x_link }}</a></p>
        <p><strong>Video Link:</strong> <a href="{{ $event->video_link }}">{{ $event->video_link }}</a></p>
    
        <h2>Images</h2> 
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $event->main_image) }}" class="img-fluid" alt="Main Image">
            </div> 
            @foreach ($event->images as $image)
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid" alt="Additional Image">
            </div>
            @endforeach
        </div>
    </div>
</section> -->


<section class="inner-section ad-details-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="common-card">
                    <!-- <ol class="breadcrumb ad-details-breadcrumb">
                        <li><span class="flat-badge sale">for sale</span></li>
                        <li class="breadcrumb-item"><a href="#">Property</a></li>
                        <li class="breadcrumb-item active" aria-current="page">house</li>
                    </ol> -->
                    <h5 class="ad-details-address">{{ $event->location }}</h5>
                    <h3 class="ad-details-title">{{ $event->title }}</h3>
                    <div class="ad-details-meta"><a class="view"><i
                                class="fas fa-eye"></i><span><strong>(134)</strong>preview</span></a><a class="click"><i
                                class="fas fa-mouse"></i><span><strong>(76)</strong>click</span></a><a href="#review"
                            class="rating"><i class="fas fa-star"></i><span><strong>(29)</strong>review</span></a></div>
                    <div class="ad-details-slider-group">
                        <div class="ad-details-slider slider-arrow">


                            <div>
                                <img src="{{ $event->main_image ? asset('storage/' . $event->main_image) : asset('storage/images/avatar/01.jpg') }}"
                                    alt="{{ $event->title }}">
                            </div>

                        </div>
                        <!-- <div class="cross-vertical-badge ad-details-badge"><i
                                class="fas fa-clipboard-check"></i><span>recommend</span></div> -->
                    </div>
                    <div class="ad-thumb-slider">
                        @foreach ($event->images as $image)

                        <div>
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="details">
                        </div>
                        @endforeach

                    </div>
                    <!-- <div class="ad-details-action"><button type="button" class="wish"><i
                                class="fas fa-heart"></i>bookmark</button><button type="button"><i
                                class="fas fa-exclamation-triangle"></i>report</button><button type="button"
                            data-toggle="modal" data-target="#ad-share"><i class="fas fa-share-alt"></i>share
                        </button></div> -->
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Specification</h5>
                    </div>
                    <ul class="ad-details-specific">
                        @php
                        use Carbon\Carbon;
                        $fromDateTime = Carbon::parse($event->from_date_time);
                        $toDateTime = Carbon::parse($event->to_date_time);
                        @endphp
                        <li>
                            <h6>Event Duration:</h6>
                            <p>{{ $fromDateTime->format('D jS M Y, h:i a') }} - {{ $toDateTime->format('h:i a T') }}
                            </p>
                        </li>
                        <li>
                            <h6>price:</h6>
                            <p>
                                @if ($event->price == 0 || $event->price == 0.00)
                                Free
                                @else
                                ${{ number_format($event->price, 2) }}
                                @endif
                            </p>
                        </li>
                        <li>
                            <h6>location:</h6>
                            <p>{{ $event->location }}</p>
                        </li>
                        <li>
                            <h6>City:</h6>
                            <p>{{ $event->city }}</p>
                        </li>
                        <li>
                            <h6>State:</h6>
                            <p>{{ $event->state }}</p>
                        </li>
                        <li>
                            <h6>country:</h6>
                            <p>{{ $event->country }}</p>
                        </li>
                        <li>
                            <h6>keywords:</h6>
                            <p>{{ $event->keywords }}</p>
                        </li>
                        <li>
                            <h6>event URL:</h6>
                            <p>{{ $event->copy_event_url }}</p>
                        </li>
                        <li>
                            <h6>Facebook Link:</h6>
                            <p>{{ $event->facebook_link }}</p>
                        </li>
                        <li>
                            <h6>LinkedIn Link:</h6>
                            <p>{{ $event->linkedin_link }}</p>
                        </li>
                        <li>
                            <h6>X Link:</h6>
                            <p>{{ $event->x_link }}</p>
                        </li>
                        <li>
                            <h6>Video Link:</h6>
                            <p>{{ $event->video_link }}</p>
                        </li>
                    </ul>
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">About Host</h5>
                    </div>
                    <p class="ad-details-desc">{{ $event->about_host }}</p>
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">description</h5>
                    </div>
                    <p class="ad-details-desc">{{ $event->event_description }}</p>
                </div>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Refund Policy</h5>
                    </div>
                    <p class="ad-details-desc">{{ $event->refund_policy }}</p>
                </div>
                <div class="common-card d-none" id="review">
                    <div class="card-header">
                        <h5 class="card-title">reviews (2)</h5>
                    </div>
                    <div class="ad-details-review">
                        <ul class="review-list">
                            <li class="review-item">
                                <div class="review-user">
                                    <div class="review-head">
                                        <div class="review-profile"><a href="#" class="review-avatar"><img
                                                    src="images/avatar/03.jpg" alt="review"></a>
                                            <div class="review-meta">
                                                <h6><a href="#">miron mahmud -</a><span>June 02, 2020</span></h6>
                                                <ul>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li>
                                                        <h5>- for delivery system</h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit
                                        Non quibusdam harum ipsum dolor cumque quas magni voluptatibus cupiditate
                                        minima quis.</p>
                                </div>
                            </li>
                            <li class="review-item">
                                <div class="review-user">
                                    <div class="review-head">
                                        <div class="review-profile"><a href="#" class="review-avatar"><img
                                                    src="images/avatar/02.jpg" alt="review"></a>
                                            <div class="review-meta">
                                                <h6><a href="#">labonno khan -</a><span>June 02, 2020</span></h6>
                                                <ul>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star active"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li>
                                                        <h5>- for product quality</h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit
                                        Non quibusdam harum ipsum dolor cumque quas magni voluptatibus cupiditate
                                        minima quis.</p>
                                </div>
                                <div class="review-author">
                                    <div class="review-head">
                                        <div class="review-profile"><a href="#" class="review-avatar"><img
                                                    src="images/avatar/04.jpg" alt="review"></a>
                                            <div class="review-meta">
                                                <h6><a href="#">Miron Mahmud</a></h6>
                                                <h6>Author - <span>June 02, 2020</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit
                                        Non quibusdam harum ipsum dolor cumque quas magni voluptatibus cupiditate
                                        minima.</p>
                                </div>
                            </li>
                        </ul>
                        <form class="review-form">
                            <div class="star-rating"><input type="radio" name="rating" id="star-1"><label
                                    for="star-1"></label><input type="radio" name="rating" id="star-2"><label
                                    for="star-2"></label><input type="radio" name="rating" id="star-3"><label
                                    for="star-3"></label><input type="radio" name="rating" id="star-4"><label
                                    for="star-4"></label><input type="radio" name="rating" id="star-5"><label
                                    for="star-5"></label></div>
                            <div class="review-form-grid">
                                <div class="form-group"><input type="text" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group"><input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group"><select class="form-control custom-select">
                                        <option selected>Qoute</option>
                                        <option value="1">delivery system</option>
                                        <option value="2">product quality</option>
                                        <option value="3">payment issue</option>
                                    </select></div>
                            </div>
                            <div class="form-group"><textarea class="form-control" placeholder="Describe"></textarea>
                            </div><button type="submit" class="btn btn-inline review-submit"><i
                                    class="fas fa-tint"></i><span>drop your
                                    review</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="common-card price">
                    <h3>${{ $event->price }}<span></span></h3><i class="fas fa-tag"></i>
                </div><button type="button" class="common-card number" data-toggle="modal" data-target="#number">
                    <h3>(+880)<span>Click to show</span></h3><i class="fas fa-phone"></i>
                </button>
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">host info</h5>
                    </div>
                    <div class="ad-details-author"><img style="width:90px" class="rounded-circle" src="{{ 
                        ($event->user->image 
                                ? asset('storage/' . $event->user->image) 
                                : asset('storage/images/avatar/01.jpg')
                            ) 
                    }}" alt="{{ $event->title }}">
                        @php
                        switch (Auth::user()->account_type) {
                            case '1':
                                $profile_url = (Auth::user()->status == '1' && Auth::user()->is_admin_approved == '1') ? 'seller.profile' : 'user.profile';
                                break;
                            case '2':
                                $profile_url = (Auth::user()->status == '1' && Auth::user()->is_admin_approved == '1') ? 'ngo.profile' : 'user.profile';
                                break;
                            default:
                                $profile_url = 'user.profile';
                                break;
                        }
                        $name = Auth::user()->name;
                    
                        $encryptedId = Crypt::encrypt(Auth::user()->id);
                    @endphp
                    
                    

                        <div class="author-meta">
                            <h4>{{ ($event->host_name) ? $event->host_name : $event->user->name }}</h4>
                            <h5>joined: {{ \Carbon\Carbon::parse($event->user->created_at)->format('F d, Y') }}</h5>
                            <p>{{ $event->location }}</p>
                        </div>
                        <div class="author-widget">
                            <a href="{{ route($profile_url, ['id' => $encryptedId]) }}" title="{{ $name }}Profile"
                                class="fas fa-eye"></a>
                            <button type="button" title="Number" class="fas fa-phone" data-toggle="modal"
                                data-target="#number"></button>
                            <button type="button" title="Share" class="fas fa-share-alt" data-toggle="modal"
                                data-target="#profile-share"></button>
                        </div>
                        <ul class="author-list">
                            <li>
                                <h6>total ads</h6>
                                <p>134</p>
                            </li>
                            <li>
                                <h6>total ratings</h6>
                                <p>78</p>
                            </li>
                            <li>
                                <h6>total follower</h6>
                                <p>56</p>
                            </li>
                        </ul>
                    </div>
                </div>
                @php $eventAddress = $event->city; @endphp
                @if(!empty($eventAddress))
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Map Area</h5>
                    </div>
                    @if(!empty($eventAddress ))
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    @endif
                </div>
                @endif
                <div class="common-card d-none">
                    <div class="card-header">
                        <h5 class="card-title">safety tips</h5>
                    </div>
                    <div class="ad-details-safety">
                        <p>Check the item before you buy</p>
                        <p>Pay only after collecting item</p>
                        <p>Beware of unrealistic offers</p>
                        <p>Meet seller at a safe location</p>
                        <p>Do not make an abrupt decision</p>
                        <p>Be honest with the ad you post</p>
                    </div>
                </div>
                <div class="common-card d-none">
                    <div class="card-header">
                        <h5 class="card-title">featured ads</h5>
                    </div>
                    <div class="ad-details-feature slider-arrow">
                        <div class="feature-card"><a href="#" class="feature-img"><img src="images/product/10.jpg"
                                    alt="feature"></a>
                            <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                    class="fas fa-book-open"></i></div><button type="button" class="feature-wish"><i
                                    class="fas fa-heart"></i></button>
                            <div class="feature-content">
                                <ol class="breadcrumb feature-category">
                                    <li><span class="flat-badge rent">rent</span></li>
                                    <li class="breadcrumb-item"><a href="#">automobile</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">private car</li>
                                </ol>
                                <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                        nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                <div class="feature-meta"><span
                                        class="feature-price">$1200<small>/Monthly</small></span><span
                                        class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                            </div>
                        </div>
                        <div class="feature-card"><a href="#" class="feature-img"><img src="images/product/01.jpg"
                                    alt="feature"></a>
                            <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                    class="fas fa-book-open"></i></div><button type="button" class="feature-wish"><i
                                    class="fas fa-heart"></i></button>
                            <div class="feature-content">
                                <ol class="breadcrumb feature-category">
                                    <li><span class="flat-badge booking">booking</span></li>
                                    <li class="breadcrumb-item"><a href="#">Property</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">House</li>
                                </ol>
                                <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                        nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                <div class="feature-meta"><span
                                        class="feature-price">$800<small>/perday</small></span><span
                                        class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                            </div>
                        </div>
                        <div class="feature-card"><a href="#" class="feature-img"><img src="images/product/08.jpg"
                                    alt="feature"></a>
                            <div class="cross-inline-badge feature-badge"><span>featured</span><i
                                    class="fas fa-book-open"></i></div><button type="button" class="feature-wish"><i
                                    class="fas fa-heart"></i></button>
                            <div class="feature-content">
                                <ol class="breadcrumb feature-category">
                                    <li><span class="flat-badge sale">sale</span></li>
                                    <li class="breadcrumb-item"><a href="#">gadget</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">iphone</li>
                                </ol>
                                <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                                        nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                                <div class="feature-meta"><span
                                        class="feature-price">$1150<small>/Negotiable</small></span><span
                                        class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="ad-share">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Share this Ad</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share"><a href="#"><i
                            class="facebook fab fa-facebook-f"></i><span>facebook</span></a><a href="#"><i
                            class="twitter fab fa-twitter"></i><span>twitter</span></a><a href="#"><i
                            class="linkedin fab fa-linkedin"></i><span>linkedin</span></a><a href="#"><i
                            class="link fas fa-link"></i><span>copy link</span></a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="profile-share">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Share this Profile</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-share"><a href="#"><i
                            class="facebook fab fa-facebook-f"></i><span>facebook</span></a><a href="#"><i
                            class="twitter fab fa-twitter"></i><span>twitter</span></a><a href="#"><i
                            class="linkedin fab fa-linkedin"></i><span>linkedin</span></a><a href="#"><i
                            class="link fas fa-link"></i><span>copy link</span></a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="number">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Contact this Number</h4><button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h3 class="modal-number">(+880) 183 - 8288 - 389</h3>
            </div>
        </div>
    </div>
</div>

<style>
.ad-details-specific {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(1, 1fr);
    grid-template-rows: auto;
}

.ad-thumb1 {}

.ad-thumb1 div {
    height: 400px;
    width: 670px;
}

.ad-thumb1 div img {
    height: 100%;
    margin: auto;
    justify-content: center;
    display: flex;
    width: 100%;
    object-fit: contain;
}

.ad-thumb {
    display: flex;
    margin: 15px 0px;
}

.ad-thumb div {
    height: 200px;
    width: 250px;
}

.ad-thumb div img {
    height: 100%;
    width: 100%;
    object-fit: contain;
}

.ad-details-specific li p {
    text-align: right;
}
</style>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initMap"
    async defer></script>

<script>
var eventAddress = {
    !!json_encode($eventAddress) !!
};

function initMap() {
    var geocoder = new google.maps.Geocoder();
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15, // Set the zoom level as needed
        center: {
            lat: -34.397,
            lng: 150.644
        }
    });

    geocoder.geocode({
        'address': eventAddress
    }, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);

            // Create a marker at the geocoded location
            new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });

            // Get the panorama object
            var panorama = new google.maps.StreetViewPanorama(
                document.getElementById('street-view'), {
                    position: results[0].geometry.location,
                    pov: {
                        heading: 34,
                        pitch: 10
                    }
                });
            map.setStreetView(panorama);
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>

@endsection