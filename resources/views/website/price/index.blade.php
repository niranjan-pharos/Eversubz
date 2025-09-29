@extends('frontend.template.master')
@section('content')
<section class="inner-section single-banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="single-content">
               <h2>Eversabz Pricing </h2>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pricing</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Custom Styles -->
<style>
   .pricing-section {
   text-align: center;
   margin-bottom:80px;
       margin-top: -30px;
   }
   .btn-pricing,
   .nav-link {
   border-radius: 12px;
   padding: 12px 28px;
   font-weight: 600;
   margin: 5px;
   border: none;
   background-color: #fff;
   color: #222 !important;
   box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
   transition: background 0.2s, color 0.2s, box-shadow 0.2s;
   }
   .btn-pricing.active,
   .nav-link.active,
   .btn-pricing:focus {
   background-color: #00796b;
   color: #fff !important;
   box-shadow: 0 4px 16px rgba(0, 121, 107, 0.1);
   }
   .btn-pricing:hover,
   .nav-link:hover {
   background-color: #ff9800;
   color: #fff !important;
   }
   .card {
   border-radius: 18px;
/*   box-shadow: 0 4px 24px rgba(67, 160, 71, 0.08);*/
   border: none;
   margin-bottom: 24px;
   position: relative;
   overflow: hidden;
   padding:40px 0px 0px 0px;
   }
   .card::before {
   content: '';
   display: block;
   height: 6px;
   width: 100%;
   background: linear-gradient(90deg, #00796b 20%, #ff9800 100%);
   position: absolute;
   top: 0;
   left: 0;
   }
  .card h4 {
    color: #222222c7;
    font-weight: 700;
    margin-bottom: 12px;
    font-size: 30px;
}

.card p {
    color: #757575;
    font-size: 16px;
}
   /* Preserve custom styles even when Bootstrap adds .nav-link */
   .nav-tabs .btn-pricing.nav-link {
   border-radius: 12px;
   padding: 12px 28px;
   font-weight: 600;
   margin: 5px;
   border: none;
   background-color: #fff;
   color: #222 !important;
   box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
   transition: background 0.2s, color 0.2s, box-shadow 0.2s;
   }
   .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
   color: White !important;
   background-color: #2c54a4 !important;
   border-color: #dee2e6 #dee2e6 #fff;
   }
   .nav-tabs {
   border-bottom: none;
   }
   .nav-tabs li .nav-link:hover {
   background: var(--chalk);
   color: black !important;
   }
   .nav-tabs li .nav-link.active:hover{
   color: white !important;
   }
   .tab-pane {
   padding:0px !important;
   }
   .con{    max-width: 1200px; }
   .card-1{
        background: #f8f9fa;
    border-radius: 12px;
    padding: 30px;
        text-align: left;
min-height: 220px;
margin-bottom:20px;
   }
   .card-1 h6{
        font-size: 19px;
   }
   .card-1 .round{
    border: 1px solid #3e5aa4;
    padding: 0px 15px;
    border-radius: 27px;
    margin-top: 15px !important;
    font-size: 14px;
    margin-bottom: 16px;
    width: fit-content;
    background:white;
        color: #000000d1;
   }
   @media only screen and (max-width: 767px) {
.nav-tabs {
        flex-wrap: wrap;
                padding-right: 10px;
}
.pricing-section {
    text-align: center;
    margin-bottom: 80px;
    margin-top
}
.card-1 {
    margin-bottom: 25px;
}
.con {
    max-width: 100%;
}
  .card-1{
        text-align: left;
height: auto;
   }
   .ca
}

</style>

