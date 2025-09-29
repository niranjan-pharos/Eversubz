@extends('admin.template.master')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@section('content')
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>
            <div class="row">
                <div class="col float-right ml-auto">

                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form id="add_faqs" action="{{ route('faqs.store') }}" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <!-- FAQ Question -->
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">FAQ <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="faq" id="faq" required>
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Category<span>*</span></label>
                                                <select class="form-control" id="category_id" name="category_id"
                                                    required>
                                                    <option value="">Select Category</option>
                                                    @foreach($faqCategories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Subcategory -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Subcategory<span>*</span></label>
                                                <select class="form-control" id="subcategory_id" name="subcategory_id"
                                                    required>
                                                    <option value="">Select Sub Category</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- FAQ Answer -->
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">FAQ Answer</label>
                                                <textarea class="form-control" id="faqDescription"
                                                    name="faq_description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>



<script>
$(document).ready(function () {
    $('#faqDescription').summernote({
        height: 150,
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onKeyup: function (e) {
                updateCharCount();
            },
            onChange: function (contents, $editable) {
                updateCharCount();
            }
        }
    });

    function uploadImage(file) {
        let data = new FormData();
        data.append('file', file);

        $.ajax({
            url: '{{ route("uploadImage") }}',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#faqDescription').summernote('insertImage', response.url);
                } else {
                    alert('Image upload failed.');
                }
            },
            error: function () {
                alert('An error occurred during the image upload.');
            }
        });
    }

    $('#add_faqs').on('submit', function () {
        const faqDescriptionContent = $('#faqDescription').summernote('code');
        $('#faqDescription').val(faqDescriptionContent); 
    });
});

$(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('submit', '#add_faqs', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        alert(response.message); 
                        $('#add_faqs')[0].reset();
                        $('#subcategory_id').empty().append('<option value="">Select Sub Category</option>');
                    } else {
                        alert(response.message || 'Failed to add FAQ.');
                    }
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = Object.values(errors).map(error => error[0]).join('\n');
                        alert(`Validation Error:\n${errorMessages}`);
                    } else {
                        alert('An error occurred. Please check the logs.');
                    }
                }
            });
        });

       
        $('#category_id').on('change', function () {
            var categoryId = $(this).val();
            var subcategorySelect = $('#subcategory_id');

            subcategorySelect.empty().append('<option value="">Select Sub Category</option>');

            if (categoryId) {
                $.ajax({
                    url: '{{ route("getSubcategories") }}',
                    type: 'GET',
                    data: { category_id: categoryId },
                    success: function (response) {
                        if (response.success) {
                            response.subcategories.forEach(function (subcategory) {
                                subcategorySelect.append(
                                    `<option value="${subcategory.id}">${subcategory.name}</option>`
                                );
                            });
                        } else {
                            alert('No subcategories found for this category.');
                        }
                    },
                    error: function () {
                        alert('Error loading subcategories.');
                    }
                });
            }
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