@extends('frontend.template.master')
@section('title',  "my post create")

@section('content')
@include('frontend.template.usermenu')
@push('style') 
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/css/fileinput.min.css" async defer
        media="all" rel="stylesheet" type="text/css">
        
<style>
   /* Input field: square corners */
.input-group .form-control {
    border-radius: 0;
}

/* Browse button on the right side */
.input-group .input-group-append .btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: .25rem;   /* restore rounded outer corner */
    border-bottom-right-radius: .25rem;
    width: auto;       /* reduce width */
    margin-left: 4px;  /* small gap if needed */
        margin-top: 6px;
}

/* If you use text addon instead of button */
.input-group .input-group-append .input-group-text {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
}

    @media (max-width: 576px) {.image-container { width: 100%;} #imagePreviewContainer .row {
gap: 12px; }} .image-container { display: flex;flex-direction: column; align-items: center; width: 150px; text-align: center; }.image-container .preview-image {width: 100%; height: 85px; object-fit: contain;} .image-container .action-wrapper {margin-top: 8px; width: 100%; }.delete-image-btn { background: #dc3545; border: none; padding: 4px 8px; font-size: 14px; color: white; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;  } .delete-image-btn i { font-size: 14px; } .delete-image-btn:hover { background-color: #a71d2a;}.action-wrapper > div { margin-top: 4px;}#imagePreviewContainer .row {display: flex; flex-wrap: wrap; justify-content: center; gap: 16px;}.preview-image { display: inline-block; margin: 5px; cursor: pointer; width: auto !important; max-width: 100%; max-height: 160px;}.delete-image-btn { padding: 7px 6px 7px 10px; margin-right:5px; font-size: 12px; line-height: 1; border-radius: 3px; display: inline-flex;align-items: center;justify-content: center;}.btn-file{width:100%}.fileinput-remove-button,.fileinput-cancel-button,.fileinput-upload-button {display: none;}.file-preview{display :none}.file-caption-name{display:none}.input-group-append{width:100%}
.primary{border:2px solid red}.highlighted{background-color:#f0f0f0;cursor:pointer}.note-editor .note-toolbar{font-size:14px}.note-editor .note-btn{padding:5px 10px}.note-editor .note-btn i{font-size:12px}.form-group label{font-weight:700}textarea.form-control{height:215px!important;padding:15px 20px}.checkbox-label{display:flex;align-items:center}.form-check{margin-right:10px}textarea.form-control{height:115px!important}.form-control{border:1px solid #00000040!important}.form-control:focus{border-color:#00b6f552!important}.form-control:focus{color:#000!important}.form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #000;height:40px!important;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;box-shadow:none ! IMPORTANT}.form-control:focus{outline:none;box-shadow:none;color:#fff;background:#fff;border-color:var(--primary)}.file-drop-zone-title{color:#aaa;font-size:1.6em;text-align:center;padding:15px 10px;cursor:default}.file-drop-zone{min-height:auto}.note-editor .note-btn{padding:3px 4px;font-size:10px}.adpost-agree .form-group label{margin-top:-5px}.account-card-text p::before{position:absolute;content:"\f192";top:0;left:0;font-size:15px;font-weight:900;font-family:'Font Awesome 5 Free';color:var(--primary)}.account-card-text p{margin-bottom:17px;padding-left:25px;position:relative}.account-card-text{margin-left:0}.select2-container{width:100% !important;}.input-group-append .btn,.input-group-prepend .btn{position:relative;z-index:2;padding:5px;font-size:12px}.select2-container--default .select2-selection--single{border:none;width:100%;height:40px;padding:10px 0;border-radius:0;color:var(--heading);background:var(--chalk);border-bottom:2px solid var(--border);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s}.select2-container--default .select2-selection--single .select2-selection__arrow{margin-top:10px}.preview-image{display:inline-block;margin:5px;cursor:pointer;width:100px}.select2-container--default .select2-selection--single{background-color:#fff;border:1px solid #aaa;border-radius:4px}.select2-container--default .select2-selection--multiple{border:1px solid #dcdcdc;min-height:40px!important}.selected{border:2px solid #007bff}.preview-image.selected::after{content:"";position:absolute;top:0;left:0;bottom:0;right:0;background-color:rgb(0 123 255 / .3)}

</style>
@endpush
<section class="adpost-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form class="adpost-form" id="adForm" action="{{ route('ad-post.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Ad Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Product Title</label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Type your product title here" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" >Product Image</label>
                                    <input type="file" id="input-file" name="images[]" multiple
                                        class="form-control file" data-overwrite-initial="false" accept="image/*" > 
                                </div>
                            </div>
                            <div class="col-lg-12" id="imagePreviewContainer">
                                <div class="row">
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Post URL</label>
                                    <input type="url" name="video_url" class="form-control"
                                        value="{{ old('video_url') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Post Category</label>
                                    <select class="form-control custom-select" id="prd_category" name="category_select">
                                    </select>
                                </div>
                                <input type="hidden" name="category" id="category_name">
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Post Subcategory</label>
                                    <select class="form-control custom-select" id="prd_subcategory" name="subcategory">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control" step="0.01" name="amount"
                                        placeholder="Enter your pricing amount" value="{{ old('amount') }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">ABN</label>
                                    <input type="text" class="form-control" name="abn" placeholder="Enter item ABN"
                                        value="{{ old('abn') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="location" placeholder="Enter Address"
                                        value="{{ old('location') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">City<span>*</span></label>
                                    <input type="text" class="form-control" id="city-input" name="city"
                                        placeholder="Enter City" value="{{ old('city') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" id="state-input" name="state"
                                        placeholder="Enter State" value="{{ old('state') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country-input" name="country"
                                        placeholder="Enter Country" value="{{ old('country') }}">
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
                                                @if(old('price_condition')==$value) checked @endif>

                                            <label for="{{ strtolower($value) }}-check" class="form-check-text">{{
                                                $value }}</label>
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
                                                name="ad_category" value="{{ $value }}" @if (old('ad_category')==$value)
                                                checked @endif>
                                            <label style="color: #fff !important;" for="{{ strtolower($value) }}-check"
                                                class="flat-badge {{ strtolower($value) }}">{{ $value }}</label>
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
                                                @if(old('product_condition')==$value) checked @endif>
                                            <label for="{{ strtolower($value) }}-check" class="form-check-text">{{
                                                $value }}</label>
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
                                        name="description">{{ old('description') }}</textarea>

                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Languages</label>
                                    <select class="form-control add_multi_ads select2" id="select_languages"
                                        multiple="multiple" name="languages[]">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Tags</label>
                                    <select class="form-control add_multi_ads select2" id="select_tag"
                                        multiple="multiple" name="tags[]">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Owner Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="author_name" class="form-control" placeholder="Owner Name"
                                        value="{{ old('author_name') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="author_email" class="form-control"
                                        placeholder="Owner Email" value="{{ old('author_email') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="number" name="author_phone" id="phone" class="form-control"
                                        placeholder="Owner Number" value="{{ old('author_phone') }}">
                                    <span id="phoneError" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="author_address" class="form-control"
                                        placeholder="Owner Address" value="{{ old('author_address') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="variants-card d-none">
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
                                            <td><button type="button" class="btn-upload"><i class="fa fa-upload" aria-hidden="true"></i> Upload Image</button></td>
                                        `;
                                        tableBody.appendChild(tr);
                                        skuCounter++;
                                    });
                                }
                            });

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
                    </script>


                    <div class="adpost-card pb-2">
                        <div class="adpost-agree">
                            <div class="form-group d-flex">
                                <input type="checkbox" name="terms" class="form-check" id="agreeCheckbox" style="">
                                <p for="agreeCheckbox">
                                    Send me Trade Email/SMS Alerts for people looking to buy mobile handsets in www. By
                                    clicking "Post," you agree to our <a href="{{ route('terms-of-use') }}">Terms of Use</a> and <a
                                        href="{{ route('privacy-policy') }}">Privacy Policy</a> and acknowledge that you are the rightful owner
                                    of this item and using Trade to find a genuine buyer.
                                            </p>
                            </div>
                        </div>

                        <div>
                            <p class="checkbox-message" style="display: none; color: red;">Please check the box to
                                publish your ad</p>
                        </div>
                        <div class="form-group text-right">
                            <button id="submitButton" type="submit" class="btn btn-inline" disabled>
                                <i class="fas fa-check-circle"></i>
                                <span>Publish your ad</span>
                            </button>
                            <div id="loader" class="spinner-border text-primary" role="status" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
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
               
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script> 

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
        async defer></script>

    <script>
      
        function initialize() {
            var cityInput = document.getElementById("city-input");
            var stateInput = document.getElementById("state-input");
            var countryInput = document.getElementById("country-input");
            var options = { componentRestrictions: { country: "AU" }, types: ["(cities)"] };
            var autocomplete = new google.maps.places.Autocomplete(cityInput, options);
            autocomplete.addListener("place_changed", function () {
                var place = autocomplete.getPlace();
                console.log(place);
                var city = place.name;
                var state = "";
                var country = "";
                for (var i = 0; i < place.address_components.length; i++) {
                    var component = place.address_components[i];
                    if (component.types.includes("administrative_area_level_1")) {
                        state = component.long_name;
                    } else if (component.types.includes("country")) {
                        country = component.long_name;
                    }
                }
                cityInput.value = city;
                stateInput.value = state;
                countryInput.value = country;
            });
            cityInput.addEventListener("keydown", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    return !1;
                }
            });
        }
        
var base_url = "{{ url('/') }}";
$(document).ready(function () {
    $(".add_multi_ads").select2({ tags: !0, tokenSeparators: [",", " "] });
    $("#adDescription").summernote({ height: 150 });
    var checkbox = $("#agreeCheckbox");
    var submitButton = $("#submitButton");
    var message = $(".checkbox-message");
    checkbox.change(function () {
        submitButton.prop("disabled", !this.checked);
        message.toggle(!this.checked);
    });
    $("#prd_category").each(function () {
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
                    return { _token: "{{ csrf_token() }}", searchTerm: params.term };
                },
                processResults: function (data) {
                    return { results: data.categories };
                },
                cache: !0,
            },
        });
    });
    $("#prd_category").on("select2:select", function (e) {
        var data = e.params.data;
        $("#prd_subcategory").each(function () {
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
    $("#prd_category").on("select2:select", function (e) {
        var data = e.params.data;
        var categoryId = data.id;
        var categoryName = data.text;
        $("#category_name").val(categoryName);
    });
    function validatePhoneNumber(phoneNumber) {
        var phonePattern = /^\d{10}$/;
        return phonePattern.test(phoneNumber);
    }
    $("#adForm").submit(function (e) {
        var phoneNumber = $("#phone").val();
        if (phoneNumber && !validatePhoneNumber(phoneNumber)) {
            $("#phoneError").text("Please enter a valid 10-digit phone number.");
            e.preventDefault();
        } else {
            $("#phoneError").text("");
        }
    });
    $("#phone").on("input", function () {
        var phoneNumber = $(this).val();
        if (phoneNumber.length > 10) {
            $(this).val(phoneNumber.substring(0, 10));
            $("#phoneError").text("Please enter only 10 digits.");
        } else if (phoneNumber && !validatePhoneNumber(phoneNumber)) {
            $("#phoneError").text("Please enter a valid 10-digit phone number.");
        } else {
            $("#phoneError").text("");
        }
    });
});
$("input:checkbox").on("click", function () {
    var $box = $(this);
    if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", !1);
        $box.prop("checked", !0);
    } else {
        $box.prop("checked", !1);
    }
});
$(document).ready(function () {
    $("#input-file").fileinput({
        theme: "fa",
        allowedFileExtensions: ["jpg", "png", "gif", "pdf", "webp"],
        maxFileSize: 2048,
        overwriteInitial: !1,
        maxFileCount: 10,
        showUpload: !0,
        showRemove: !0,
        showClose: !1,
        initialPreview: [],
        initialPreviewConfig: [],
    });
    let uploadedImages = [];
    $("#imagePreviewContainer .row").empty();
    $("#input-file").on("filebatchselected", function (event, files) {
        if (files.length > 10) {
            alert("You can only upload a maximum of 10 images");
            $("#input-file").fileinput("clear");
            return;
        }
        $.each(files, function (index, file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        const imageId = "imageContainer" + index;
        const imgHtml =
            '<div class="col-md-2 mb-2 image-container" id="' + imageId + '">' +
            '<img loading="eager" src="' + e.target.result + '" class="preview-image"><br>' +
            '<a href="#" title="Delete image" class="btn btn-sm btn-danger delete-image-btn"><i class="fas fa-trash-alt"></i></a>' +
            '<label><input type="radio" name="is_primary" class="primary-image" value="' + index + '"> Primary</label>' +
            '</div>';
        $(imgHtml).appendTo("#imagePreviewContainer .row");
        uploadedImages.push({ id: imageId, src: e.target.result });
    };
    reader.readAsDataURL(file);
});


$(document).on("change", "input.primary-image", function () {
    $("input.primary-image").not(this).prop("checked", false);
});



    });
    $(document).on("click", ".delete-image-btn", function (event) {
        event.preventDefault();
        const $imageContainer = $(this).closest(".image-container");
        $imageContainer.remove();
        updatePrimaryCheckbox();
    });
    function updatePrimaryCheckbox() {
        const primaryCheckboxes = $("input.primary-image");
        if (primaryCheckboxes.length === 1) {
            primaryCheckboxes.prop("checked", !0);
        }
        if (primaryCheckboxes.filter(":checked").length === 0 && primaryCheckboxes.length !== 0) {
        }
    }
    
    $("#submit-button").on("click", function (e) {
        if ($(".image-container").length > 0 && $("input.primary-image:checked").length === 0) {
            e.preventDefault();
            alert("Please select a primary image.");
            return !1;
        }
    });
    let currentIndex = -1;
    function updateHighlight(lis) {
        lis.forEach((li, index) => {
            if (index === currentIndex) {
                li.classList.add("highlighted");
            } else {
                li.classList.remove("highlighted");
            }
        });
    }
    $("#adForm").on("submit", function (e) {
    e.preventDefault();

    $("#submitButton").prop("disabled", true);
    $("#loader").show();

    var formData = new FormData(this);

    if (!formData.has("terms") || !$("#agreeCheckbox").is(":checked")) {
        alert("Please agree to the terms of use before submitting.");
        $("#submitButton").prop("disabled", false);
        $("#loader").hide();
        return;
    }

    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            toastr.success(data.success);
            $("#adForm")[0].reset();
            $(".select2").val(null).trigger("change");
            $(".form-check").prop("checked", false).trigger("change");
            $("#input-file").fileinput("clear");
            $(".form-check-input").prop("checked", false);
            $(".default-radio").prop("checked", true);
            $("#imagePreviewContainer .row").html("");
            $(".checkbox-message").hide();

            if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                $("#submitButton").prop("disabled", false);
                $("#loader").hide();
            }
        },
        error: function (response) {
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
                Object.keys(errors).forEach(function (key) {
                    toastr.error(errors[key]);
                });
            } else {
                toastr.error("An error occurred. Please try again.");
            }

            $("#submitButton").prop("disabled", false);
            $("#loader").hide();
        },
    });
});

});

</script>

@endpush




@endsection