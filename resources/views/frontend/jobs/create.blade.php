@extends('frontend.template.master')
@section('title',  "Create Job")

@section('content')
@include('frontend.template.usermenu')

@push('style')
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

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
    height: 40px !important;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    box-shadow: none ! IMPORTANT;

    border: 1px solid #00000040 !important;
}
.select2-container {
    width: 100%
}

</style>
@endpush

<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Create Job</h3>
                    </div>
                    <form id="jobForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-12 mb-3">
                                <label for="title">Job Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <!-- Title -->
                            <div class="col-md-6 mb-3">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" required>
                            </div>
 
                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control select2" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6 mb-3">
                                <label for="location_id">Location/Address</label>
                                <input type="text" name="location_id" id="location_id" class="form-control">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="location_id">City</label>
                                <input type="text" name="city" id="city-input" class="form-control">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="location_id">State</label>
                                <input type="text" name="state" id="state-input" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="location_id">Country</label>
                                <input type="text" name="country" id="country-input" class="form-control">
                            </div>

                            <!-- salary -->
                            <div class="col-md-6 mb-3">
                                <label for="salary">Salary</label>
                                <input type="number" step="0.01" name="salary" id="salary" class="form-control">
                            </div>

                            <!-- Job Role -->
                            <div class="col-md-6 mb-3">
                                <label for="job_role">Job Role</label>
                                <input type="text" name="job_role" id="job_role" class="form-control" required>
                            </div>

                            <!-- Experience -->
                            <div class="col-md-6 mb-3">
                                <label for="experience_id">Experience Level</label>
                                <select name="experience_id" id="experience_id" class="form-control select2" required>
                                    <option value="" disabled selected>Select Experience</option>
                                    @foreach(config('jobs.experience_levels') as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Job Mode -->
                            <div class="col-md-6 mb-3">
                                <label for="job_mode">Job Mode</label>
                                <select name="job_mode" id="job_mode" class="form-control select2" >
                                    <option value="" disabled selected>Select Job Mode</option>
                                    @foreach(config('jobs.job_modes') as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            
                            <!-- Payment Type -->
                            <div class="col-md-6 mb-3">
                                <label for="payment_type">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control">
                                    <option value="" disabled selected>Select Payment Type</option>
                                    @foreach (config('jobs.payment_types') as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            

                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            </div>

                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control summernote" rows="4"></textarea>
                            </div>

                            <!-- Requirements -->
                            <div class="col-md-12 mb-3">
                                <label for="requirements">Requirements</label>
                                <textarea name="requirements" id="requirements" class="form-control summernote" rows="4"></textarea>
                            </div>

                            <!-- Skills -->
                            <div class="col-md-6 mb-3">
                                <label for="skills">Skills</label>
                                <select class="form-control add_multi_ads select2" id="select_skills"
                                    multiple="multiple" name="skills[]">
                                </select>
                            </div>

                            <!-- Tags -->
                            <div class="col-md-6 mb-3">
                                <label for="tags">Tags</label>
                                <select class="form-control add_multi_ads select2" id="select_tag"
                                    multiple="multiple" name="tags[]">
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Create Job</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
        async defer></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            height: 150
        });
    });

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

    $(document).ready(function() {
        $(".add_multi_ads").select2({ tags: true, tokenSeparators: [",", " "] });

        $('.summernote').summernote({
            height: 200
        });

        $('#select_skills').select2({
            placeholder: 'Search for skills',
            tags: true, 
            multiple: true,
            ajax: {
                url: '{{route('ajaxSearchSkills')}}',
                dataType: 'json',
                delay: 250, 
                processResults: function (data) {
                    return {
                        results: data.results 
                    };
                },
                cache: true
            }
        });

        $('#jobForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let submitButton = form.find('button[type="submit"]');
            let originalText = submitButton.text();

            submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('jobs.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message, 'Success');
                    form[0].reset();
                    $('.select2').val(null).trigger('change');
                    $('.summernote').summernote('code', '');
                    $('#requirements').summernote('code', '');
                },
                error: function(xhr) {
                    try {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            Object.values(errors).forEach(error => {
                                toastr.error(error[0], 'Error');
                            });
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Something went wrong. Please try again.', 'Error');
                        }
                    } catch (e) {
                        toastr.error('Session expired or unauthorized. Please login again.', 'Error');
                        window.location.href = '/login';
                    }
                },
                complete: function() {
                    submitButton.prop('disabled', false).text(originalText);
                }
            });
        });

    });

</script>

@endpush

@endsection
