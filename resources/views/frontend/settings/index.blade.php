@extends('frontend.template.master')
@section('title',  "basic Info")

@section('content')
@include('frontend.template.usermenu')

<style>
 .dash-avatar a img{width:175px;border-radius:50%;border:3px solid #fff;height:175px}
</style>
<section class="setting-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="account-card alert fade show">
               <div class="account-title">
                  <h3>Edit Basic Info</h3>
               </div>

               <form id="basicInfoForm" class="setting-form" enctype="multipart/form-data">
                @csrf
                @method('patch')
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group dash-avatar">
                              <a href="{{ asset('storage/' . $user->image) }}">

                                    @if ($user->image) 

                                       <img loading="eager" src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="rounded-circle profile-image">
                                
                                       </a>
                                       @else
                                       <img loading="eager" src="{{ asset('assets/images/no-image.jpg') }}" alt="Default Image" class="rounded-circle profile-image">
                                    @endif

                              </div> 
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group"><label class="form-label">Profile Image</label><input type="file"
                                    class="form-control" name="profile_image"></div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Name</label><input type="text"
                              class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Username</label><input type="text"
                              class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Phone</label><input type="number"
                              class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Email</label><input type="email"
                              class="form-control" id="email" name="email" disabled readonly value="{{ $user->email }}"></div>
                     </div>

                     <div class="col-lg-12"><button class="btn btn-inline"><i class="fas fa-user-check"></i><span>update
                              profile</span></button></div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>



<script>
   $(document).ready(function(){$('#basicInfoForm').on('submit',function(e){e.preventDefault();var formData=new FormData(this);formData.append('_method','PATCH');$.ajax({url:"{{ route('basicInfo.update') }}",type:"POST",data:formData,contentType:!1,processData:!1,success:function(response){toastr.success(response.message);if(response.imageUrl){$(".profile-image").attr("src",response.imageUrl);$(".dash-avatar a").attr("href",response.imageUrl)}
if(response.name){$("#name").text(response.name)}
if(response.username){$("#username").text(response.username)}
if(response.phone){$("#phone").text(response.phone)}},error:function(xhr){var message=xhr.responseJSON.message||'An error occurred. Please try again.';toastr.error(message);if(xhr.responseJSON.errors){$.each(xhr.responseJSON.errors,function(key,error){toastr.error(error[0])})}}})})})

</script>
@endsection