@extends('frontend.template.master')
@section('title', "edit post")

@section('content')
@include('frontend.template.usermenu')
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/css/fileinput.min.css">

<style>
.primary {
    border: 2px solid red
}

.highlighted {
    background-color: #f0f0f0;
    cursor: pointer
}

.ad-image-1 {
    width: 150px;
    height: auto;
    margin-bottom: 10px
}

.delete-image-btn {
    padding: 5px 8px;
    border: none
}

.delete-image-btn:hover .fa-trash-alt {
    color: red
}

.highlighted {
    background-color: #f0f0f0;
    cursor: pointer
}

.note-editor .note-toolbar {
    font-size: 14px
}

.note-editor .note-btn {
    padding: 5px 10px
}

.note-editor .note-btn i {
    font-size: 12px
}

.form-group label {
    font-weight: 700
}

textarea.form-control {
    height: 215px !important;
    padding: 15px 20px
}

.file-drop-zone-title {
    color: #aaa;
    font-size: 1.6em;
    text-align: center;
    padding: 15px 10px;
    cursor: default
}

.file-drop-zone {
    min-height: auto
}

.note-editor .note-btn {
    padding: 3px 4px;
    font-size: 10px
}

.account-card-text p::before {
    position: absolute;
    content: "\f192";
    top: 0;
    left: 0;
    font-size: 15px;
    font-weight: 900;
    font-family: 'Font Awesome 5 Free';
    color: var(--primary)
}

.account-card-text p {
    margin-bottom: 17px;
    padding-left: 25px;
    position: relative
}

.account-card-text {
    margin-left: 0
}

.select2-container {
    width: 100%
}

.input-group-append .btn,
.input-group-prepend .btn {
    position: relative;
    z-index: 2;
    padding: 5px;
    font-size: 12px
}

.select2-container--default .select2-selection--single {
    border: none;
    width: 100%;
    height: 50px;
    padding: 10px 0;
    border-radius: 0;
    color: var(--heading);
    background: var(--chalk);
    border-bottom: 2px solid var(--border);
    transition: all linear .3s;
    -webkit-transition: all linear .3s;
    -moz-transition: all linear .3s;
    -ms-transition: all linear .3s;
    -o-transition: all linear .3s
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    margin-top: 10px
}

.preview-image {
    display: inline-block;
    margin: 5px;
    cursor: pointer;
    width: 100px;
    object-fit: contain;
    height: 100px;
}

.selected {
    border: 2px solid #007bff
}

