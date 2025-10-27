@extends('admin.template.master')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .ui-datepicker-calendar {
        display: none !important;
    }

    .ui-datepicker-month {
        display: none !important;
    }

    .ui-priority-secondary {
        display: none !important;
    }

    .col-sm-2.weekdays {
        display: flex;
        align-items: center;
        padding-left: 40px;
    }

    .col-form-label {
        color: #000;
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
        height: 40px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #fff;
        opacity: 1;
    }

    .form-control:focus {
        outline: none;
        box-shadow: none;
        color: #000;
        background: #fff;
        border-color: var(--primary);
    }

    .info {
        background-color: #e7e7e796;
        padding: 10px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .col-sm-2.weekdays {
        display: flex;
        align-items: center;
        padding-left: 40px;
    }

    .glyphicon-chevron-up:before {
        content: "\e113";
    }

    .glyphicon-chevron-down:before {
        content: "\e114";
    }
</style>

<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>
            <div class="row">
                <div class="col float-right ml-auto">
                    <a href="{{ route('ngoByAdmin')}}" class="btn btn-primary mb-2" style="float:right"><i
                            class="fa fa-mail-reply"></i> NGO List </a>
                </div>

                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form action="{{ route('ngo.update',['id' => $ngoInfo->id]) }}"
                                enctype="multipart/form-data" method="post" role="form" id="edit_ngo">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Ngo Name :<sup
                                                        class="text-danger">*</sup></label>
                                                <input class="form-control" name="ngo_name" type="text" required
                                                    value="{{ $ngoInfo->ngo_name }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Email :</label>
                                                <input class="form-control" type="text" name="contact_email"
                                                    value="{{ $ngoInfo->contact_email }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Establishment Year :</label>
                                                <input class="form-control yearpicker" type="text" name="establishment"
                                                    value="{{ $ngoInfo->establishment }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label">Languages :</label>
                                                <select name="languages[]" id="languages" multiple
                                                    class="form-control add_multi_language select2">
                                                    @foreach($allLanguages as $language)
                                                    <option value="{{ trim($language->name) }}"
                                                        {{ in_array(trim($language->name), $selectedLanguages) ? 'selected' : '' }}>
                                                        {{ trim($language->name) }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <h5 class="text-left info">Ngo Info</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">ABN :</label>
                                                <input class="form-control" type="text" name="abn"
                                                    value="{{ $ngoInfo->abn }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">ACNC :</label>
                                                <input class="form-control" type="text" name="acnc"
                                                    value="{{ $ngoInfo->acnc }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">GST :</label>
                                                <input class="form-control" type="text" name="gst"
                                                    value="{{ $ngoInfo->gst }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Category</label>
                                                <select class="form-control required select2 ajax_category"
                                                    name="cat_id">
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $ngoInfo->cat_id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">NGO Size :</label>
                                                <select class="select form-control" name="size">
                                                    <option value="0">Select Size</option>
                                                    <option value="large"
                                                        {{$ngoInfo->size == "large" ? 'selected' : ''}}>Large</option>
                                                    <option value="medium"
                                                        {{$ngoInfo->size == "medium" ? 'selected' : ''}}>Medium</option>
                                                    <option value="small"
                                                        {{$ngoInfo->size == "small" ? 'selected' : ''}}>Small</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <h5 class="text-left info">Contact Info</h5>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Ngo address :</label>
                                                <input type="text" class="form-control" placeholder="Address"
                                                    name="ngo_address" value="{{ $ngoInfo->ngo_address }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Ngo City :<sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" placeholder="City"
                                                    id="city-input" name="ngo_city" value="{{ $ngoInfo->ngo_city }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Ngo State :</label>
                                                <input type="text" class="form-control" placeholder="State"
                                                    id="state-input" name="ngo_state" value="{{ $ngoInfo->ngo_state }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Ngo Country :</label>
                                                <input type="text" class="form-control" placeholder="Country"
                                                    id="country-input" name="ngo_country"
                                                    value="{{ $ngoInfo->ngo_country }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Contact phone :</label>
                                                <input class="form-control" type="text" name="contact_phone"
                                                    value="{{ $ngoInfo->contact_phone }}" maxlength="20">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Website URL :</label>
                                                <input class="form-control" type="url" name="website_url"
                                                    value="{{ $ngoInfo->website_url }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <h5 class="text-left info">Social Media Info</h5>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Facebook URL :</label>
                                                <input class="form-control" type="text" name="facebook_url"
                                                    value="{{ $ngoInfo->facebook_url }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Twitter URL :</label>
                                                <input class="form-control" type="text" name="twitter_url"
                                                    value="{{ $ngoInfo->twitter_url }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Instagram URL :</label>
                                                <input class="form-control" type="text" name="instagram_url"
                                                    value="{{ $ngoInfo->instagram_url }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Linkedin URL :</label>
                                                <input class="form-control" type="text" name="linkedin_url"
                                                    value="{{ $ngoInfo->linkedin_url }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <h5 class="text-left info">Others Info</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-form-label">Feature :</label><br />
                                                <input class="form-check-input" name="feature" type="checkbox"
                                                    role="switch" value="1" {{ $ngoInfo->feature ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="col-form-label">Order By :</label>
                                                <input class="form-control" name="orderby" type="text"
                                                    value="{{ $ngoInfo->orderby }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Logo/Image :</label>
                                                <input type="file" class="form-control" id="image" name="logo_path">
                                                <img class="img img-thumbnail"
                                                    src="{{ asset('storage/' . $ngoInfo->logo_path) }}"
                                                    style="width:160px; height:auto;">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="col-form-label">Other Image :</label>
                                                <input type="file" class="form-control" id="other_images"
                                                    name="other_images[]" multiple>
                                                <div class="other-images-container row">

                                                    @foreach($ngoInfo->images as $image)
                                                    <div class="col-sm-3 image-container" data-image-id="{{ $image->id }}">
                                <img src="{{ asset('storage/'.$image->image_path) }}" 
                                    alt="NGO Image ID {{ $image->id }}" 
                                    style="width: 70px; height:70px">
                                <button type="button" class="btn btn-danger btn-sm delete-image-btn" data-image-id="{{ $image->id }}">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#FFFFFF"></path>
                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#FFFFFF"></path>
                                        <path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="#FFFFFF"></path>
                                    </svg>
                                </button>
                                                                            </div>


                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description :</label>
                                                <textarea class="form-control" id="adDescription"
                                                    placeholder="Describe your message"
                                                    name="ngo_description">{{ old('ngo_description', $ngoInfo->ngo_description) }}</textarea>
                                            </div>
                                        </div>

                                        <div id="loader" style="display: none;" class="spinner-border text-primary"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col submit-section">
                                        <button class="btn btn-primary submit-btn" id="btnSubmit">Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
    async defer></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>

$(document).ready(function() {
    $('.delete-image-btn').on('click', function() {
        var imageId = $(this).data('image-id');
        var imageContainer = $(this).closest('.image-container');

        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: '/ngo-delete-image',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    image_id: imageId
                },
                success: function(response) {
                    if (response.success) {
                        imageContainer.remove();
                    } else {
                        alert('Failed to delete the image');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    });
});
$(document).ready(function() {
    var maxChars = 5000;
    var charCount = $('#charCount');
    var adDescription = $('#adDescription');

    adDescription.summernote({
        height: 150,
        callbacks: {
            onKeyup: function(e) {
                updateCharCount();
            },
            onChange: function(contents, $editable) {
                updateCharCount();
            }
        }
    });

    function updateCharCount() {
        var currentChars = adDescription.summernote('code').replace(/(<([^>]+)>)/gi, "").length;
        charCount.text(currentChars + ' / ' + maxChars + ' characters');

        if (currentChars > maxChars) {
            var truncatedText = adDescription.summernote('code').replace(/(<([^>]+)>)/gi, "").substring(0,
                maxChars);
            adDescription.summernote('code', truncatedText);
            charCount.text(maxChars + ' / ' + maxChars + ' characters');
        }
    };

    updateCharCount();

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
                    state = component.long_name;
                } else if (component.types.includes('country')) {
                    country = component.long_name;
                }
            }

            cityInput.value = city;
            stateInput.value = state;
            countryInput.value = country;
        });

        cityInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                return false;
            }
        });
    };

    $(function() {
        $(".timepicker").datetimepicker({
            format: "hh:mm A"
        });
    });
});


