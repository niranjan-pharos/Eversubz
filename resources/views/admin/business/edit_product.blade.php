@extends('admin.template.master')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" rel="stylesheet">
<style>
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
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    border: 1px solid #00000040 !important;
}

.form-control:focus {
    outline: none;
    box-shadow: none;
    background: #fff;
    border-color: var(--primary);
}

.col-form-label {
    color: #000;
}

ul {
    /* list-style-type: disc !important; */
    /* Force bullet points */
    /* padding-left: 20px !important; */
    /* Add some indentation */
}

ol {
    list-style-type: decimal;
    /* Ensures ordered lists show numbers */
    padding-left: 20px;
    /* Adds left padding for list items */
}

/* Ensure list items are visible */
li {
    display: list-item !important;
}
</style>
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>
            <div class="row">
                <div class="col float-right ml-auto">
                    <a href="{{ route('listBusinessProduct',['id' => $bid])}} " class="btn btn-primary"
                        style="float:right"><i class="fa fa-mail-reply"></i> Product List </a>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form action="{{ route('business.products.update',['id' => $productInfo->id]) }}"
                                enctype="multipart/form-data" method="post" role="form" id="edit_product">
                                @csrf

                                <input type="hidden" name="product_id" value="{{$productInfo->id}}">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Title <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" required name="title"
                                                    value="{{ $productInfo->title }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Category</label>
                                                <select class="form-control required select2 ajax_product_category"
                                                    name="category_id">
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $productInfo->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Sub Category</label>
                                                <select class="form-control required select2 ajax_product_subcategory"
                                                    name="subcategory_id">
                                                    @foreach($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ $subcategory->id == $productInfo->subcategory_id ? 'selected' : '' }}>
                                                        {{ $subcategory->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Price</label>
                                                <input class="form-control" type="text" name="price"
                                                    value="{{ $productInfo->price }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">MRP</label>
                                                <input class="form-control" type="text" name="mrp"
                                                    value="{{ $productInfo->mrp }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">SKU</label>
                                                <input class="form-control" type="text" name="sku"
                                                    value="{{ $productInfo->sku }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Video URL</label>
                                                <input class="form-control" type="text" name="video_url"
                                                    value="{{ $productInfo->video_url }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description</label>
                                                <textarea id="descriptionEditor" rows="6" cols="5" class="form-control"
                                                    placeholder="Description" name="description"
                                                    style="height:150px;">{{ $productInfo->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Feature :</label><br />
                                                <input type="hidden" name="feature" value="0">
                                                <input class="form-check-input" name="feature" type="checkbox"
                                                    role="switch" value="1"
                                                    {{ ($productInfo->feature == 1) ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Order By :</label>
                                                <input class="form-control" name="orderby" type="text"
                                                    value="{{$productInfo->orderby }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="max_qty">Available Qty</label>
                                                <input type="number" name="max_qty" id="max_qty" class="form-control"
                                                     value="{{$productInfo->max_qty }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Logo / Main Image</label>
                                                <input type="file" class="form-control" id="image" name="main_image">
                                                @if(!empty($productInfo->main_image))
                                                <img class="img img-thumbnail"
                                                    src="{{ $productInfo->main_image ? asset('storage/' . $productInfo->main_image) : asset('storage/no-image.jpg') }}"
                                                    style="width:60px; height:60px;">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Existing HTML with the delete button -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Other Images:</label>
                                                <input type="file" class="form-control" id="extra_images"
                                                    name="extra_images[]" multiple>
                                            </div>

                                            @if (!empty($productInfo->images))
                                            <div class="other-images-container row">
                                                @foreach($productInfo->images as $image)
                                                <div class="col-sm-3 image-container" data-image-id="{{ $image->id }}">
                                                    <img loading="eager" src="{{ Storage::url($image->image_path) }}"
                                                        alt="Other Image" style="margin-top: 10px;">

                                                    <button type="button" class="btn btn-danger btn-sm delete-image-btn"
                                                        data-image-id="{{ $image->id }}">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
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



                                        <div id="loader" style="display: none;" class="spinner-border text-primary"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Update</button>
                                    <br>
                                </div>
                                <div id="loader" style="display: none;">
                                    <div class="spinner">Loading...</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script>
$(document).ready(function() {
    $('#descriptionEditor').summernote({
        height: 150,
        placeholder: 'Description',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
}); 

$(document).ready(function() {
    $('.delete-image-btn').on('click', function() {
        var imageId = $(this).data('image-id');
        var imageContainer = $(this).closest('.image-container');

        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: '/admin/business-product-delete-image',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
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

    $('.ajax_product_category').each(function() {
        $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: '--- Search Category ---',
            allowClear: true,
            ajax: {
                url: "{{route('ajaxSearchCategory')}}",
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

    $('.ajax_product_category').on('select2:select', function(e) {
        var data = e.params.data;
        $('.ajax_product_subcategory').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: '--- Search Subcategory ---',
                allowClear: true,
                ajax: {
                    url: "{{route('ajaxSearchSubcategory')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            "_token": "{{ csrf_token() }}",
                            searchTerm: params.term,
                            cat_id: data.id
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
        });
    });


    $('#edit_product').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#loader').show();

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#edit_product')[0].reset();
                $('#image').val('');
                $('.select2').val(null).trigger('change');
                toastr.success(response.success);
                window.location.reload();
                $('#loader').hide();
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors || xhr.responseJSON.error;

                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                if (typeof errors === 'object') {
                    for (const [key, messages] of Object.entries(errors)) {
                        const input = $('[name="' + key + '"]');
                        input.addClass('is-invalid');

                        messages.forEach(message => {
                            input.after('<div class="invalid-feedback">' + message +
                                '</div>');
                        });
                    }
                } else {
                    $('#loader').hide();
                    toastr.error(errors);
                }
            }
        });
    });


});
</script>

@endsection