@extends('frontend.template.master')
@section('title',  "Edit Business Product")

@section('content')
@include('frontend.template.usermenu')
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" async defer media="all" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<style>.account-card-text p::before{position:absolute;content:"\f192";top:0;left:0;font-size:15px;font-weight:900;font-family:'Font Awesome 5 Free';color:var(--primary)}.account-card-text p{margin-bottom:17px;padding-left:25px;position:relative}
  .highlighted{background-color:#f0f0f0;cursor:pointer}.note-editor .note-toolbar{font-size:14px}.note-editor .note-btn{padding:5px 10px}.note-editor .note-btn i{font-size:12px}.form-group label{font-weight:700}textarea.form-control{height:215px!important;padding:15px 20px}.file-drop-zone-title{color:#aaa;font-size:1.6em;text-align:center;padding:15px 10px;cursor:default}.file-drop-zone{min-height:auto}.note-editor .note-btn{padding:3px 4px;font-size:10px}.select2-container{width:100%}.input-group-append .btn,.input-group-prepend .btn{position:relative;z-index:2;padding:5px;font-size:12px}.btn.btn-danger{padding: .25rem .5rem;}.select2-container--default .select2-selection--single{border:none;width:100%;height:50px;padding:10px 0;border-radius:0;color:var(--heading);background:var(--chalk);border-bottom:2px solid var(--border);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s}.select2-container--default .select2-selection--single .select2-selection__arrow{margin-top:10px}.preview-image{    object-fit: contain;
    height: 100px;display:inline-block;margin:5px;cursor:pointer;width:100%}.selected{border:2px solid #007bff}.preview-image.selected::after{content:"";position:absolute;top:0;left:0;bottom:0;right:0;background-color:rgb(0 123 255 / .3)}.form-control1{border:1px solid #00000040!important}.form-control1:focus{border-color:#00b6f552!important}.form-control1:focus{color:#000!important}.form-control1{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #000;height:40px!important;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;box-shadow:none !IMPORTANT}.form-control1:focus{outline:none;box-shadow:none;color:#fff;background:#fff;border-color:var(--primary)}.form-control2{border:1px solid #00000040!important}.form-control2:focus{border-color:#00b6f552!important}.form-control2:focus{color:#000!important}.form-control2{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #000;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;box-shadow:none !IMPORTANT}.form-control2:focus{outline:none;box-shadow:none;color:#fff;background:#fff;border-color:var(--primary)}.select2-container--default .select2-selection--single{background-color:#fff;border:1px solid #aaa;border-radius:4px;height:40px}.select2-container--default .select2-selection--multiple{min-height:40px!important}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#444;line-height:18px}
  @media (max-width: 576px) {.image-container { width: 100%;} #imagePreviewContainer .row {
gap: 12px; }} .image-container { display: flex;flex-direction: column; align-items: center; width: 150px; text-align: center; }.image-container .preview-image {width: 100%; height: 85px; object-fit: contain;} .image-container .action-wrapper {margin-top: 8px; width: 100%; }.delete-image-btn { background: #dc3545; border: none; padding: 4px 8px; font-size: 14px; color: white; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; width: 100%; } .delete-image-btn i { font-size: 14px; } .delete-image-btn:hover { background-color: #a71d2a;}.action-wrapper > div { margin-top: 4px;}#imagePreviewContainer .row {display: flex; flex-wrap: wrap; justify-content: center; gap: 16px;}.preview-image { display: inline-block; margin: 5px; cursor: pointer; width: auto !important; max-width: 100%; max-height: 160px;}.delete-image-btn { padding: 7px 6px 7px 10px; margin-right:5px; font-size: 12px; line-height: 1; border-radius: 3px; display: inline-flex;align-items: center;justify-content: center;}.btn-file{width:100%}.fileinput-remove-button,.fileinput-cancel-button,.fileinput-upload-button {display: none;}.file-preview{display :none}.file-caption-name{display:none}.input-group-append{width:100%}
</style>

@endpush

<section class="adpost-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form class="adpost-form" id="editProductForm"
                    action="{{ route('business-products.update', ['item_url' => $product->item_url]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Edit Business Product Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Product Title</label>
                                    <input type="text" name="title" class="form-control1"
                                        placeholder="Type your product title here"
                                        value="{{ old('title', $product->title) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" id="main_image" name="main_image" class="form-control1 file"
                                    data-overwrite-initial="false" accept="image/*">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    @if($product->main_image)
                                    <div class="image-container">
                                        <img  loading="eager"  src="{{ asset('storage/' . $product->main_image) }}"
                                            alt="{{ $product->title }}" class="preview-image">
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <br>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Product Category</label>
                                    <select class="form-control1 custom-select" id="prd_category"
                                        name="category_select">
                                        <option value="">--- Search Category ---</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == old('category_select',
                                            $product->category_id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="category" id="category_name">
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Product Subcategory</label>
                                    <select class="form-control1 custom-select" id="prd_subcategory" name="subcategory">
                                        <option value="">--- Search Subcategory ---</option>
                                        @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $subcategory->id == old('subcategory',
                                            $product->subcategory_id) ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control1" step="0.01" name="amount"
                                        placeholder="Enter your pricing amount"
                                        value="{{ old('amount', $product->price) }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">MRP</label>
                                    <input type="number" class="form-control1" step="0.01" name="mrp"
                                        placeholder="Enter your MRP" value="{{ old('mrp', $product->mrp) }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-control1"
                                        value="{{ old('sku', $product->sku) }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Video URL</label>
                                    <input type="url" name="video_url" class="form-control1"
                                        value="{{ old('video_url', $product->video_url) }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Description</label>
                                    <textarea class="form-control" id="description" name="description">{!! old('description', $product->description) !!}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Available Qty</label>
                                <input type="text" name="max_qty" class="form-control1"
                                        value="{{ old('max_qty', $product->max_qty) }}">
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="extra_images">Extra Images</label>
                                    <input type="file" name="extra_images[]" id="extra_images" class="form-control"
                                        multiple>
                                </div>
                                <div class="row">
                                @foreach($product->images as $image)
                        <div class="image-container col-md-3">
                            <img loading="eager" src="{{ asset('storage/' . $image->image_path) }}" alt="Extra Image" class="preview-image">
                            <button type="button" class="btn btn-danger btn-sm delete-image-btn" data-image-id="{{ $image->id }}" data-type="extra">
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
                    </div>
                    <div class="adpost-card pb-2">
                        <div class="spinner-border text-primary" id="loader" style="display:none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="form-group text-right">
                            <button id="submitButton" type="submit" class="btn btn-inline">
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
                        <h3>Safety Tips</h3><button data-dismiss="alert">close</button>
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
                        <div class="form-group"><input type="text" class="form-control1" placeholder="Name"></div>
                        <div class="form-group"><input type="email" class="form-control1" placeholder="Email"></div>
                        <div class="form-group">
                            <textarea class="form-control2" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group"><button class="btn btn-inline"><i
                                    class="fas fa-paper-plane"></i><span>send Message</span></button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
   

@push('scripts')
<script src="{{ asset('admin_assets/js/select2.full.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/fileinput.min.js"></script>
<script>
   $(document).ready(function () {
    $("#description").summernote({ height: 150 });
});
var base_url = "{{ url('/') }}";
const form = $("#editProductForm");
$(document).ready(function () {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
    initializeCategorySelect2("#prd_category", "#prd_subcategory");
    initializeFileInput("#input-file");
});

function initializeFileInput(selector) {
    $(selector).fileinput({
        theme: "fa",
        allowedFileExtensions: ["jpg", "png", "gif", "pdf", "webp"],
        maxFileSize: 2048,
        overwriteInitial: !1,
        maxFilesNum: 10,
        showUpload: !0,
        showRemove: !0,
        showClose: !1,
        initialPreview: [],
        initialPreviewConfig: [],
    });
}
function initializeCategorySelect2(categorySelector, subcategorySelector) {
    $(categorySelector).each(function () {
        $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: "--- Search Category ---",
            allowClear: !0,
            ajax: {
                url: base_url + "/getCategory",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return { searchTerm: params.term };
                },
                processResults: function (data) {
                    return { results: data.categories };
                },
                cache: !0,
            },
        });
    });
    $(categorySelector).on("select2:select", function (e) {
        var data = e.params.data;
        $(subcategorySelector).each(function () {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: "--- Search Subcategory ---",
                allowClear: !0,
                ajax: {
                    url: base_url + "/getSubcategory",
                    type: "post",
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        return { _token: "{{ csrf_token() }}", searchTerm: params.term, cat_id: data.id };
                    },
                    processResults: function (data) {
                        return { results: data };
                    },
                    cache: !0,
                },
            });
        });
    });
    $(categorySelector).on("select2:select", function (e) {
        var data = e.params.data;
        var categoryName = data.text;
        $("#category_name").val(categoryName);
    });
}

    $(document).ready(function () {
        $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
        initializeCategorySelect2("#prd_category", "#prd_subcategory");
        initializeFileInput("#input-file");

        const form = $("#editProductForm");
        const loader = $("#loader");
        const submitButton = $("#submitButton");

        form.on("submit", function (e) {
            e.preventDefault();
            loader.show();
            submitButton.prop("disabled", true);
            let formData = new FormData(this);

            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    loader.hide();
                    submitButton.prop("disabled", false);
                    toastr.success(response.success);
                    setTimeout(function () {
                        window.location.href = response.redirect_url;
                    }, 1500);
                },
                error: function (response) {
                    loader.hide();
                    submitButton.prop("disabled", false);

                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else if (response.status === 403) {
                        toastr.error(response.responseJSON.error);
                    } else {
                        toastr.error("An unexpected error occurred. Please try again.");
                    }
                },
            });
        });
    });


        </script>

@endpush
    


@endsection