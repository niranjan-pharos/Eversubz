@extends('frontend.template.master')

@section('content')


<link rel="stylesheet" href="{{ asset ('assets/css/custom/ad-details.css') }}">
<style>
 .breadcrumb-item+.breadcrumb-item::before{content:none}.ad-details-breadcrumb{margin-bottom:18px;position:inherit}
</style>
<section class="single-banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="single-content">
               <h2>Business product details </h2>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ asset('business-products') }}">Business List</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Business product detailss </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="inner-section ad-details-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-8">
            <div class="common-card">
               <ol class="breadcrumb ad-details-breadcrumb">
               @if(isset($post->ad_category))

                     @if (is_array($post->ad_category))
                        @foreach ($post->ad_category as $category)
                           <li class="breadcrumb-item"><span class="flat-badge {{ strtolower($category) }}">{{ trim($category) }}</span></li>
                        @endforeach
                     @else
                        <li class="breadcrumb-item"><span class="flat-badge {{ strtolower($post->ad_category) }}">{{ trim($post->ad_category) }}</span></li>
                     @endif
               @endif
               <li class="breadcrumb-item"><a href="#">{{ $post?->category->name }}</a></li>&nbsp; /
                <li class="breadcrumb-item active" aria-current="page">{{ $post?->subcategory->name }}</li>


               </ol>
               <h3 class="ad-details-title">{{ $post?->title }}</h3>
              
               <div class="ad-details-slider-group"> 
                  <div class="ad-details-slider slider-arrow">
                     @if(isset($post->main_image))                     
                     <div>
                        <img  loading="eager" src="{{ asset ('storage/'.$post->main_image) }}" alt="{{ $post->title }}">
                        
                     </div>
                     @endif
                  </div>
               </div>
               <div class="ad-details-action">
                  <button type="button" class="wish"><i
                        class="fas fa-heart"></i>bookmark</button>
                        <button type="button"><i
                        class="fas fa-exclamation-triangle"></i>report</button>
                        <button type="button" data-toggle="modal" data-target="#ad-share">
                           <i class="fas fa-share-alt"></i> share
                       </button>
               </div>
            </div>
            <div class="common-card">
               <div class="card-header">
                  <h5 class="card-title">Specification</h5>
               </div>
               
               <ul class="ad-details-specific">
                  <li>
                     <h6>price:</h6>
                     <p>{{ config('constants.CURRENCY_SYMBOL') }}{{ $post?->price }}</p>
                  </li>
                  <li>
                     <h6>published:</h6>
                     <p>{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</p>
                  </li>
                  <li>
                     <h6>category:</h6>
                     <p>{{ $post?->category->name }}</p>
                  </li>
                  <li>
                     <h6>subcategory:</h6>
                     <p>{{ $post?->subcategory->name }}</p>
                  </li>
                  
                  @if(!empty($post->video_url))
                  <li>
                     <h6>Video:</h6>
                     <p>{{ $post->video_url }}</p>
                  </li>
                  @endif
               </ul>
            </div>
            <div class="common-card">
               <div class="card-header">
                  <h5 class="card-title">description</h5>
               </div>
               <p class="ad-details-desc">{{$post?->description}}</p>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="common-card price">
               <h3>{{ config('constants.CURRENCY_SYMBOL') }}{{ $post?->price }}/</h3><i class="fas fa-tag"></i>
            </div>
                  @if(!empty($post->userBusinessInfos->contact_phone))
                     <a href="tel:{{ $post->userBusinessInfos->contact_phone }}" 
                       class="common-card number d-flex align-items-center justify-content-center text-decoration-none">
                        <h3 class="mb-0 text-center flex-grow-1">
                            {{ $post->userBusinessInfos->contact_phone }}
                        </h3>
                        <i class="fas fa-phone"></i>
                    </a>
                  @endif
            <div class="common-card">
               <div class="card-header">
                  <h5 class="card-title">Business info</h5>
               </div>
               
               <div class="ad-details-author">
                  @if (!empty($post->userBusinessInfos->logo_path))
                  <a href="javascript:void()" class="author-img active">
                     <img  loading="eager" src="{{ asset('storage/'.$post->userBusinessInfos->logo_path ) }}" alt="{{ $post->userBusinessInfos->business_name }}">
                  </a>
                  @else
                  <a href="javascript:void()" class="author-img active">
                     <img  loading="eager" src="{{ asset('storage/'.Auth::user()->image ) }}" alt="{{ Auth::user()->name }}">
                  </a>
                  @endif

                  <div class="author-meta">
                     <h4><a href="{{route('business.view',['businessInfo'=>$post->userBusinessInfos->slug])}}">{{ $post->userBusinessInfos->business_name }}</a></h4>
                     <h5>joined: {{ \Carbon\Carbon::parse($post->userBusinessInfos->created_at)->format('F d, Y') }}
                     </h5>
                     <p>{{ $post?->tagline }}</p>
                  </div> 
                  
                  <div class="author-widget"><a href="{{route('business.view',['businessInfo'=>$post->userBusinessInfos->slug])}}" title="Profile" class="fas fa-eye"></a><a
                        href="message.html" title="Message" class="fas fa-envelope"></a><button type="button"
                        title="Follow" class="follow fas fa-heart"></button><button type="button" title="Number"
                        class="fas fa-phone" data-toggle="modal" data-target="#number"></button>
                        <button type="button" title="Share" class="fas fa-share-alt" data-toggle="modal" data-target="#profile-share"></button>

                  </div>
                  
               </div>
            </div>
            
            @php $businessAddress = $post->userBusinessInfos->business_city; @endphp
           @if(!empty($businessAddress))
            <div class="common-card">
               <div class="card-header">
                  <h5 class="card-title">area map</h5>
               </div>
                  @if(!empty($businessAddress ))
                     <div id="map" style="width: 100%; height: 400px;"></div>
                  @endif
            </div>
            @endif
            <div class="common-card">
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
            <div class="common-card">
               <div class="card-header">
                  <h5 class="card-title">featured ads</h5>
               </div>
               <div class="ad-details-feature slider-arrow">
                  <div class="feature-card"><a href="#" class="feature-img"><img  loading="eager"
                           src="{{ asset ('assets/images/product/10.jpg') }}" alt="feature"></a>
                     <div class="cross-inline-badge feature-badge"><span>featured</span><i class="fas fa-book-open"></i>
                     </div><button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                     <div class="feature-content">
                        <ol class="breadcrumb feature-category">
                           <li><span class="flat-badge rent">rent</span></li>
                           <li class="breadcrumb-item"><a href="#">automobile</a></li>
                           <li class="breadcrumb-item active" aria-current="page">private car</li>
                        </ol>
                        <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                              nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                        <div class="feature-meta"><span class="feature-price">$1200<small>/Monthly</small></span><span
                              class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                     </div>
                  </div>
                  <div class="feature-card"><a href="#" class="feature-img"><img  loading="eager"
                           src="{{ asset ('assets/images/product/01.jpg') }}" alt="feature"></a>
                     <div class="cross-inline-badge feature-badge"><span>featured</span><i class="fas fa-book-open"></i>
                     </div><button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                     <div class="feature-content">
                        <ol class="breadcrumb feature-category">
                           <li><span class="flat-badge booking">booking</span></li>
                           <li class="breadcrumb-item"><a href="#">Property</a></li>
                           <li class="breadcrumb-item active" aria-current="page">House</li>
                        </ol>
                        <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                              nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                        <div class="feature-meta"><span class="feature-price">$800<small>/perday</small></span><span
                              class="feature-time"><i class="fas fa-clock"></i>56 minute ago</span></div>
                     </div>
                  </div>
                  <div class="feature-card"><a href="#" class="feature-img"><img  loading="eager"
                           src="{{ asset ('assets/images/product/08.jpg') }}" alt="feature"></a>
                     <div class="cross-inline-badge feature-badge"><span>featured</span><i class="fas fa-book-open"></i>
                     </div><button type="button" class="feature-wish"><i class="fas fa-heart"></i></button>
                     <div class="feature-content">
                        <ol class="breadcrumb feature-category">
                           <li><span class="flat-badge sale">sale</span></li>
                           <li class="breadcrumb-item"><a href="#">gadget</a></li>
                           <li class="breadcrumb-item active" aria-current="page">iphone</li>
                        </ol>
                        <h3 class="feature-title"><a href="ad-details-left.html">Unde eveniet ducimus
                              nostrum maiores soluta temporibus ipsum dolor sit amet.</a></h3>
                        <div class="feature-meta"><span
                              class="feature-price">$1150<small>/Negotiable</small></span><span class="feature-time"><i
                                 class="fas fa-clock"></i>56 minute ago</span></div>
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
            <h4>Share this Page</h4>
            <button class="fas fa-times" data-dismiss="modal"></button>
         </div>
         <div class="modal-body">
            @php
                $currentPageUrl = Request::fullUrl();
            @endphp
            <div class="modal-share">
               <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($currentPageUrl) }}" target="_blank">
                  <i class="facebook fab fa-facebook-f"></i><span>facebook</span>
               </a>
               <a href="https://twitter.com/intent/tweet?url={{ urlencode($currentPageUrl) }}" target="_blank">
                  <i class="twitter fab fa-twitter"></i><span>twitter</span>
               </a>
               <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($currentPageUrl) }}" target="_blank">
                  <i class="linkedin fab fa-linkedin"></i><span>linkedin</span>
               </a>
               <a href="javascript:void(0);" onclick="copyCurrentPageLink()">
                  <i class="link fas fa-link"></i><span>copy link</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- profile share --}}
