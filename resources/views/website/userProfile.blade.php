@extends('frontend.template.master')

@section('content')

<section class="profile-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            
            <div class="account-card">
               <div class="account-title">
                  <h3>Contact Infooo</h3>
               </div>
               
               <ul class="account-card-list">
                
                  <li>
                     <h5>Name:</h5>
                     <p>{{ $user->name }}</p>
                  </li>
                  <li>
                     <h5>UserName:</h5>
                     <p>{{ $user->username }}</p>
                  </li>
                  <li>
                     <h5>Tagline:</h5>
                     <p>{{ $user->tagline }}</p>
                  </li>
                  <li>
                     <h5>Email:</h5>
                     <p>{{ $user->email }}</p>
                  </li>
                  <li>
                     <h5>Phone:</h5>
                     <p>{{ (!empty($user->phone )) ? "+".$user->phone : "-"}}</p>
                  </li>
                 
                  <li>
                     <h5>Address:</h5>
                     <p>{{ $user->address }}</p>
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