.preview-image.selected::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgb(0 123 255 / .3)
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
}
.fileinput-remove-button, .fileinput-cancel-button, .fileinput-upload-button {
    display: none;
}.file-preview {
    display: none;
}.input-group-append {
    width: 100%;
}.btn-file {
    width: 100%;
}
.select2-search__field{}
#select2-select_tag-container{}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    rel="stylesheet">
@php
$itemUrlParts = explode('/', $adPost->item_url);
$category = $itemUrlParts[0];
$slug = $itemUrlParts[1];
$datetime = $itemUrlParts[2];
@endphp
<section class="adpost-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form class="adpost-form" id="editProductForm"
                    action="{{ route('ad-posts.update', ['category' => $category, 'slug' => $slug, 'datetime' => $datetime]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Ad Information</h3>
                        </div>
                        <input type="hidden" name="ad_post" value="{{ $adPost->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Product Title</label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Type your product title here" value="{{ $adPost->title }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" id="input-file" name="images[]" multiple
                                        class="form-control file" data-overwrite-initial="false" accept="image/*">
                                        
                                </div>
                            </div>
                            <div class="col-lg-12" id="imagePreviewContainer">
                                <div class="row">
                                @foreach ($adPost->images as $image)
                                    <div class="col-md-3 mb-2 image-container" id="imageContainer{{ $image->id }}">
                                        <img loading="eager"
                                            class="ad-image-1 preview-image{{ ($image->is_primary) ? ' selected' : '' }}"
                                            src="{{ asset("storage/".$image->url) }}" alt="Image">
                                        <a href="#" title="Delete image" class="btn btn-sm btn-danger delete-image-btn"
                                            data-image-id="{{ $image->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <label>
                                            <input type="radio" name="is_primary" value="{{ $image->id }}"
                                                {{ ($image->is_primary) ? 'checked' : '' }}>
                                            Primary
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Video URL</label>
                                    <input type="url" name="video_url" class="form-control"
                                        value="{{ $adPost->video_url }}">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Post Category</label>
                                    <select class="form-control custom-select" id="post_category" name="category_id">
                                        <option value="">--- Select Post Category ---</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ $category->id == old('category_id', $adPost->category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Product Subcategory</label>
                                    <select class="form-control custom-select" id="prd_subcategory" name="subcategory">
                                        <option value="">--- Search Subcategory ---</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" 
                                                    {{ $subcategory->id == old('subcategory', $adPost->subcategory_id) ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control" step="0.01" name="price"
                                        placeholder="Enter your pricing amount" value="{{ $adPost->price }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">ABN</label>
                                    <input type="text" class="form-control" name="abn" placeholder="Enter item ABN"
                                        value="{{ $adPost->abn }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="location" placeholder="Enter Address"
                                        value="{{ $adPost->location }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="city-input" name="city"
                                        placeholder="Enter City" value="{{ $adPost->city }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" id="state-input" name="state"
                                        placeholder="Enter State" value="{{ $adPost->state }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country-input" name="country"
                                        placeholder="Enter Country" value="{{ $adPost->country }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <ul class="form-check-list">
                                        <li><label class="form-label">Price Condition</label></li>
                                        @foreach (config('constants.price_condition') as $key => $value)
                                        <li>
                                            <input type="radio" class="form-check" id="{{ strtolower($value) }}-check"
                                                name="price_condition" value="{{ $value }}"
                                                @if(strpos($adPost->price_condition, $value) !== false) checked @endif>
                                            <label for="{{ strtolower($value) }}-check"
                                                class="form-check-text">{{ $value }}</label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <ul class="form-check-list">
                                        <li><label class="form-label">Ad Category</label></li>
                                        @foreach (config('constants.ad_category') as $key => $value)
                                        <li>
                                            <input type="radio" class="form-check" id="{{ strtolower($value) }}-check"
                                                name="ad_category" value="{{ $value }}" @if(strpos($adPost->ad_category,
                                            $value) !== false) checked @endif>
                                            <label style="color: #fff !important;font-size: 13px;border-radius: 3px;padding: 2px 8px;line-height: 18px;letter-spacing: .3px;text-transform: capitalize;" for="{{ strtolower($value) }}-check"
                                                class="form-check-text {{ strtolower($value) }}">{{ $value }}</label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <ul class="form-check-list">
                                        <li><label class="form-label">Product Condition</label></li>
                                        @foreach (config('constants.ad_condition') as $key => $value)
                                        <li>
                                            <input type="radio" class="form-check" id="{{ strtolower($value) }}-check"
                                                name="product_condition" value="{{ $value }}"
                                                @if(strpos($adPost->product_condition, $value) !== false) checked
                                            @endif>
                                            <label for="{{ strtolower($value) }}-check"
                                                class="form-check-text">{{ $value }}</label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Description</label>
                                    <textarea class="form-control" id="adDescription"
                                        placeholder="Describe your message"
                                        name="description">{{ $adPost->description }}</textarea>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Languages</label>
                                    @php
                                        $selected = old('languages', $selectedLanguages ?? []);
                                    @endphp

                                    <select name="languages[]" id="languages" class="form-control" multiple style="height: auto !important;">
                                        @foreach($languages as $language)
                                            <option value="{{ $language->id }}" {{ in_array($language->id, $selected) ? 'selected' : '' }}>
                                                {{ ucfirst($language->name) }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Tags</label>
                                    <select class="form-control add_multi_ads select2" id="select_tag"
                                        multiple="multiple" name="tags[]">
                                        @foreach ($adPost->tags as $tag)
                                        <option value="{{ $tag->tag_name }}" selected>{{ $tag->tag_name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="adpost-card pb-2">
                        <div class="spinner-border text-primary" id="loader" style="display:none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-inline" id="submitButton">
                                <i class="fas fa-check-circle"></i>
                                <span>Update your ad</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Safety Tips</h3>
                    </div>
                    <div class="account-card-text">
                        <p><strong>Be Honest:</strong> Provide accurate details to build trust with potential buyers.
                        </p>
                        <p><strong>Be Clear:</strong> Use clear and simple language in your description.</p>
                        <p><strong>Prompt Responses:</strong> Respond quickly to any inquiries to maintain buyer
                            interest.</p>
                        <p><strong>Use Quality Photos:</strong> Ensure your photos are clear, well-lit, and show the
                            item from multiple angles to give buyers a good view.</p>

                        <p><strong>Check the Marketplace Policies:</strong> Familiarize yourself with the marketplace's
                            rules and guidelines to avoid any violations that could lead to your ad being removed.</p>
                        <p><strong>Update Your Ad Regularly:</strong> If your item is still available, update the ad
                            periodically to keep it visible and show potential buyers that it is still for sale.</p>
                        <p><strong>Provide Detailed Measurements:</strong> For items like furniture or clothing, include
                            specific measurements to help buyers assess if it fits their needs.</p>
                        <p><strong>Mention Any Flaws:</strong> Be transparent about any defects or wear and tear to
                            avoid surprises and build trust with buyers.</p>
                        <p><strong>Use Keywords:</strong> Incorporate relevant keywords in your title and description to
                            make your ad more searchable.</p>

                        <p><strong>Set Realistic Prices:</strong> Research similar items to set a competitive and
                            realistic price, increasing the chances of a quick sale.</p>
                        <p><strong>Be Safe:</strong> When meeting buyers in person, choose a public place and take
                            necessary precautions to ensure your safety.</p>

                    </div>
                </div>
                <div class="account-card alert fade show d-none">
                    <div class="account-title">
                        <h3>Custom Offer</h3><button data-dismiss="alert">close</button>
                    </div>
                    <form class="account-card-form">
                        <div class="form-group"><input type="text" class="form-control" placeholder="Name"></div>
                        <div class="form-group"><input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group"><button class="btn btn-inline"><i
                                    class="fas fa-paper-plane"></i><span>send Message</span></button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
        async defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/fileinput.min.js"></script>

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
    var base_url = "{{ url('/') }}";
    $(document).ready(function() {
        $('#adDescription').summernote({
            height: 150
        });
        $(".add_multi_ads").select2({
            tags: !0,
            tokenSeparators: [',', ' ']
        });
        $('#post_category').select2({
        placeholder: '--- Search Category ---',
        allowClear: true,
        ajax: {
            url: base_url + '/getCategory',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    "_token": "{{ csrf_token() }}",
                    searchTerm: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: data.categories,
                };
            },
            cache: true,
        },
    });

    $('#post_category').on('select2:select', function (e) {
        var data = e.params.data;

        $('#prd_subcategory').empty().trigger('change');

        $('#prd_subcategory').select2({
            placeholder: '--- Search Subcategory ---',
            allowClear: true,
            ajax: {
                url: base_url + '/getSubcategory',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        "_token": "{{ csrf_token() }}",
                        searchTerm: params.term,
                        cat_id: data.id,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data,
                    };
                },
                cache: true,
            },
        });
    });
        $('#prd_category').on('select2:select', function(e) {
            var data = e.params.data;
            var categoryName = data.text;
            $("#category_name").val(categoryName)
        });
        $('#phone').on('input', function() {
            var phoneNumber = $(this).val();
            if (phoneNumber.length > 10) {
                $(this).val(phoneNumber.substring(0, 10));
                $('#phoneError').text('Please enter only 10 digits.')
            } else if (phoneNumber && !validatePhoneNumber(phoneNumber)) {
                $('#phoneError').text('Please enter a valid 10-digit phone number.')
            } else {
                $('#phoneError').text('')
            }
        });

        $('#editProductForm').submit(function(e) {
            e.preventDefault();

            var phoneNumber = $('#phone').val();
            if (phoneNumber && !validatePhoneNumber(phoneNumber)) {
                $('#phoneError').text('Please enter a valid 10-digit phone number.');
                return;
            } else {
                $('#phoneError').text('');
            }

            $('#loader').show();
            $('#submitButton').prop('disabled', true);

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    $('#submitButton').prop('disabled', false);

                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = response.redirect_url;
                        }, 1500);
                    } else {
                        toastr.error('Unexpected response status: ' + response.status);
                    }
                },
                error: function(xhr) {
                    $('#loader').hide();
                    $('#submitButton').prop('disabled', false);

                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, messages) {
                            if (key.startsWith('images')) {
                                var inputIndex = key.match(/\d+/);
                                var fileName = $('#editProductForm input[name="images[]"]')[inputIndex]?.files[0]?.name || 'File';
                                messages.forEach(function(msg) {
                                    toastr.error(fileName + ': ' + msg);
                                });
                            } else {
                                messages.forEach(function(msg) {
                                    toastr.error(msg);
                                });
                            }
                        });
                    } else {
                        var errorMessage = xhr.responseJSON?.message || 'An unexpected error occurred. Please try again.';
                        toastr.error(errorMessage);
                    }
                }
            });
        });


    $("#input-file").fileinput({
        theme: 'fa',
        allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'],
        maxFileSize: 5120,
        overwriteInitial: !1,
        maxFilesNum: 10,
        showUpload: !0,
        showRemove: !0,
        showClose: !1,
        initialPreview: [],
        initialPreviewConfig: []
    });
    let uploadedImages = [];
    let deletedImages = [];
    $("#input-file").on('filebatchselected', function(event, files) {
        $.each(files, function(index, file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $('<div class="col-md-3 mb-2 image-container">').append('<img src="' + event.target
                        .result + '" class="preview-image">').append(
                        '<a href="#" title="Delete image" class="btn btn-sm btn-danger delete-image-btn"><i class="fas fa-trash-alt"></i></a>'
                        ).append('<label><input type="radio" name="is_primary"> Primary</label>')
                    .appendTo('#imagePreviewContainer .row');
                uploadedImages.push({
                    src: event.target.result
                })
            };
            reader.readAsDataURL(file)
        })
    });
    initializeCityAutocomplete('#cityInput', '#citySuggestions');
    $(document).on('click', '.preview-image', function() {
    const $imageContainer = $(this).closest('.image-container');
    const imageId = $imageContainer.attr('id').replace('imageContainer', '');
    $("#selected-image").val(imageId);
    $(".preview-image").removeClass("selected");
    $(this).addClass('selected')
    })
    });

    function validatePhoneNumber(phoneNumber) {
        var phonePattern = /^\d{10}$/;
        return phonePattern.test(phoneNumber)
    }

    function initializeCityAutocomplete(inputSelector, suggestionsContainerSelector) {
        $(inputSelector).on('input', function() {
            var query = $(this).val();
            if (!query) return;
            fetch(`/cities?q=${query}`).then(response => response.json()).then(cities => {
                const suggestions = $(suggestionsContainerSelector);
                suggestions.empty();
                cities.forEach(city => {
                    $('<li>').text(city).on('click', function() {
                        $(inputSelector).val(city);
                        suggestions.empty()
                    }).appendTo(suggestions)
                })
            })
        });
        let currentIndex = -1;
        $(inputSelector).on('keydown', function(e) {
            const suggestions = $(suggestionsContainerSelector);
            const lis = suggestions.find('li');
            const key = e.key;
            if (key === 'ArrowDown') {
                currentIndex = (currentIndex + 1) % lis.length;
                updateHighlight(lis)
            } else if (key === 'ArrowUp') {
                currentIndex = (currentIndex - 1 + lis.length) % lis.length;
                updateHighlight(lis)
            } else if (key === 'Enter') {
                e.preventDefault();
                if (currentIndex >= 0) {
                    $(inputSelector).val(lis.eq(currentIndex).text());
                    suggestions.empty();
                    currentIndex = -1
                }
            }
        });

        function updateHighlight(lis) {
            lis.removeClass('highlighted').eq(currentIndex).addClass('highlighted')
        }
    }
    $(document).on('click', '.delete-image-btn', function(event) {
        event.preventDefault();
        const imageId = $(this).data('image-id');
        const adId = '{{ $adPost->ad_id }}';
        const deleteUrl = "{{ route('ad-post.delete-image') }}";
        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: deleteUrl,
                type: 'PATCH',
                data: {
                    _token: "{{ csrf_token() }}",
                    ad_id: adId,
                    image_id: imageId
                },
                success: function(response) {
                    $('#imageContainer' + imageId).remove();
                    toastr.success(response.success)
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        toastr.error(xhr.responseJSON.error)
                    } else {
                        console.error(xhr.responseText);
                        toastr.error('An error occurred while deleting the image.')
                    }
                }
            })
        }
    })
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const radioButtons = document.querySelectorAll('input[name="is_primary"]');

    radioButtons.forEach(radio => {
        radio.addEventListener('change', function () {
            // Remove 'selected' class from all preview images
            document.querySelectorAll('.preview-image').forEach(img => {
                img.classList.remove('selected');
            });

            // Add 'selected' to the image related to this radio button
            const imageContainer = this.closest('.image-container');
            const image = imageContainer.querySelector('.preview-image');
            image.classList.add('selected');
        });
    });
});
</script>
</section>
@endsection