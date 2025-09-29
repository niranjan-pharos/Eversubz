@extends('frontend.template.master')
@section('title',  "ad campaign")

@section('content')
@include('frontend.template.usermenu')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://eversabz.com/admin_assets/css/select2.min.css" async defer> 

<style>
.note-editor .note-toolbar {
    font-size: 14px
}

.note-editor .note-btn {
    padding: 5px 10px
}

.note-editor .note-btn i {
    font-size: 12px
}

form .btn {
    padding: 10px 30px 
}

.form-group label {
    font-weight: 700
}

textarea.form-control {
    height: 215px !important;
    padding: 15px 20px
}

.form-control {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #000;
    height: 40px !important;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    box-shadow: none ! IMPORTANT;
    border: 1px solid #00000040 !important
}

.form-control:focus {
    border-color: #00b6f552 !important;
    outline: none;
    box-shadow: none;
    color: #fff;
    background: #fff;
    border-color: var(--primary)
}

.form-control:focus {
    color: #000 !important
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 40px;
    padding-top: 5px
}
.select2-container {
    width: 100% !important;
}
</style>

<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Create Fundraising Campaign</h3>
                    </div>
                    <form id="fundraisingForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ngo_id" value="{{ $ngoInfo->id }}">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">Title<span>*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="for">For<span>*</span></label>
                                    <input type="text" class="form-control" id="for" name="for" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="amount">Goal Ammount</label>
                                    <input type="text" class="form-control" id="amount" name="amount">
                                </div>
                            </div>




                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="category_id">Category<span>*</span></label>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city">City<span>*</span></label>
                                    <input type="text" class="form-control" id="city-input" name="city" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="state">State<span>*</span></label>
                                    <input type="text" class="form-control" id="state-input" name="state" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country">Country<span>*</span></label>
                                    <input type="text" class="form-control" id="country-input" name="country" required>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="adDescription">Campaign Description</label>
                                    <textarea class="form-control" id="adDescription"
                                        name="fundraising_description"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="facebook_link">Facebook Link</label>
                                    <input type="url" class="form-control" id="facebook_link" name="facebook_link">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="linkedin_link">LinkedIn Link</label>
                                    <input type="url" class="form-control" id="linkedin_link" name="linkedin_link">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="x_link">X Link</label>
                                    <input type="url" class="form-control" id="x_link" name="x_link">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="copy_fundraising_url">Campaign URL</label>
                                    <input type="url" class="form-control" id="copy_fundraising_url"
                                        name="copy_fundraising_url">
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="video_link">Video Link</label>
                                    <input type="url" class="form-control" id="video_link" name="video_link">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="from_date">From Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="from_date"
                                        name="from_date_time">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="to_date">To Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="to_date" name="to_date_time">
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" class="form-control" id="main_image" name="main_image">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="images">Additional Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('fundraising.index') }}" class="btn btn-default">Back</a>
                        <button type="submit" id="btnSubmit" class="btn btn-inline">Create Campaign</button>
                        <div id="loaderAddEvent" class="spinner-border text-primary" role="status"
                            style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
    async defer></script>





<script>
function initialize() {
    var cityInput = document.getElementById('city-input');
    var stateInput = document.getElementById('state-input');
    var countryInput = document.getElementById('country-input');
    var options = {
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
    $('#adDescription').summernote({
        height: 150
    });
    var base_url = "{{ url('/') }}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#category_id').select2({
        placeholder: '--- Search Category ---',
        allowClear: !0,
        ajax: {
            url: '{{ route("api.fundraising-categories") }}',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term
                }
            },
            processResults: function(data) {
                return {
                    results: $.map(data.categories, function(item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                }
            },
            cache: !0
        }
    });
    $('#fundraisingForm').on('submit', function(e) {
        e.preventDefault();
        $("#loaderAddEvent").show();
        $("#btnSubmit").prop('disabled', !0);
        let formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route('fundraising.create') }}',
            data: formData,
            contentType: !1,
            processData: !1,
            success: function(response) {
                toastr.success(response.success);
                $('#fundraisingForm')[0].reset();
                $("#loaderAddEvent").hide();
                $("#btnSubmit").prop('disabled', !1)
            },
            error: function(response) {
                if (response.status === 401) {
                    toastr.error('You need to login first.')
                } else {
                    let errors = response.responseJSON.errors;
                    for (let error in errors) {
                        toastr.error(errors[error][0])
                    }
                }
                $("#loaderAddEvent").hide();
                $("#btnSubmit").prop('disabled', !1)
            }
        })
    })
})
</script>
@endsection