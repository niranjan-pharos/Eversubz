@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')


<style>
.dash-avatar a img {
    width: 175px;
    border-radius: 50%;
    border: 3px solid #fff;
    height: 175px
}
</style>
<section class="setting-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Edit Shipping Info</h3>
                    </div>

                    <form id="shippingInfoForm" class="setting-form">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <h4>Shipping Address</h4>
                            <br>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" placeholder="Billing Address"
                                        id="shipping_address" name="shipping_address"
                                        value="{{ old('shipping_address', $userDetail->shipping_address ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">City</label><input type="text" class="form-control"
                                        placeholder="City" id="city-input" name="shipping_city"
                                        value="{{ old('shipping_city', $userDetail->shipping_city ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" placeholder="State" id="state-input"
                                        name="shipping_state"
                                        value="{{ old('shipping_state', $userDetail->shipping_state ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" placeholder="Country" id="country-input"
                                        name="shipping_country"
                                        value="{{ old('shipping_country', $userDetail->shipping_country ?? '') }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group"><label class="form-label">Post Code</label><input type="text"
                                        class="form-control" placeholder="postcode" id="shipping_postcode"
                                        name="shipping_postcode"
                                        value="{{ old('shipping_postcode', $userDetail->shipping_postcode ?? '') }}">
                                </div>
                            </div>



                            <div class="col-lg-12"><button class="btn btn-inline"><i
                                        class="fas fa-user-check"></i><span>update
                                        Shipping Info</span></button></div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
    async defer></script>

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
        console.log(place);
        var city = place.name;
        var state = '';
        var country = '';
        for (var i = 0; i < place.address_components.length; i++) {
            var component = place.address_components[i];
            if (component.types.includes('administrative_area_level_1')) {
                state = component.long_name
            } else if (component.types.includes('country')) {
                country = component.long_name
            }
        }
        cityInput.value = city;
        stateInput.value = state;
        countryInput.value = country
    })
}
$(document).ready(function() {
    $('#shippingInfoForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_method', 'PATCH');
        $.ajax({
            url: "{{ route('updateShippingInfo') }}",
            type: "POST",
            data: formData,
            contentType: !1,
            processData: !1,
            success: function(response) {
                toastr.success(response.message);
                if (response.shipping_address) {
                    $("#shipping_address").text(response.shipping_address)
                }
                if (response.shipping_city) {
                    $("#city-input").text(response.shipping_city)
                }
                if (response.shipping_state) {
                    $("#state-input").text(response.shipping_state)
                }
                if (response.shipping_postcode) {
                    $("#shipping_postcode").text(response.shipping_postcode)
                }
                if (response.shipping_country) {
                    $("#country-input").text(response.shipping_country)
                }
            },
            error: function(xhr) {
                var message = xhr.responseJSON.message ||
                    'An error occurred. Please try again.';
                toastr.error(message);
                if (xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, error) {
                        toastr.error(error[0])
                    })
                }
            }
        })
    })
})
</script>
@endsection