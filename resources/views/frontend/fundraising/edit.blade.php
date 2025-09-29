@extends('frontend.template.master')
@section('title', "ad campaign")

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

.btn-remove-image {
    padding: 5px !important
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
</style>

<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Create Fundraising Campaign</h3>
                    </div>
                    <form id="fundraisingForm" action="{{ route('fundraising.update', $fundraising->slug) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="slug" value="{{ $fundraising->slug }}">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $fundraising->title) }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="for">For</label>
                                    <input type="text" class="form-control" id="for" name="for"
                                        value="{{ old('for', $fundraising->for) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                        value="{{ old('amount', $fundraising->amount) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $fundraising->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        value="{{ old('location', $fundraising->location) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city', $fundraising->city) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        value="{{ old('state', $fundraising->state) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        value="{{ old('country', $fundraising->country) }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="fundraising_description">Description</label>
                                    <textarea class="form-control" id="fundraising_description"
                                        name="fundraising_description">{{ old('fundraising_description', $fundraising->fundraising_description) }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="facebook_link">Facebook Link</label>
                                    <input type="url" class="form-control" id="facebook_link" name="facebook_link"
                                        value="{{ old('facebook_link', $fundraising->facebook_link) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="linkedin_link">LinkedIn Link</label>
                                    <input type="url" class="form-control" id="linkedin_link" name="linkedin_link"
                                        value="{{ old('linkedin_link', $fundraising->linkedin_link) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="x_link">X Link</label>
                                    <input type="url" class="form-control" id="x_link" name="x_link"
                                        value="{{ old('x_link', $fundraising->x_link) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="copy_fundraising_url">Copy Fundraising URL</label>
                                    <input type="url" class="form-control" id="copy_fundraising_url"
                                        name="copy_fundraising_url"
                                        value="{{ old('copy_fundraising_url', $fundraising->copy_fundraising_url) }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="video_link">Video Link</label>
                                    <input type="url" class="form-control" id="video_link" name="video_link"
                                        value="{{ old('video_link', $fundraising->video_link) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="from_date_time">From Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="from_date_time"
                                        name="from_date_time"
                                        value="{{ old('from_date_time', $fundraising->from_date_time) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="to_date_time">To Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="to_date_time"
                                        name="to_date_time"
                                        value="{{ old('to_date_time', $fundraising->to_date_time) }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" class="form-control" id="main_image" name="main_image">

                                </div>
                                @if($fundraising->main_image)
                                <img src="{{ asset('storage/' . $fundraising->main_image) }}" alt="Main Image"
                                    width="100">
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="images">Additional Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                </div>
                                <div class="form-group ">
                                    <div id="existing-images" class="row">
                                        @foreach($fundraising->fundraisingImages as $image)
                                        <div class="image-container col-lg-4 col-6">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image"
                                                width="100">
                                            <button type="button" class="btn btn-danger btn-remove-image"
                                                data-image-id="{{ $image->id }}"><svg width="20px" height="20px"
                                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#FFFFFF">
                                                    </path>
                                                    <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z"
                                                        fill="#FFFFFF"></path>
                                                    <path
                                                        d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z"
                                                        fill="#FFFFFF"></path>
                                                </svg></button>
                                        </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="images_to_remove" id="images_to_remove">
                                </div>
                            </div>
                            <div class="col-lg-12">

                            </div>


                            @if(isset($ngoInfo))
                            <input type="hidden" name="ngo_id" value="{{ $ngoInfo->id }}">
                            @endif

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-inline" id="btnSubmit">Update Campaign</button>
                                <div id="loaderAddEvent" class="spinner-border text-primary" role="status"
                            style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                            </div>
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
    $('#fundraising_description').summernote({
        height: 150
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#category_id').select2({
        placeholder: '--- Search Category ---',
        allowClear: !0
    });
    let imagesToRemove = [];
    $('#existing-images').on('click', '.btn-remove-image', function() {
        const imageId = $(this).data('image-id');
        $(this).closest('.image-container').remove();
        imagesToRemove.push(imageId);
        $('#images_to_remove').val(imagesToRemove.join(','))
    });
    $('#fundraisingForm').on('submit', function(e) {
        e.preventDefault();
        $("#loaderAddEvent").show();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: !1,
            processData: !1,
            success: function(response) {
                toastr.success(response.success || 'Form submitted successfully!',
                    'Success');
                     $("#loaderAddEvent").hide();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = [];
                $.each(errors, function(key, value) {
                    errorMessages.push(value[0])
                });
                toastr.error(errorMessages.join('<br>') ||
                    'There was an error submitting the form.', 'Error')
            }
        })
    })
})
</script>
@endsection