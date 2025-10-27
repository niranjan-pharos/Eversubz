@extends('layouts.eventlayout')

@section('title', 'Register NGO | Eversabz')
@section('description', 'Register a new NGO with Eversabz.')

@section('content')
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
            rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<style>
    .container {
        max-width: 1000px;
        margin: auto;
        padding-top: 30px;
        padding-bottom: 50px;
    }

    h1 {
        margin-bottom: 30px;
        font-weight: 700;
        text-align: center;
        font-size: 36px;
    }

    .card {
        border: 1px solid #000;
        border-radius: 10px;
        padding: 25px 30px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        background: #fff;
    }

    .section-title {
        background: #f2f4f7;
        padding: 10px 15px;
        border-left: 4px solid #027bdd;
        border-radius: 5px;
        font-weight: 600;
        margin: 30px 0 20px;
        font-size: 16px;
    }

    label {
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        display: block !important;
        width: 100% !important;
        padding: .375rem .75rem !important;
        font-size: 1rem !important;
        line-height: 1.5 !important;
        color: #000 !important;
        background-color: #fff !important;
        border: 1px solid #dedee3 !important;
        height: 40px !important;
        border-radius: .25rem !important;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out  !important;
    }

    .form-control:focus {
        outline: none;
        border-color: #027bdd;
        box-shadow: 0 0 5px rgba(2, 123, 221, 0.3);
    }

    textarea.form-control {
        height: auto;
        min-height: 100px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
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

    .col-md-2, .col-md-3, .col-md-4, .col-md-6, .col-md-12 {
        flex: 1;
        min-width: 200px;
    }

    .submit-btn {
        background-color: #027bdd;
        border: none;
        color: #fff;
        padding: 10px 25px;
        font-weight: 500;
        border-radius: 10px;
        width: 160px;
        transition: 0.3s;
    }

    .submit-btn:hover {
        background-color: #025ba3;
    }

    .cancel-btn {
        background-color: #dedee3;
        border: none;
        color: #000;
        padding: 10px 25px;
        font-weight: 500;
        border-radius: 10px;
        width: 140px;
        transition: 0.3s;
    }

    .cancel-btn:hover {
        background-color: grey;
    }

    .text-danger{
        color: red;
        font-weight: 700;
    }

    /* Base styling for checkbox/radio */
        .form-check-input {
          width: 20px;
          height: 20px;
          border: 2px solid #007bff; /* blue border */
          border-radius: 4px; /* square checkboxes, use 50% for round radios */
          background-color: #fff;
          appearance: none; /* Remove default style */
          -webkit-appearance: none;
          outline: none;
          cursor: pointer;
          position: relative;
          transition: all 0.2s ease-in-out;
          margin-top: -30px !important;
        }

        /* Hover effect */
        .form-check-input:hover {
          border-color: #0056b3;
          box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        /* Checked state */
        .form-check-input:checked {
          background-color: #007bff;
          border-color: #007bff;
        }

        /* Checkmark for checkbox */
        .form-check-input:checked::after {
          content: '';
          position: absolute;
          top: 2px;
          left: 6px;
          width: 5px;
          height: 10px;
          border: solid #fff;
          border-width: 0 2px 2px 0;
          transform: rotate(45deg);
        }

        /* Disabled state */
        .form-check-input:disabled {
          cursor: not-allowed;
          background-color: #e9ecef;
          border-color: #ced4da;
        }


     @media only screen and (max-width: 767px) {
      .submit-btn {
        width: 160px;
        margin-bottom: 20px;
      }  
     }
</style>

<div class="container">
    <div class="card">
        <h1>Register NGO</h1>
        <form action="{{ route('ngo.stores') }}" enctype="multipart/form-data" method="POST" id="add_ngo">
            @csrf
            <input type="hidden" name="created_by_admin" value="1">
            <input type="hidden" name="status" value="1">

            <!-- Personal Info -->
            <div class="section-title">Personal Info</div>
            <div class="row">
                <div class="col-md-3">
                    <label>NGO Name <sup class="text-danger">*</sup></label>
                    <input class="form-control" type="text" name="ngo_name" required>
                </div>
                <div class="col-md-3">
                    <label>Email</label>
                    <input class="form-control" type="email" name="contact_email">
                </div>
                <div class="col-md-3">
                    <label>Establishment Year</label>
                    <input class="form-control yearpicker" type="text" name="establishment">
                </div>
                <div class="col-md-3">
                    <label>Languages</label>
                    <select class="form-control select2 add_multi_language" id="languages" name="languages[]" multiple="multiple"></select>
                </div>
            </div>

            <!-- NGO Info -->
            <div class="section-title">NGO Info</div>
            <div class="row">
                <div class="col-md-3">
                    <label>ABN</label>
                    <input class="form-control" type="text" name="abn">
                </div>
                <div class="col-md-3">
                    <label>ACNC</label>
                    <input class="form-control" type="text" name="acnc">
                </div>
                <div class="col-md-3">
                    <label>GST</label>
                    <input class="form-control" type="text" name="gst">
                </div>
                <div class="col-md-3">
                    <label>Category <sup class="text-danger">*</sup></label>
                    <select class="form-control select2 ajax_category" name="cat_id"></select>
                </div>
                <div class="col-md-3">
                    <label>NGO Size</label>
                    <select class="form-control" name="size">
                        <option value="">Select Size</option>
                        <option value="large">Large</option>
                        <option value="medium">Medium</option>
                        <option value="small">Small</option>
                    </select>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="section-title">Contact Info</div>
            <div class="row">
                <div class="col-md-4">
                    <label>Address</label>
                    <input type="text" name="ngo_address" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>City <sup class="text-danger">*</sup></label>
                    <input type="text" name="ngo_city" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>State</label>
                    <input type="text" name="ngo_state" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Country</label>
                    <input type="text" name="ngo_country" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Contact Phone</label>
                    <input class="form-control" type="number" name="contact_phone" maxlength="20">
                </div>
                <div class="col-md-4">
                    <label>Website URL</label>
                    <input class="form-control" type="url" name="website_url">
                </div>
            </div>

            <!-- Social Media Info -->
            <div class="section-title">Social Media Info</div>
            <div class="row">
                <div class="col-md-3">
                    <label>Facebook URL</label>
                    <input class="form-control" type="text" name="facebook_url">
                </div>
                <div class="col-md-3">
                    <label>Twitter URL</label>
                    <input class="form-control" type="text" name="twitter_url">
                </div>
                <div class="col-md-3">
                    <label>Instagram URL</label>
                    <input class="form-control" type="text" name="instagram_url">
                </div>
                <div class="col-md-3">
                    <label>LinkedIn URL</label>
                    <input class="form-control" type="text" name="linkedin_url">
                </div>
            </div>

            <!-- Other Info -->
            <div class="section-title">Other Info</div>
            <div class="row">
                <div class="col-md-2">
                    <label>Feature</label><br>
                    <input type="checkbox" name="feature" value="1" class="form-check-input">
                </div>
                <div class="col-md-2">
                    <label>Order By</label>
                    <input type="text" name="orderby" class="form-control" value="0">
                </div>
                <div class="col-md-4">
                    <label>Logo/Main Image</label>
                    <input type="file" name="logo_path" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Other Images</label>
                    <input type="file" name="other_images[]" class="form-control" multiple>
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea class="form-control" id="adDescription" name="ngo_description" style="display: none !important;">{{ old('ngo_description') }}</textarea>
                    <p id="charCount" class="text-muted">0 / 5000 characters</p>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn submit-btn">Submit</button>
                <a href="{{ route('ngo.list') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
            </div>

        </form>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('admin_assets/js/select2.full.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script>
    $(document).ready(function() {

        $('.ajax_category').select2({
            theme: 'bootstrap4',
            placeholder: '--- Search Category ---',
            allowClear: true,
            ajax: {
                url: "{{ route('ajaxSearchNgoCategorys') }}",
                type: "POST",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        searchTerm: params.term
                    };
                },
                processResults: function(data) {
                    return { results: data };
                }
            }
        });

        $(".add_multi_language").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        var maxChars = 5000;
        var charCount = $('#charCount');
        var adDescription = $('#adDescription');

        adDescription.summernote({
            height: 150,
            callbacks: {
                onKeyup: updateCharCount,
                onChange: updateCharCount
            }
        });

        function updateCharCount() {
            var currentChars = adDescription.summernote('code').replace(/(<([^>]+)>)/gi, "").length;
            charCount.text(currentChars + ' / ' + maxChars + ' characters');
            if (currentChars > maxChars) {
                var truncatedText = adDescription.summernote('code').replace(/(<([^>]+)>)/gi, "").substring(0, maxChars);
                adDescription.summernote('code', truncatedText);
                charCount.text(maxChars + ' / ' + maxChars + ' characters');
            }
        }

        updateCharCount();

        $('#add_ngo').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message || 'NGO registered successfully!');
                    $('#add_ngo')[0].reset();
                    $('.select2').val(null).trigger('change');
                    adDescription.summernote('code', '');
                    charCount.text('0 / ' + maxChars + ' characters');

                    setTimeout(function() {
                        window.location.href = "{{ route('ngo.list') }}";
                    }, 1500);
                },
                error: function(xhr) {
                    if(xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value){
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Something went wrong. Please try again!');
                    }
                }
            });
        });

    });
</script>

@endpush
@endsection
