@extends('frontend.template.master')
@section('title', 'business info')

@section('content')
    @include('frontend.template.usermenu')
    @push('style')
        <link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
        <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
            rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
            rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <style>
            .ui-datepicker-calendar {
                display: none;
            }

            .ui-datepicker-month {
                display: none;
            }

            .ui-datepicker select.ui-datepicker-year {
                width: 100%;
            }

            .row1 {
                column-gap: 10px;
                padding: 0 8px 0 17px
            }

            .col-form-label {
                font-weight: 700
            }

            .row1 .form-group {
                width: 48%
            }

            textarea.form-control {
                height: 215px !important
            }

            .form-group {
                margin-bottom: 10px
            }

            .row1 .form-group1 {
                width: 97%
            }

            form .btn {
                padding: 10px;
            }

            .select2-container--default .select2-selection--multiple {
                border: 1px solid #dcdcdc;
                min-height: 40px !important
            }

            .select2-container--default .select2-selection--single {
                height: 40px
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: #444;
                line-height: 40px
            }

            .account-card {
                height: auto
            }

            .account-card1 {
                padding: 10px 0
            }

            .form-control {
                border: 1px solid #00000040 !important
            }

            .form-control:focus {
                border-color: #00b6f552 !important
            }

            .form-control:focus {
                color: #000 !important
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
                box-shadow: none ! IMPORTANT
            }

            .form-control:focus {
                outline: none;
                box-shadow: none;
                color: #fff;
                background: #fff;
                border-color: var(--primary)
            }

            .accordion {
                font-size: 20px;
                font-weight: 700;
                padding: 0 40px 25px
            }

            .accordion::before {
                position: absolute;
                content: "";
                top: 50px;
                left: 5%;
                width: 50px;
                height: 2px;
                background: var(--primary)
            }

            .accordion .panel {
                padding: 20px 40px;
                background-color: #fff;
                display: none;
                overflow: hidden
            }

            .info {
                background-color: #e7e7e796;
                padding: 10px;
                font-size: 14px;
                font-weight: 500;
                margin-bottom: .5rem
            }
            .nowrap-label {
                white-space: nowrap;
            }

            .note-editor .note-toolbar {
                font-size: 14px;
            }

            .note-editor .note-btn {
                padding: 3px 4px;
                font-size: 10px;
            }

            @media (max-width:767px) {
                .row1 .form-group {
                    width: 100%
                }

                .select2-container {
                    box-sizing: border-box;
                    width: 100% ! IMPORTANT;
                    display: inline-block;
                    margin: 0;
                    position: relative;
                    vertical-align: middle
                }

                .accordion::before {
                    position: absolute;
                    content: "";
                    top: 50px;
                    left: 14%;
                    width: 50px;
                    height: 2px;
                    background: var(--primary)
                }
            }
        </style>
    @endpush
    <section class="profile-part">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h3>Business Info</h3>
                        </div>


                        <form id="businessInfoForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="businessInfoId" name="id"
                                value="{{ optional($businessDetail)->id ? Crypt::encrypt(optional($businessDetail)->id) : '' }}">


                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="text-left info">Personel Info</h5>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Business Name :<sup
                                                class="text-danger">*</sup></label>
                                        <input class="form-control" type="text" required name="business_name"
                                            value="{{ old('business_name', optional($businessDetail)->business_name) }}">
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Category :<sup class="text-danger">*</sup></label>
                                        <select class="form-control required select2 business_category"
                                            name="business_category" id="business_category">
                                            @if (isset($selectedCategoryId) && $selectedCategoryId)
                                                <option value="{{ $selectedCategoryId }}" selected></option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Business email :<sup
                                                class="text-danger">*</sup></label>
                                        <input class="form-control" type="text" name="contact_email"
                                            value="{{ old('contact_email', optional($businessDetail)->contact_email) }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Establishment Year :</label>
                                        <input class="form-control yearpicker" type="text" name="establish_year"
                                            value="{{ old('establish_year', optional($businessDetail)->establish_year) }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group form-group1">
                                        <label class="col-form-label">Languages :</label>
                                        <select class="form-control add_multi_languages select2" id="languages"
                                            multiple="multiple" name="languages[]">
                                            @foreach ($allLanguages as $language)
                                                <option value="{{ $language->name }}"
                                                    @if (in_array($language->name, $selectedLanguages)) selected @endif>
                                                    {{ $language->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group form-group1">
                                        <label class="col-form-label">Deals In :</label>
                                        <select class="form-control add_multi_deals select2" id="deals"
                                            multiple="multiple" name="deals[]">
                                            @foreach ($deals as $deal)
                                                <option value="{{ $deal }}" selected>{{ $deal }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <h5 class="text-left info">Business Info :</h5>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="abn">ABN:</label>
                                        <input class="form-control" type="text" id="abn" name="abn"
                                            value="{{ old('abn', optional($businessDetail)->abn) }}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group form-group1">
                                        <label class="col-form-label">Description :</label>
                                        <textarea class="form-control" placeholder="Description" name="business_description" id="buss_description">{{ old('business_description', optional($businessDetail)->business_description) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h5 class="text-left info">Contact Info :</h5>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group form-group1">
                                        <label class="col-form-label">Business address :</label>
                                        <input type="text" name="business_address" placeholder="Address"
                                            class="form-control"
                                            value="{{ old('business_address', optional($businessDetail)->business_address) }}"
                                            id="address-input">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <div class="form-group">
                                        <label class="col-form-label">Business City :<sup
                                                class="text-danger">*</sup></label>
                                        <input type="text" name="business_city" placeholder="City"
                                            value="{{ old('business_city', optional($businessDetail)->business_city) }}"
                                            class="form-control" id="city-input">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <div class="form-group">
                                        <label class="col-form-label">Business State :</label>
                                        <input type="text" name="business_state" placeholder="State"
                                            class="form-control"
                                            value="{{ old('business_state', optional($businessDetail)->business_state) }}"
                                            id="state-input">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <div class="form-group">
                                        <label class="col-form-label">Business Country :</label>
                                        <input type="text" name="business_country" placeholder="Country"
                                            class="form-control"
                                            value="{{ old('business_country', optional($businessDetail)->business_country) }}"
                                            id="country-input">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <div class="form-group">
                                        <label class="col-form-label">Contact phone :</label>
                                        <input class="form-control" type="text" name="contact_phone"
                                                id="contact_phone"
                                                value="{{ old('contact_phone', optional($businessDetail)->contact_phone) }}"
                                                maxlength="20"
                                                pattern="\d{9,20}"
                                                title="Please enter 9 to 20 digits"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 20);">

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <div class="form-group">
                                        <label class="col-form-label">Website URL :</label>
                                        <input class="form-control" type="text" name="website_url"
                                            value="{{ old('website_url', optional($businessDetail)->website_url) }}">
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <h5 class="text-left info">Social Media Info</h5>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Facebook URL :</label>
                                        <input class="form-control" type="text" name="facebook_url"
                                            value="{{ old('facebook_url', optional($businessDetail)->facebook_url) }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Twitter URL :</label>
                                        <input class="form-control" type="text" name="twitter_url"
                                            value="{{ old('twitter_url', optional($businessDetail)->twitter_url) }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Instagram URL :</label>
                                        <input class="form-control" type="text" name="instagram_url"
                                            value="{{ old('instagram_url', optional($businessDetail)->instagram_url) }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Linkedin URL :</label>
                                        <input class="form-control" type="text" name="linkedin_url"
                                            value="{{ old('linkedin_url', optional($businessDetail)->linkedin_url) }}">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h5 class="text-left info">Social Media Info</h5>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group form-group1">
                                        <label class="col-form-label" for="logo">Business Logo:</label>
                                        <input class="form-control" type="file" id="logo" name="logo">
                                        @if (!empty($businessDetail->logo_path))
                                            <img loading="eager" src="{{ Storage::url($businessDetail->logo_path) }}"
                                                alt="{{ optional($businessDetail)->business_name }}"
                                                style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @endif
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group form-group1">
                                        <label class="col-form-label" for="other_images">Other Images:</label>
                                        <input class="form-control" type="file" id="other_images"
                                            name="other_images[]" multiple>

                                        @if (!empty($businessDetail->images))
                                            <div class="other-images-container row">
                                                @foreach ($businessDetail->images as $image)
                                                    <div class="col-sm-3 image-container"
                                                        data-image-id="{{ $image->id }}">
                                                        <img loading="eager" src="{{ Storage::url($image->image_path) }}"
                                                            alt="Other Image"
                                                            style="max-width: 150px; max-height: 150px; margin-top: 10px;">

                                                        <button type="button"
                                                            class="btn btn-danger btn-sm delete-image-btn"
                                                            data-image-id="{{ $image->id }}">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path
                                                                    d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path
                                                                    d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z"
                                                                    fill="#FFFFFF"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                

                                    <div class="col-sm-12">
                                        <h5 class="text-left info"><i class="fa fa-clock-o"></i> Opening Hour (Optional)</h5>
                                    </div>
                                    @php
                                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                    @endphp
                                    @foreach($days as $day)
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 col-form-label text-capitalize">{{ ucfirst($day) }}:</label>
                                        <div class="col-sm-3">
                                            <input 
                                                class="form-control timepicker"
                                                type="text"
                                                id="{{ $day }}_start"
                                                name="{{ $day }}_start"
                                                placeholder="Start Time"
                                                value="{{ old($day.'_start', $hours[$day]['start'] ?? '') }}"
                                                @if(old($day.'_24h', $hours[$day]['is_24h'] ?? false)) disabled @endif
                                            >
                                        </div>
                                        <div class="col-sm-3">
                                            <input 
                                                class="form-control timepicker"
                                                type="text"
                                                id="{{ $day }}_end"
                                                name="{{ $day }}_end"
                                                placeholder="End Time"
                                                value="{{ old($day.'_end', $hours[$day]['end'] ?? '') }}"
                                                @if(old($day.'_24h', $hours[$day]['is_24h'] ?? false)) disabled @endif
                                            >
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id="{{ $day }}_24h"
                                                    name="{{ $day }}_24h"
                                                    value="1"
                                                    {{ old($day.'_24h', $hours[$day]['is_24h'] ?? false) ? 'checked' : '' }}
                                                    onchange="toggleHourInputs('{{ $day }}')"
                                                >
                                                <label class="form-check-label nowrap-label" for="{{ $day }}_24h">Open 24 Hours</label>
                                            </div>
                                        </div>                                    
                                    </div>
                                    @endforeach
                                    
                                

                            </div>

                            </div>



                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <button type="button" id="submitForm" class="btn btn-primary mr-2">Update Info</button>
                                <button type="button" id="back" class="btn btn-default mr-2">Back</button>
                                <div id="loader" class="spinner-border text-primary ml-2" role="status" style="display: none;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
        <script src="{{ asset('admin_assets/js/select2.full.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
            < script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" >
        </script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
            async defer></script>
            <script>
                function toggleHourInputs(day) {
                    var isChecked = document.getElementById(day + '_24h').checked;
                    var startField = document.getElementById(day + '_start');
                    var endField = document.getElementById(day + '_end');

                    if (isChecked) {
                        startField.value = '';
                        endField.value = '';
                        startField.disabled = true;
                        endField.disabled = true;
                    } else {
                        startField.disabled = false;
                        endField.disabled = false;
                    }
                }

                document.getElementById('back').addEventListener('click', function() {
                    window.location.href = "{{ route('profile') }}";
                });

            </script>

        <script>
            $(document).on('click', '.delete-image-btn', function() {
                var imageId = $(this).data('image-id');
                var imageContainer = $(this).closest('.image-container');

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: '{{ route('business.info.delete.image') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            image_id: imageId
                        },
                        success: function(response) {
                            alert(response.message);

                            imageContainer.remove();
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });

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
                            state = component.long_name
                        } else if (component.types.includes('country')) {
                            country = component.long_name
                        }
                    }
                    cityInput.value = city;
                    stateInput.value = state;
                    countryInput.value = country
                });
                cityInput.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        return !1
                    }
                })
            }

            $(document).ready(function() {
                $('#buss_description').summernote({
                    height: 150
                });
                $('.yearpicker').datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    autoclose: true
                });




                $('.timepicker').timepicker({
                    timeFormat: 'hh:mm p',
                    controlType: 'select',
                    oneLine: true,
                    showButtonPanel: true,
                    closeText: 'Done',
                    onClose: function(dateText, inst) {
                        if (!dateText) {
                            var defaultTime = $(this).data('default-time') || '12:00 AM';
                            $(this).val(defaultTime);
                        }
                    }
                }).each(function() {
                    $(this).data('default-time', $(this).val());
                });


                $(".accordion").on("click", function() {
                    $(this).toggleClass("active");
                    $(this).next().slideToggle(200);
                });


                let selectedCategoryId = "{{ isset($selectedCategoryId) ? $selectedCategoryId : '' }}";
                $('.business_category').each(function() {
                    $(this).select2({
                        dropdownParent: $(this).parent(),
                        placeholder: '--- Search Business Category ---',
                        allowClear: true,
                        ajax: {
                            url: "{{ route('ajaxBusinessCategory') }}",
                            type: "post",
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    "_token": "{{ csrf_token() }}",
                                    searchTerm: params.term
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        }
                    });


                    if (selectedCategoryId) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('ajaxSearchBusinessCategoryById') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: selectedCategoryId
                            },
                            success: function(data) {
                                var option = new Option(data.text, data.id, true, true);
                                $('.business_category').append(option).trigger('change');
                            }
                        });
                    }
                });


                $(".add_multi_deals, .add_multi_languages").select2({
                    theme: 'bootstrap4',
                    tags: true,
                    tokenSeparators: [',', ' ']
                });




                $('#submitForm').click(function(e) {
                    e.preventDefault();

                    var form = $('#businessInfoForm')[0];
                    if (!form.checkValidity()) {
                        var invalidFields = $(form).find(':invalid');
                        invalidFields.each(function() {
                            console.log('Invalid field:', this.name, this.validationMessage);
                            toastr.error(`Error in field: ${this.name} - ${this.validationMessage}`);
                        });
                        return;
                    }

                    var formData = new FormData($('#businessInfoForm')[0]);
                    var businessId = $('#businessInfoId').val()?.trim();
                    var url = businessId ? "{{ route('business.info.update', '') }}/" + businessId :
                        "{{ route('business.info.store') }}";

                    $('#loader').show();
                    $('#submitForm').prop('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#loader').hide();
                            $('#submitForm').prop('disabled', false);

                            if (response.message) {
                                toastr.success(response.message);
                                if (!businessId) {
                                    $('#businessInfoId').val(response.business_id);
                                }
                            } else {
                                toastr.error('Something went wrong. Please try again.');
                            }
                        },
                        error: function(xhr) {
                            $('#loader').hide();
                            $('#submitForm').prop('disabled', false);

                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors || {};
                                $.each(errors, function(key, messages) {
                                    messages.forEach(function(message) {
                                        toastr.error(message);
                                    });
                                });
                            } else {
                                var errorMessage = xhr.responseJSON?.message ||
                                    'An unexpected error occurred. Please try again.';
                                toastr.error(errorMessage);
                            }
                        }
                    });
                });







                $('#submitHourForm').click(function(e) {
                    e.preventDefault();$('#submitForm').click(function(e) {
                    e.preventDefault();

                    var form = $('#businessInfoForm')[0];

                    $(form).find('.is-invalid').removeClass('is-invalid');

                    if (!form.checkValidity()) {
                        var invalidFields = $(form).find(':invalid');
                        invalidFields.each(function() {
                            toastr.error(`Error in field: ${this.name} - ${this.validationMessage}`);
                            $(this).addClass('is-invalid'); 
                        });
                        invalidFields.first()[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return;
                    }

                    var formData = new FormData(form);
                    var businessId = $('#businessInfoId').val()?.trim();
                    var url = businessId ? "{{ route('business.info.update', '') }}/" + businessId :
                        "{{ route('business.info.store') }}";

                    $('#loader').show();
                    $('#submitForm').prop('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#loader').hide();
                            $('#submitForm').prop('disabled', false);

                            if (response.message) {
                                toastr.success(response.message);
                                if (!businessId) {
                                    $('#businessInfoId').val(response.business_id);
                                }
                            } else {
                                toastr.error('Something went wrong. Please try again.');
                            }
                        },
                        error: function(xhr) {
                            $('#loader').hide();
                            $('#submitForm').prop('disabled', false);

                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors || {};

                                $.each(errors, function(key, messages) {
                                    var field = $('[name="'+key+'"]');
                                    if (field.length) {
                                        field.addClass('is-invalid');
                                        field[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    }
                                    messages.forEach(function(message) {
                                        toastr.error(message);
                                    });
                                });
                            } else {
                                var errorMessage = xhr.responseJSON?.message || 'An unexpected error occurred. Please try again.';
                                toastr.error(errorMessage);
                            }
                        }
                    });
                });

                    var formData = new FormData($('#businessHourForm')[0]);
                    var days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    days.forEach(function(day) {
                        var start = $('#' + day + '_start').val();
                        var end = $('#' + day + '_end').val();
                        if (start && end) {
                            formData.set(day, start + ' - ' + end);
                        } else {
                            formData.set(day, '');
                        }
                    });

                    var url = $('#businessHourInfo').val() === '' ? "{{ route('business.hour.store') }}" :
                        "{{ route('business.hour.update', '') }}/" + $('#businessHourInfo').val();
                    $('#loaderHour').show();
                    $('#submitHourForm').prop('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#loaderHour').hide();
                            $('#submitHourForm').prop('disabled', false);
                        },
                        error: function(xhr) {
                            $('#loaderHour').hide();
                            $('#submitHourForm').prop('disabled', false);
                            if (xhr.status === 422) {
                                console.log("Validation errors:", xhr.responseJSON.errors);
                                $.each(xhr.responseJSON.errors, function(key, items) {
                                    items.forEach(function(item) {
                                        toastr.error(item);
                                    });
                                });
                            } else {
                                toastr.error('An unexpected error occurred. Please try again.');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush



@endsection