$(document).ready(function() {

    console.log("Selected Languages:", @json($selectedLanguages));

    $(".add_multi_language").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    $(".add_multi_language").val(@json($selectedLanguages)).trigger('change');

    console.log("Select2 Values Set:", $(".add_multi_language").val());

    $('.yearpicker').datepicker({
        dateFormat: 'yy',
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1900:' + new Date().getFullYear(),
        onClose: function(dateText, inst) {
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 0, 1));
        },
        beforeShow: function(input, inst) {
            if ((datestr = $(this).val()).length > 0) {
                year = datestr.substring(datestr.length - 4, datestr.length);
                $(this).datepicker('option', 'defaultDate', new Date(year, 0, 1));
                $(this).datepicker('setDate', new Date(year, 0, 1));
            }
        }
    });


    $('.ajax_category').each(function() {
        $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: '--- Search Category ---',
            allowClear: true,
            ajax: {
                url: "{{route('ajaxSearchNgoCategory')}}",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        "_token": "{{ csrf_token() }}",
                        searchTerm: params.term,
                    };
                },
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: data,
                    };
                },
                cache: true
            }
        });
    });


    $('#edit_ngo').submit(function(e) {
        e.preventDefault();
        return false;

    });

    $('#btnSubmit').click(function(e) {
        e.preventDefault();
        var formData = new FormData($('#edit_ngo')[0]);
        $('#loader').show();
        $('#btnSubmit').attr('disabled', true);

        $.ajax({
            url: $('#edit_ngo').attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                $('#loader').hide();
                $('#btnSubmit').attr('disabled', false);
            },
            error: function(xhr) {
                $('#loader').hide();
                $('#btnSubmit').attr('disabled', false);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        errors[key].forEach(function(message) {
                            toastr.error(message);
                        });
                    });
                } else {
                    toastr.error('An error occurred. Please try again.');
                }
            }
        });
    });






});
</script>

@endsection