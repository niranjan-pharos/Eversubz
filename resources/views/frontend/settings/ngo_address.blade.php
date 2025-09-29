@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
  .dash-avatar a img{width:175px;border-radius:50%;border:3px solid #fff;height:175px}
</style>
@endpush
<section class="setting-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="account-card alert fade show">
               <div class="account-title">
                  <h3>Edit NGO Address</h3>
               </div>

               <form id="ngoInfoForm" class="setting-form" >
                  @csrf
                  @method('patch')
                    <div class="row">

                     <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-label">Address</label><input type="text"
                            class="form-control" placeholder="Address" id="ngo_address" name="ngo_address"
                            value="{{ $ngoInfo->ngo_address }}">
                        </div>
                     </div>
                    
                    
                    <div class="col-lg-6">
                    <div class="form-group"><label class="form-label">City</label>
                    <input type="text"
                            class="form-control" placeholder="City" id="city-input" name="ngo_city"
                            value="{{ $ngoInfo->ngo_city }}"></div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">State</label>
                        <input type="text"
                                class="form-control" placeholder="State" id="state-input" name="ngo_state"
                                value="{{ $ngoInfo->ngo_state }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Country</label>
                        <input type="text"
                                class="form-control" placeholder="Country" id="country-input" name="ngo_country"
                                value="{{ $ngoInfo->ngo_country }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Phone</label>
                        <input type="text"
                                class="form-control" placeholder="Phone" id="contact_phone" name="contact_phone"
                                value="{{ $ngoInfo->contact_phone }}">
                        </div>
                    </div>
                    

                     <div class="col-lg-12"><button class="btn btn-inline"><i class="fas fa-user-check"></i><span>update
                              NGO Info</span></button></div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

@push('scripts')

<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize">
</script>
<script>
   function initialize() {
       var cityInput = document.getElementById('city-input');
       var stateInput = document.getElementById('state-input');
       var countryInput = document.getElementById('country-input');
       var options = {
           componentRestrictions: {
               country: 'AU'
           },
           types: ['(cities)']
       };
       var autocomplete = new google.maps.places.Autocomplete(cityInput, options);
       autocomplete.addListener('place_changed', function() {
           var place = autocomplete.getPlace();
           var city = place.name;
           var state = '';
           var country = '';
           for (var i = 0; i < place.address_components.length; i++) {
               var component = place.address_components[i];
               if (component.types.includes('administrative_area_level_1')) {
                   state = component.long_name;
               } else if (component.types.includes('country')) {
                   country = component.long_name;
               }
           }
           cityInput.value = city;
           stateInput.value = state;
           countryInput.value = country;
       });
   }

   $(document).ready(function() {
       $('#ngoInfoForm').on('keydown', function(e) {
           if (e.key === 'Enter') {
               e.preventDefault();
           }
       });

       $('#ngoInfoForm').on('submit', function(e) {
           e.preventDefault();
           var formData = new FormData(this);
           formData.append('_method', 'PATCH');

           $.ajax({
               url: "{{ route('ngo.updateAddressInfo') }}",
               type: "POST",
               data: formData,
               contentType: false,
               processData: false,
               success: function(response) {
                   toastr.success(response.message);

                   if (response.ngo_address) {
                       $("#ngo_address").text(response.ngo_address);
                   }
                   if (response.ngo_city) {
                       $("#ngo_city").text(response.ngo_city);
                   }
                   if (response.ngo_state) {
                       $("#ngo_state").text(response.ngo_state);
                   }
                   if (response.ngo_country) {
                       $("#ngo_country").text(response.ngo_country);
                   }
                   if (response.contact_phone) {
                       $("#contact_phone").text(response.contact_phone);
                   }
               },
               error: function(xhr) {
                   var message = xhr.responseJSON.message || 'An error occurred. Please try again.';
                   toastr.error(message);

                   if (xhr.responseJSON.errors) {
                       $.each(xhr.responseJSON.errors, function(key, error) {
                           toastr.error(error[0]);
                       });
                   }
               }
           });
       });
   });
</script>


@endpush
@endsection