<div class="modal fade" id="profile-share">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h4>Share this Profile</h4><button class="fas fa-times" data-dismiss="modal"></button>
         </div>
         <div class="modal-body">
            @php
                $profileUrl = route('business.view', ['businessInfo' => $post->businessInfo->slug]);
            @endphp
            <div class="modal-share">
               <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($profileUrl) }}" target="_blank">
                  <i class="facebook fab fa-facebook-f"></i><span>facebook</span>
               </a>
               <a href="https://twitter.com/intent/tweet?url={{ urlencode($profileUrl) }}" target="_blank">
                  <i class="twitter fab fa-twitter"></i><span>twitter</span>
               </a>
               <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($profileUrl) }}" target="_blank">
                  <i class="linkedin fab fa-linkedin"></i><span>linkedin</span>
               </a>
               <a href="javascript:void(0);" onclick="copyLink('{{ $profileUrl }}')">
                  <i class="link fas fa-link"></i><span>copy link</span>
               </a>
            </div>
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
            <h3 class="modal-number">({{ $post->userBusinessInfos->contact_phone }})</h3>
         </div>
      </div>
   </div>
</div>

@push('scripts')
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initMap"
async defer></script>

<script>
   var businessAddress={!!json_encode($businessAddress)!!};function initMap(){var geocoder=new google.maps.Geocoder();var map=new google.maps.Map(document.getElementById('map'),{zoom:15,center:{lat:-34.397,lng:150.644}});geocoder.geocode({'address':businessAddress},function(results,status){if(status==='OK'){map.setCenter(results[0].geometry.location);new google.maps.Marker({map:map,position:results[0].geometry.location});var panorama=new google.maps.StreetViewPanorama(document.getElementById('street-view'),{position:results[0].geometry.location,pov:{heading:34,pitch:10}});map.setStreetView(panorama)}else{console.log('Geocode was not successful for the following reason: '+status)}})}
 function copyLink(url){var dummy=document.createElement('input');document.body.appendChild(dummy);dummy.value=url;dummy.select();document.execCommand('copy');document.body.removeChild(dummy);alert('Link copied to clipboard')}
 function copyCurrentPageLink(){var dummy=document.createElement('input');var text=window.location.href;document.body.appendChild(dummy);dummy.value=text;dummy.select();document.execCommand('copy');document.body.removeChild(dummy);alert('Link copied to clipboard')}
    </script>
@endpush


@endsection