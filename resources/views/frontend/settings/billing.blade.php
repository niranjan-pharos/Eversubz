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
                        <h3>Edit Billing Info</h3>
                    </div>

                    <form id="billingInfoForm" class="setting-form">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <h4>Billing Address</h4>
                            <br>

                            <div class="col-lg-12">
                                <div class="form-group"><label class="form-label">Address</label>
                                    <input type="text" class="form-control" placeholder="Billing Address"
                                        id="billing_address" name="billing_address"
                                        value="{{ old('billing_address', optional($userDetail)->billing_address) }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"><label class="form-label">City</label><input type="text"
                                        class="form-control" placeholder="City" id="city-input" name="billing_city"
                                        value="{{ old('billing_city', optional($userDetail)->billing_city) }}"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"><label class="form-label">State</label><input type="text"
                                        class="form-control" placeholder="State" id="state-input" name="billing_state"
                                        value="{{ old('billing_state', optional($userDetail)->billing_state) }}"></div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group"><label class="form-label">Country</label><input type="text"
                                        class="form-control" placeholder="Country" id="country-input"
                                        name="billing_country"
                                        value="{{ old('billing_country', optional($userDetail)->billing_country) }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"><label class="form-label">Post Code</label><input type="text"
                                        class="form-control" placeholder="postcode" id="billing_postcode"
                                        name="billing_postcode"
                                        value="{{ old('billing_postcode', optional($userDetail)->billing_postcode) }}">
                                </div>
                            </div>

                            <div class="col-lg-12"><button class="btn btn-inline"><i
                                        class="fas fa-user-check"></i><span>update
                                        Billing Info</span></button>
                            </div>
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
    $('#billingInfoForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_method', 'PATCH');
        $.ajax({
            url: "{{ route('updateBillingInfo') }}",
            type: "POST",
            data: formData,
            contentType: !1,
            processData: !1,
            success: function(response) {
                toastr.success(response.message);
                if (response.billing_address) {
                    $("#billing_address").text(response.billing_address)
                }
                if (response.billing_city) {
                    $("#city-input").text(response.billing_city)
                }
                if (response.billing_state) {
                    $("#state-input").text(response.billing_state)
                }
                if (response.billing_postcode) {
                    $("#billing_postcode").text(response.billing_postcode)
                }
                if (response.billing_country) {
                    $("#country-input").text(response.billing_country)
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