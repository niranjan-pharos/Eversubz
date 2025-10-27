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
                <div class="col-md-12 mt-2">
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
                <div class="col-md-12">
                    <div class="variants-card mt-3">
                            <div class="adpost-title">
                                <h4>Variants</h4>
                            </div>
                            <div class="info-box">
                                Add variants if this product comes in multiple versions, like different sizes or colors.
                            </div>

                            <div class="variant-inputs" id="variant-inputs">
                                <!-- Pre-added Size and Color -->
                                <div class="variant-row">
                                    <input type="text" name="option_name[]" value="Size">
                                    <input type="text" name="option_value[]" class="variant-input" placeholder="e.g., S, M, L, XL">
                                    <button type="button" class="remove-variant">×</button>
                                </div>
                                <div class="variant-row">
                                    <input type="text" name="option_name[]" value="Color">
                                    <input type="text" name="option_value[]" class="variant-input" placeholder="e.g., Red, Black, Blue">
                                    <button type="button" class="remove-variant">×</button>
                                </div>
                            </div>

                            <button type="button" id="add-variant-btn" style="background:#28a745;color:#fff;padding:6px 12px;border:none;border-radius:4px;cursor:pointer;margin-bottom:10px;">
                                <i class="fa fa-plus-square" aria-hidden="true"></i> Add Variant Type
                            </button>

                            <button type="button" id="update-variants-btn" style="background:#00c5fb;color:#fff;padding:6px 12px;border:none;border-radius:4px;cursor:pointer;margin-bottom:10px;">
                                Update
                            </button>

                            <p>Modify the variants to be created:</p>

                            <table class="variant-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Variant</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="variant-table-body"></tbody>
                            </table>
                        </div>
                </div>


                    <style>
                    .variants-card { background: #fff; border: 1px solid #e0e0e0; padding: 15px; border-radius: 6px; font-family: Arial, sans-serif; margin-bottom:30px; }
                    .variants-card h4 { margin-bottom: 10px; }
                    .info-box { background: #dff0d8; color: #3c763d; padding: 8px 12px; border-radius: 4px; margin-bottom: 15px; font-size: 13px; }
                    .variant-inputs { margin-bottom: 15px; }
                    .variant-row { display: flex; gap: 10px; margin-bottom: 8px; align-items: center; }
                    .variant-row input[type="text"] { flex: 1; padding: 6px 8px; border: 1px solid #d3d3d3; border-radius: 4px; }
                    .variant-row input[readonly] { background:#f0f0f0; }
                    .remove-variant { background:#5e5a5a;color:#fff;border:none;padding:0 10px;border-radius:4px;cursor:pointer; }
                    .variant-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-top:10px; }
                    .variant-table th, 
                    .variant-table td {
                        border: none;               /* remove all borders first */
                        border-bottom: 1px solid #d3d3d3; /* only bottom border */
                        padding: 6px 10px;
                        text-align: center;
                    }
                    .variant-table th { background: #f7f7f7; }
                    .variant-table input[type="number"] { width: 70px; padding: 4px 6px; border: 1px solid #d3d3d3; border-radius: 4px; text-align: right; }
                    .btn-upload { background: #007bff; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
                    .btn-upload:hover { background: #0066ff; }
                    .variant-table td { vertical-align: middle; }
                    .eye-icon { cursor: pointer; margin-left: 5px; color: #007bff; }

                    /* 📱 Responsive Styles */
                    @media (max-width: 768px) {
                        .variant-row {
                            flex-direction: column; /* stack inputs vertically */
                            align-items: stretch;
                        }
                        .variant-row input[type="text"] {
                            width: 100%;
                        }
                        .remove-variant {
                            align-self: flex-end;
                            margin-top: 5px;
                        }
                        .variant-table {
                            display: block;
                            overflow-x: auto; /* scroll horizontally if needed */
                            white-space: nowrap;
                        }
                        .variant-table th,
                        .variant-table td {
                            font-size: 12px;
                            padding: 5px;
                        }
                        .btn-upload {
                            width: 100%;
                            text-align: center;
                            margin-top: 8px;
                        }
                    }

                    @media (max-width: 480px) {
                        .variants-card {
                            padding: 10px;
                        }
                        .info-box {
                            font-size: 12px;
                            padding: 6px 10px;
                        }
                        .variant-table input[type="number"] {
                            width: 50px;
                        }
                    }


                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const variantInputsContainer = document.getElementById('variant-inputs');
                            const addVariantBtn = document.getElementById('add-variant-btn');
                            const tableBody = document.getElementById('variant-table-body');
                            let skuCounter = 1;

                            const existingVariants = @json($productVariantInfo ?? []);

                            function updateTable() {
                                tableBody.innerHTML = '';
                                const variantRows = document.querySelectorAll('.variant-row');
                                let hasRecords = false;

                                variantRows.forEach(row => {
                                    const nameInput = row.querySelector('input[name="option_name[]"]');
                                    const valueInput = row.querySelector('input[name="option_value[]"]');
                                    const name = nameInput.value.trim();
                                    const values = valueInput.value.split(',').map(v => v.trim()).filter(Boolean);

                                    if(name && values.length > 0) {
                                        hasRecords = true;
                                        values.forEach(val => {
                                            const tr = document.createElement('tr');
                                            tr.innerHTML = `
                                                <td><input type="checkbox" checked></td>
                                                <td><span style="color:#0066ff">${val}</span> • ${name}</td>
                                                <td>#SKU${skuCounter.toString().padStart(6,'0')}</td>
                                                <td><input type="number" value="0.00"></td>
                                                <td><input type="number" value="0"></td>
                                                <td><button type="button" class="btn-upload"><i class="fa fa-upload"></i> Upload Image</button></td>
                                            `;
                                            tableBody.appendChild(tr);
                                            skuCounter++;
                                        });
                                    }
                                });

                                if(existingVariants.length > 0) {
                                    existingVariants.forEach(v => {
                                        const tr = document.createElement('tr');
                                        tr.innerHTML = `
                                            <td><input type="checkbox" ${v.isactive ? 'checked' : ''}></td>
                                            <td><span style="color:#0066ff">${v.variant}</span></td>
                                            <td>${v.sku}</td>
                                            <td><input type="number" value="${v.price}" step="0.01"></td>
                                            <td><input type="number" value="${v.quantity}"></td>
                                            <td>
                                                <button type="button" class="btn-upload"><i class="fa fa-upload"></i></button>
                                                ${v.image ? `<i class="fa fa-eye eye-icon" data-img="${v.image}" style="margin-left:5px;cursor:pointer;"></i>` : ''}
                                            </td>
                                        `;
                                        tableBody.appendChild(tr);
                                    });
                                    hasRecords = true;
                                }

                                if(!hasRecords) {
                                    const tr = document.createElement('tr');
                                    tr.innerHTML = `<td colspan="6" style="text-align:center; color:#888;">Record not found</td>`;
                                    tableBody.appendChild(tr);
                                }
                            }

                            variantInputsContainer.addEventListener('input', function(e) {
                                if(e.target.classList.contains('variant-input')) updateTable();
                            });

                            addVariantBtn.addEventListener('click', function() {
                                const newRow = document.createElement('div');
                                newRow.classList.add('variant-row');
                                newRow.innerHTML = `
                                    <input type="text" name="option_name[]" placeholder="Option name (e.g., Material)">
                                    <input type="text" name="option_value[]" class="variant-input" placeholder="Option values separated by commas">
                                    <button type="button" class="remove-variant">×</button>
                                `;
                                variantInputsContainer.appendChild(newRow);
                            });

                            variantInputsContainer.addEventListener('click', function(e) {
                                if(e.target.classList.contains('remove-variant')) {
                                    e.target.closest('.variant-row').remove();
                                    updateTable();
                                }
                            });

                            updateTable();
                        });

                        document.getElementById('update-variants-btn').addEventListener('click', function() {
                            const tableRows = document.querySelectorAll('#variant-table-body tr');
                            const variants = [];
                            const productId = @json($productInfo->id ?? 1);

                            tableRows.forEach(row => {
                                const isactive = row.querySelector('input[type="checkbox"]').checked;
                                const variant = row.cells[1]?.textContent.trim() || '';
                                const sku = row.cells[2]?.textContent.trim() || '';
                                const numberInputs = row.querySelectorAll('input[type="number"]');
                                const price = numberInputs[0] ? numberInputs[0].value : 0;
                                const quantity = numberInputs[1] ? numberInputs[1].value : 0;

                                variants.push({ 
                                    variant, 
                                    sku, 
                                    price, 
                                    quantity, 
                                    isactive, 
                                    image: null 
                                });
                            });

                            fetch('{{ route("business.products.variant.update", ["id" => $productInfo->id]) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ product_id: productId, variants })
                            })
                            .then(async res => {
                                const text = await res.text();
                                try { 
                                    return JSON.parse(text); 
                                } catch (e) { 
                                    console.error('Server returned non-JSON:', text); 
                                    throw new Error('Invalid JSON: ' + text); 
                                }
                            })
                            .then(data => {
                                if (data.success) toastr.success(data.message);
                                else toastr.error(data.message || 'Something went wrong.');
                            })
                            .catch(err => console.error('Request failed:', err));
                        });

                    </script>

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