<section class="pricing-section">
   <div class="container con">
      <h5>Find the Right Fit</h5>
      <h2> Explore our plans<br/> See what suits you best</h2>
      <!-- Tab Navigation -->
      <ul class="nav nav-tabs justify-content-center my-4" role="tablist">
         <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#business-list" role="tab">Business Listing</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#subzfuture-camp" role="tab">Subzfuture Campaigns</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#market-place" role="tab">Market Place</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#events" role="tab">Events</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#business-products" role="tab">Business Products</a>
         </li>
      </ul>
      <!-- Tab Content -->
      <div class="tab-content">
         <div class="tab-pane fade show active" id="business-list" role="tabpanel">
            <div class="card bg-white ">
               <h4>Business Listing</h4>
               <div class="row g-3 mt-3">
                  <div class="col-md-6">
                     <div class="card-1">
                        <h6>Free</h6>
                        <p class="round">Listing & Platform Fees</p>
                        <p class="para">Sellers can post unlimited products or services on Eversabz with no listing or membership charges—completely free to use.</p>
                     </div>
                  </div>
                  <div class="col-md-6">
      <div class="card-1">
         <h6>24/7 Customer Support</h6>
         <p class="round">Support</p>
         <p class="para">
            Eversabz provides 24/7 customer support to help you at every step. 
            From posting ads to resolving buyer queries, connect anytime through chat, email, or phone.
         </p>
      </div>
   </div>
               </div>
            </div>
         </div>
         <div class="tab-pane fade" id="subzfuture-camp" role="tabpanel">
            <div class="card bg-white">
               <h4>Subzfuture Campaigns</h4>
               <div class="row g-3 mt-3">
   <div class="col-md-6">
      <div class="card-1">
         <h6> 2.91% + $0.30</h6>
         <p class="round">Transaction Fee</p>
         <p class="para">
            Eversabz is built around meaningful connections, not transactions. A small fee of 2.91% + $0.30 applies at checkout to cover secure payment processing. Support local businesses & drive positive social impact.
         </p>
      </div>
   </div>
   <div class="col-md-6">
      <div class="card-1">
         <h6>24/7 Customer Support</h6>
         <p class="round">Support</p>
         <p class="para">
            Eversabz provides 24/7 customer support to help you at every step. 
            From posting ads to resolving buyer queries, connect anytime through chat, email, or phone.
         </p>
      </div>
   </div>
</div>


            </div>
         </div>
         <div class="tab-pane fade" id="market-place" role="tabpanel">
            <div class="card bg-white">
               <h4>Market Place</h4>
               <div class="row g-3 mt-3">
  
   <div class="col-md-6">
      <div class="card-1">
         <h6>Access</h6>
         <p class="round">Free</p>
         <p class="para">Eversabz’s marketplace is completely free to use. Sellers can list unlimited products or services without any charges, and buyers can browse and connect with no fees involved.</p>
      </div>
   </div>
   <div class="col-md-6">
      <div class="card-1">
         <h6>Zero Platform Charges</h6>
         <p class="round">Free</p>
         <p class="para">Enjoy full access to all marketplace features without paying for membership, subscriptions, or usage fees.</p>
      </div>
   </div>
</div>

            </div>
         </div>
         <div class="tab-pane fade" id="events" role="tabpanel">
            <div class="card bg-white">
               <h4>Events</h4>
                <div class="row g-3 mt-3">
   <div class="col-md-6">
      <div class="card-1">
         <h6>Free</h6>
         <p class="round">Free Event  </p>
         <p class="para">
            All standard events on Eversabz are free to attend. Just register and be part of the experience without any entry fees or hidden charges.
         </p>
      </div>
   </div>

   <div class="col-md-6">
      <div class="card-1">
         <h6> 3% + $0.99 per ticket inclusive GST</h6>
         <p class="round">Private & Non-Charity Event Fee</p>
         <p class="para">
            A 3% service charge plus $0.99 GST applies to all private or non-charity events, including webinars, workshops, launches, and networking meets.
         </p>
      </div>
   </div>

   <div class="col-md-6">
      <div class="card-1">
         <h6> 2.5% + $0.50 GST</h6>
         <p class="round">Charity & Educational Events</p>
         <p class="para">
            Reduced fee for schools, colleges, or student groups. Applies to educational events like fairs and workshops, supporting learning while sustaining the platform.
         </p>
      </div>
   </div>

   <div class="col-md-6">
      <div class="card-1">
         <h6>24/7 Customer Support</h6>
         <p class="round">Support</p>
         <p class="para">
            24/7 support for all event hosts and attendees. Get help with event setup, registration, and issue resolution at any point in the journey.
         </p>
      </div>
   </div>
</div>


            </div>
         </div>
         <div class="tab-pane fade" id="business-products" role="tabpanel">
            <div class="card bg-white">
               <h4>Business Products</h4>
               <div class="row g-3 mt-3">
   <div class="col-md-6">
      <div class="card-1">
         <h6> 2.91% + $0.30</h6>
         <p class="round">Transaction Fee</p>
         <p class="para">
            A fee of 2.91% + $0.30 applies per product sale to cover secure payment processing and gateway charges.
         </p>
      </div>
   </div>

   <div class="col-md-6">
      <div class="card-1">
         <h6> 10% on Successful Sale</h6>
         <p class="round">Sales Fee</p>
         <p class="para">
            A 10% sales fee is applied only when a product is successfully sold. This supports Eversabz’s platform growth and ongoing services.
         </p>
      </div>
   </div>
</div>


            </div>
         </div>
      </div>
   </div>
</section>
@endsection