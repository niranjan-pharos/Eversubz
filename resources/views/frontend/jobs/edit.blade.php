@extends('frontend.template.master')
@section('title',  "Edit Job")

@section('content')
@include('frontend.template.usermenu')

@push('style')
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">\
<style>
    .select2-container {
    width: 100%
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

    border: 1px solid #00000040 !important;
}
</style>
@endpush

<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Edit Job</h3>
                    </div>
                    <form id="updatejobForm" enctype="multipart/form-data" method="POST" action="{{ route('jobs.update', $job->slug) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="description" name="description">
                        <input type="hidden" id="requirements" name="requirements">
                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-12 mb-3">
                                <label for="title">Job Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                            </div>
                            
                            {{-- Company Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $job->company_name) }}" required>
                            </div>
                    
                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control select2" required>
                                    <option value="" disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $job->category_id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Location -->
                            <div class="col-md-6 mb-3">
                                <label for="location_id">Location/Address</label>
                                <input type="text" name="location_id" id="location_id" class="form-control" value="{{ old('location_id', $job->address) }}">
                            </div>
                    
                            <!-- City -->
                            <div class="col-md-6 mb-3">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city-input" class="form-control" value="{{ old('city', $job->city) }}">
                            </div>
                    
                            <!-- State -->
                            <div class="col-md-6 mb-3">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state-input" class="form-control" value="{{ old('state', $job->state) }}">
                            </div>
                    
                            <!-- Country -->
                            <div class="col-md-6 mb-3">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country-input" class="form-control" value="{{ old('country', $job->country) }}">
                            </div>
                    
                            <!-- Salary -->
                            <div class="col-md-6 mb-3">
                                <label for="salary">Salary</label>
                                <input type="number" step="0.01" name="salary" id="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
                            </div>
                    
                            <!-- Job Role -->
                            <div class="col-md-6 mb-3">
                                <label for="job_role">Job Role</label>
                                <input type="text" name="job_role" id="job_role" class="form-control" value="{{ old('job_role', $job->job_role) }}" required>
                            </div>
                    
                            <!-- Experience -->
                            <div class="col-md-6 mb-3">
                                <label for="experience_id">Experience Level</label>
                                <select name="experience_id" id="experience_id" class="form-control select2" required>
                                    <option value="" disabled>Select Experience Level</option>
                                    @foreach(config('jobs.experience_levels') as $key => $label)
                                        <option value="{{ $key }}" {{ $key == old('experience_id', $job->experience) ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Job Mode -->
                            <div class="col-md-6 mb-3">
                                <label for="job_mode">Job Type</label>
                                <select name="job_mode" id="job_mode" class="form-control select2">
                                    <option value="" disabled selected>Select Job Mode</option>
                                    @foreach(config('jobs.job_modes') as $key => $label)
                                        <option value="{{ $key }}" {{ old('job_mode', $job->job_mode) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>
                    
                            <!-- Payment Type -->
                            <div class="col-md-6 mb-3">
                                <label for="payment_type">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control">
                                    <option value="" disabled selected>Select Payment Type</option>
                                    @foreach(config('jobs.payment_types') as $key => $label)
                                        <option value="{{ $key }}" {{ old('payment_type', $job->payment_type) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                @if($job->image)
                                    <img src="{{ asset('storage/' . $job->image) }}" alt="Job Image" style="max-height: 100px; margin-top: 10px;">
                                @endif
                            </div>
                    
                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description-summernote" class="form-control summernote" rows="4" required>{{ old('description', $job->description) }}</textarea>
                            </div>
                    
                            <!-- Requirements -->
                            <div class="col-md-12 mb-3">
                                <label for="requirements">Requirements</label>
                                <textarea name="requirements" id="requirements-summernote"  class="form-control summernote" rows="4">{{ old('requirements', $job->requirements) }}</textarea>
                            </div>
                            {{-- {{dd($job)}} --}}
                            <div class="col-md-6 mb-3">
                                <label for="skills">Skills</label>
                                <select class="form-control add_multi_ads select2" id="select_skills" multiple="multiple" name="skills[]">
                                    @foreach($skills as $skill) <!-- Loop through all available skills -->
                                        <option value="{{ $skill->id }}" 
                                            {{ $job->skills->pluck('id')->contains($skill->id) ? 'selected' : '' }}>
                                            {{ $skill->skill_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Tags -->
                            <div class="col-md-6 mb-3">
                                <label for="tags">Tags</label>
                                <select class="form-control add_multi_ads select2" id="select_tag" multiple="multiple" name="tags[]">
                                    @foreach($job->tags as $tag)
                                        <option value="{{ $tag->tag_name }}" selected>{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Submit Button -->
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Update Job</button>
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

<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize">
</script>
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
                    state = component.long_name;
                } else if (component.types.includes('country')) {
                    country = component.long_name;
                }
            }
            cityInput.value = city;
            stateInput.value = state;
            countryInput.value = country;
        });
    }

    $(document).ready(function() {
        $(".add_multi_ads").select2({ tags: true, tokenSeparators: [",", " "] });

        $('.summernote').summernote({
            height: 200
        });

        $('#updatejobForm').on('submit', function(e) {
            e.preventDefault();

            $('#description').val($('#description-summernote').summernote('code'));
            $('#requirements').val($('#requirements-summernote').summernote('code'));

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: "{{ route('jobs.update', ['slug' => $job->slug]) }}", 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        toastr.error('You are not authorized to perform this action.', 'Unauthorized');
                    } else if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors) {
                            Object.values(errors).forEach(error => {
                                toastr.error(error[0], 'Validation Error');
                            });
                        }
                    } else if (xhr.status === 404) {
                        toastr.error('Job not found. Please check the details and try again.', 'Error');
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.', 'Error');
                    }
                }

            });
        });

    });

</script>

@endpush

@endsection
