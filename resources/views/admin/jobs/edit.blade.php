@extends('admin.template.master')

@section('content')

<div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>

            <div class="row">
                <div class="col float-right ml-auto">
                    <a href="{{ route('jobsList')}}" class="btn btn-primary mb-2" style="float:right"><i
                            class="fa fa-mail-reply"></i> Job List </a>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            
                            <form action="{{ route('job.update', ["id" => $job->id]) }}" enctype="multipart/form-data" method="post" role="form" id="edit_job">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Job Title :<sup class="text-danger">*</sup></label>
                                                <input class="form-control" type="text" required name="job_title" value="{{ old('job_title', $job->job_title) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Company Name :<sup class="text-danger">*</sup></label>
                                                <input class="form-control" type="text" required name="company_name" value="{{ old('company_name', $job->company_name) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Category :</label>
                                                <select class="form-control required select2 ajax_category" name="category_id">
                                                    <option value="{{ $job->category_id }}" selected>{{ $job->category->name ?? 'Select Category' }}</option>
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Phone :</label>
                                                <input class="form-control" type="number" name="contact_phone" value="{{ old('contact_phone', $job->contact_phone) }}" maxlength="20">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Website URL :</label>
                                                <input class="form-control" type="url" name="website_url" value="{{ old('website_url', $job->website_url) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Address :</label>
                                                <input class="form-control" type="text" name="address" value="{{ old('address', $job->address) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">City :</label>
                                                <input class="form-control" type="text" name="city" id="city-input" value="{{ old('city', $job->city) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">State :</label>
                                                <input class="form-control" id="state-input" type="text" name="state" value="{{ old('state', $job->state) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Country :</label>
                                                <input class="form-control" type="text" id="country-input" name="country" value="{{ old('country', $job->country) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Salary :</label>
                                                <input class="form-control" type="text" name="salary" value="{{ old('salary', $job->salary) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Job Role :</label>
                                                <input class="form-control" type="text" name="job_role" value="{{ old('job_role', $job->job_role) }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Experience Level :</label>
                                                <select name="experience_id" id="experience_id" class="form-control select2" required>
                                                    <option value="" disabled>Select Experience</option>
                                                    @foreach(config('jobs.experience_levels') as $key => $label)
                                                        <option value="{{ $key }}" {{ $job->experience_id == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Job Mode :</label>
                                                <select name="job_mode" id="job_mode" class="form-control select2">
                                                    <option value="" disabled>Select Job Mode</option>
                                                    @foreach(config('jobs.job_modes') as $key => $label)
                                                        <option value="{{ $key }}" {{ $job->job_mode == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Payment Type :</label>
                                                <select name="payment_type" id="payment_type" class="form-control">
                                                    <option value="" disabled>Select Payment Type</option>
                                                    @foreach(config('jobs.payment_types') as $key => $label)
                                                        <option value="{{ $key }}" {{ $job->payment_type == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Upload Image :</label>
                                                <input class="form-control" type="file" name="image" id="image" accept="image/*">
                                                @if($job->image)
                                                    <img src="{{ asset('storage/' . $job->image) }}" alt="Current Image" style="max-width: 100px; max-height: 100px;" class="mt-2">
                                                    <input type="hidden" name="existing_image" value="{{ $job->image }}">
                                                @endif
                                            </div>
                                        </div>
                            
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description" class="col-form-label">Description :</label>
                                                <textarea class="form-control summernote" id="description" rows="4" name="description">{{ old('description', $job->description) }}</textarea>
                                            </div>
                                        </div>
                            
                                        <div class="col-md-12 mb-3">
                                            <label for="requirements">Requirements</label>
                                            <textarea name="requirements" id="requirements" class="form-control summernote" rows="4">{{ old('requirements', $job->requirements) }}</textarea>
                                        </div>
                            
                                        <div class="col-md-6 mb-3">
                                            <label for="skills">Skills</label>
                                            <select class="form-control add_multi_skills select2" id="select_skills" multiple="multiple" name="skills[]">
                                                @foreach($job->skills as $skill)
                                                    <option value="{{ $skill->id }}" selected>{{ $skill->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                            
                                        <div class="col-md-6 mb-3">
                                            <label for="tags">Tags</label>
                                            <select class="form-control add_multi_ads select2" id="select_tag" multiple="multiple" name="tags[]">
                                                @foreach($job->tags as $tag)
                                                    <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                            
                                        <div class="col-md-6 mb-3">
                                            <label for="is_featured">Is Featured?</label><br>
                                            <label class="radio-inline">
                                                <input type="radio" name="is_featured" value="1" {{ $job->is_featured ? 'checked' : '' }}> Yes
                                            </label>
                                            <label class="radio-inline ml-2">
                                                <input type="radio" name="is_featured" value="0" {{ !$job->is_featured ? 'checked' : '' }}> No
                                            </label>
                                        </div>
                            
                                        <div class="col-md-6 mb-3">
                                            <label for="is_urgent">Is Urgent?</label><br>
                                            <label class="radio-inline">
                                                <input type="radio" name="is_urgent" value="1" {{ $job->is_urgent ? 'checked' : '' }}> Yes
                                            </label>
                                            <label class="radio-inline ml-2">
                                                <input type="radio" name="is_urgent" value="0" {{ !$job->is_urgent ? 'checked' : '' }}> No
                                            </label>
                                        </div>
                                    </div>
                            
                                    <div class="submit-section">
                                        <button id="submit_button" class="btn btn-primary submit-btn">Update</button>
                                        <br>
                                        <div id="loader" style="display: none;" class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
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

    $('.ajax_category').each(function() {
        $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: '--- Search Category ---',
            allowClear: true,
            ajax: {
                url: "{{route('ajaxSearchJobsCategory')}}",
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

    $(document).ready(function() {
        $('#edit_job').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#loader').show(); 
            $('#submit_button').prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response && response.success) {
                        toastr.success(response.success);
                        setTimeout(function() {
                            window.location.href = "{{ route('jobsList') }}";
                        }, 1500);

                        $('#loader').hide();
                        $('#submit_button').prop('disabled', false);
                    } else {
                        toastr.error('Unknown error occurred.');
                        $('#loader').hide();
                        $('#submit_button').prop('disabled', false);
                    }
                },
                error: function(xhr) {
                    $('#loader').hide(); 
                    $('#submit_button').prop('disabled', false);
                    if (xhr.status === 422) { 
                        let errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            errors[key].forEach(function(message) {
                                toastr.error(message); 
                            });
                        });
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                }
            });
        });
    });


</script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .ui-datepicker-calendar {
        display: none !important;
    }

    .ui-datepicker-month {
        display: none !important;
    }

    .ui-priority-secondary {
        display: none !important;
    }

    .col-sm-2.weekdays {
        display: flex;
        align-items: center;
        padding-left: 40px;
    }

    .col-form-label {
        color: #000;
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
        height: 40px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #fff;
        opacity: 1;
    }

    .form-control:focus {
        outline: none;
        box-shadow: none;
        color: #000;
        background: #fff;
        border-color: var(--primary);
    }

    .info {
        background-color: #e7e7e796;
        padding: 10px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .col-sm-2.weekdays {
        display: flex;
        align-items: center;
        padding-left: 40px;
    }

    .glyphicon-chevron-up:before {
        content: "\e113";
    }

    .glyphicon-chevron-down:before {
        content: "\e114";
    }
</style>
@endsection