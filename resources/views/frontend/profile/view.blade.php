@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')


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
                     <h5>Name:</h5>
                     <p>{{ $user->name }}</p>
                  </li>
                  <li>
                     <h5>Email:</h5>
                     <p>{{ $user->email }}</p>
                  </li>
                  <li>
                     <h5>Phone:</h5>
                     <p>+{{ $user->phone }}</p>
                  </li>
                 
                  <li>
                     <h5>Company:</h5>
                     <p>{{ $user->userDetails->company }}</p>
                  </li>
                  
                  <li>
                     <h5>Website:</h5>
                     <p>
                        <a href="{{ $user->userDetails?->website }}" target="_blank">{{ $user->userDetails?->website }}</a>
                     </p>
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