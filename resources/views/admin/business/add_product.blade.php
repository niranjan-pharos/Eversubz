@extends('admin.template.master')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" rel="stylesheet">
<style>
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
                    <a href="{{ route('businessByAdmin')}}" class="btn btn-primary mb-3" style="float:right"><i
                            class="fa fa-mail-reply"></i> Business List </a>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form action="{{ route('business.products.store') }}" enctype="multipart/form-data"
                                method="post" role="form" id="add_products">
                                @csrf
                                <input type="hidden" name="business_id" value="{{$business_id}}">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Title <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" required name="title" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Category</label>
                                                <select class="form-control required select2 ajax_category"
                                                    name="category_id">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">SubCategory</label>
                                                <select class="form-control required select2 ajax_subcategory"
                                                    name="subcategory_id">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Price</label>
                                                <input class="form-control" type="text" name="price" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">MRP</label>
                                                <input class="form-control" type="text" name="mrp" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">SKU</label>
                                                <input class="form-control" type="text" name="sku" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Video URL</label>
                                                <input class="form-control" type="text" name="video_url" value="">
                                            </div>
                                        </div>



                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description</label>
                                                <textarea id="descriptionEditor" rows="6" cols="5" class="form-control"
                                                    placeholder="Description" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Feature</label>
                                                <br />
                                                <input class="form-check-input" name="feature" type="checkbox"
                                                    role="switch" value="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Order By</label>
                                                <input type="number" class="form-control" id="orderby" name="orderby">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="max_qty">Available Qty</label>
                                                <input type="number" name="max_qty" id="max_qty" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Main Image</label>
                                                <input type="file" class="form-control" id="main_image"
                                                    name="main_image">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="extra_images">Additional Images</label>
                                                <input type="file" name="extra_images[]" id="extra_images"
                                                    class="form-control" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
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
</script>


<script>
$(document).ready(function() {
    $(".add_multi_language").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

    $('.ajax_category').each(function() {
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

    $('.ajax_category').on('select2:select', function(e) {
        var data = e.params.data;
        $('.ajax_subcategory').each(function() {
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



    $('#add_products').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('.submit-btn').prop('disabled', true);
        $('#loader').show();

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);

                $('#add_products')[0].reset();
                $('#main_image').val('');
                $('.select2').val(null).trigger('change');
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
                            input.after('<div class="invalid-feedback">' + message + '</div>');
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
</style>

@endsection