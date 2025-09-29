@extends('frontend.template.master')

@section('content')

<section class="profile-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            
            <div class="account-card">
               <div class="account-title">
                  <h3>Contact Info</h3>
                  <a href="javascript:void(0)">View</a>
               </div>
               
               <ul class="account-card-list">
                
                  <li>
                     <h5>Business Name:</h5>
                     <p>{{ $business->business_name }}</p>
                  </li>
                  <li>
                     <h5>Email:</h5>
                     <p>{{ $business->contact_email }}</p>
                  </li>
                  <li>
                     <h5>Phone:</h5>
                     <p>{{ (!empty($business->contact_phone )) ? "+".$business->contact_phone : "-"}}</p>
                  </li>
                 
                  
                 
               </ul>
            </div>
           
         </div>
        
      </div>
   </div>
</section>
<style>
   .form-group {
    margin-bottom: 10px;
}
.account-card {
    height: 330px;
}
</style>
@endsection