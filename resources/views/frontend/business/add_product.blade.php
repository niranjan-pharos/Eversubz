@extends('frontend.template.master')
@section('title',  "add business product")

@section('content')
@include('frontend.template.usermenu')
@push('style')
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>.account-card-text p::before{position:absolute;content:"\f192";top:0;left:0;font-size:15px;font-weight:900;font-family:'Font Awesome 5 Free';color:var(--primary)}.account-card-text p{margin-bottom:17px;padding-left:25px;position:relative}
.highlighted{background-color:#f0f0f0;cursor:pointer}.note-editor .note-toolbar{font-size:14px}.select2-container{width:100%}.input-group-append .btn,.input-group-prepend .btn{position:relative;z-index:2;padding:5px;font-size:12px}.note-editor .note-btn{padding:5px 10px}.note-editor .note-btn i{font-size:12px}.form-group label{font-weight:700}textarea.form-control{height:215px!important;padding:15px 20px}.file-drop-zone-title{color:#aaa;font-size:1.6em;text-align:center;padding:15px 10px;cursor:default}.file-drop-zone{min-height:auto}.note-editor .note-btn{padding:3px 4px;font-size:10px}.select2-container--default .select2-selection--single{border:none;width:100%;height:50px;padding:10px 0;border-radius:0;color:var(--heading);background:var(--chalk);border-bottom:2px solid var(--border);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s}.select2-container--default .select2-selection--single .select2-selection__arrow{margin-top:10px}.preview-image{    object-fit: contain;
    height: 100px;display:inline-block;margin:5px;cursor:pointer;width:100px}.selected{border:2px solid #007bff}.preview-image.selected::after{content:"";position:absolute;top:0;left:0;bottom:0;right:0;background-color:rgb(0 123 255 / .3)}.form-control1{border:1px solid #00000040!important}.form-control1:focus{border-color:#00b6f552!important}.form-control1:focus{color:#000!important}.form-control1{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #000;height:40px!important;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;box-shadow:none ! IMPORTANT}.form-control1:focus{outline:none;box-shadow:none;color:#fff;background:#fff;border-color:var(--primary)}.form-control2{border:1px solid #00000040!important}.form-control2:focus{border-color:#00b6f552!important}.form-control2:focus{color:#000!important}.form-control2{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #000;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;box-shadow:none ! IMPORTANT}.form-control2:focus{outline:none;box-shadow:none;color:#fff;background:#fff;border-color:var(--primary)}.select2-container--default .select2-selection--single{background-color:#fff;border:1px solid #aaa;border-radius:4px;height:40px}.select2-container--default .select2-selection--multiple{min-height:40px!important}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#444;line-height:18px}
</style>

@endpush
<section class="adpost-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form class="adpost-form" id="adProductForm" action="{{ route('business-products.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Business Product Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Product Title<span class="warning">*</span></label>
                                    <input type="text" name="title" class="form-control1"
                                        placeholder="Type your product title here" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" id="input-file" name="main_image" class="form-control1 file"
                                        data-overwrite-initial="false" accept="image/*">
                                </div>
                            </div>
                            <div class="col-lg-12" id="imagePreviewContainer">
                                <div class="row">
                                </div>
                            </div>

                            <br> 

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Product Category<span class="warning">*</span></label>
                                  
                                        <select class="form-control custom-select" id="prd_category" name="category_select">
                                    </select>
                                </div>
                                <input type="hidden" name="category" id="category_name">
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Product Subcategory</label>
                                    
                                    <select class="form-control1 custom-select" id="prd_subcategory" name="subcategory">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control1" step="0.01" name="amount"
                                        placeholder="Enter your pricing amount" value="{{ old('amount') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">MRP</label>
                                    <input type="number" class="form-control1" step="0.01" name="mrp"
                                        placeholder="Enter your MRP" value="{{ old('mrp') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Product Sku</label>
                                    <input type="text" name="sku" class="form-control1" value="{{ old('sku') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Video URL</label>
                                    <input type="url" name="video_url" class="form-control1"
                                        value="{{ old('video_url') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Description</label>
                                    <textarea class="form-control2" id="adDescription"
                                        placeholder="Describe your message" maxlength="1000"
                                        name="description">{{ old('description') }}</textarea>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="extra_images">Additional Images</label>
                                    <input type="file" name="extra_images[]" id="extra_images" class="form-control"
                                        multiple>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="max_qty">Available Qty</label>
                                    <input type="number" name="max_qty" id="max_qty" class="form-control"
                                        multiple>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="adpost-card pb-2">
                        <div class="adpost-agree">
                            <div class="form-group">
                                <input type="checkbox" name="terms" class="form-check" id="agreeCheckbox">
                            </div>
                            <p>
                                Send me Trade Email/SMS Alerts for people looking to buy mobile handsets in www. By
                                clicking "Post," you agree to our <a href="{{ route('terms-of-use') }}">Terms of Use</a> and <a href="{{ route('privacy-policy') }}">Privacy
                                    Policy</a> and acknowledge that you are the rightful owner
                                of this item and using Trade to find a genuine buyer.
                            </p>
                        </div>
                        <div>
                            <p class="checkbox-message" style="display: none; color: red;">Please check the box to
                                publish your ad</p>
                        </div>
                        <div id="loader" class="spinner-border text-primary" role="status" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="form-group text-right">
                            <button id="submitButton" type="submit" class="btn btn-inline" disabled>
                                <i class="fas fa-check-circle"></i>
                                <span>Publish your ad</span>
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
                        <div class="form-group"><input type="email" class="form-control1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control2" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group"><button class="btn btn-inline">
                                <i class="fas fa-paper-plane"></i><span>send Message</span></button></div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</section>
@push('scripts')
<script src="{{ asset('admin_assets/js/select2.full.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    
    $(document).ready(function() {
        $("#adDescription").summernote({ height: 150 });

            var base_url = "{{ url('/') }}";
            $('#agreeCheckbox').change(function() {
                var isChecked = this.checked;
                $('#submitButton').prop('disabled', !isChecked);
                $('.checkbox-message').toggle(!isChecked);
            });


            $.ajaxSetup({ 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 

            $('#prd_category').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    placeholder: '--- Search Category ---',
                    allowClear: !0,
                    ajax: {
                        url: base_url + '/getCategory',
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                "_token": "{{ csrf_token() }}",
                                searchTerm: params.term
                            }
                        },
                        processResults: function(data) {
                            return {
                                results: data.categories
                            }
                        },
                        cache: !0
                    }
                })
            });

            $('#prd_category').on('select2:select', function(e) {
                var data = e.params.data;
                $('#prd_subcategory').select2({
                    dropdownParent: $(this).parent(),
                    placeholder: '--- Search Subcategory ---',
                    allowClear: true,
                    ajax: {
                        url: base_url + '/getSubcategory',
                        type: "POST",
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

            
            $('#prd_category').on('select2:select', function(e) {
                var data = e.params.data;
                var categoryName = data.text;
                $("#category_name").val(categoryName);
            });

            $('#adProductForm').on('submit', function(e) {
                e.preventDefault();
                submitForm(this, function() {
                    resetFormAndComponents();
                });
            });


            function submitForm(formSelector, callback) {
            var formData = new FormData($(formSelector)[0]);
            var submitButton = $(formSelector).find('button[type="submit"]');
            var loader = $('#loader');

            submitButton.attr('disabled', true);
            loader.show();

            $.ajax({
                url: $(formSelector).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    submitButton.attr('disabled', false);
                    loader.hide();
                    if (response.success) {
                        toastr.success(response.success);
                        $(formSelector)[0].reset();
                        setTimeout(function() {
                            window.location.href = response.redirect_url;
                        }, 1500);
                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                }, 
                error: function(xhr) {
                    submitButton.attr('disabled', false);
                    loader.hide();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let error in errors) {
                            toastr.error(errors[error][0]);
                        }
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.');
                    }
                }
            }); 
            }

        

            initializeFileInput("#input-file");


            function resetFormAndComponents() {
                $("#adProductForm")[0].reset();
                $('#prd_category').val(null).trigger('change');
                $('#prd_subcategory').val(null).trigger('change');
                $('#imagePreviewContainer .row').empty();
                $('#input-file').fileinput('clear');
            }

            function initializeFileInput(selector) {
            $(selector).fileinput({
                theme: 'fa',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf', 'webp'],
                maxFileSize: 2048, 
                overwriteInitial: false,
                maxFilesNum: 10,
                showUpload: true,
                showRemove: true,
                showClose: false,
                initialPreview: [],
                initialPreviewConfig: []
            });
        }

    });
    </script>
@endpush

@endsection