@extends('admin.template.master')
@section('content')
@push('style')
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
    rel="stylesheet" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css">

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
    box-shadow: none ! IMPORTANT;
    border: 1px solid #00000040 !important;
    }
    .form-control-category{height: 150px !important; overflow-y: scroll;}
    .form-group label {
        font-weight: 700;
        color: #000;
    }
    .skill-item div{display:flex; column-gap: 8px;font-size:14px;}
    .category-part .row:nth-child(2) {
        justify-content: flex-start;
    }
</style>
@endpush

<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>
            <div class="row">
                <div class="col float-right ml-auto">
                    <a href="{{ route('professionalsList')}}" class="btn btn-primary mb-3" style="float:right"><i
                            class="fa fa-mail-reply"></i> Professional List </a>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form id="edit_professional" method="POST" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="row">
                                        <!-- Username -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Username</label>
                                                <input class="form-control" type="text" required name="username" value="{{ old('username', $user->username) }}">
                                            </div>
                                        </div>
                            
                                        <!-- Full Name -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Full Name</label>
                                                <input class="form-control" type="text" required name="name" value="{{ old('name', $user->name) }}">
                                            </div>
                                        </div>
                            
                                        <!-- Email -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Email</label>
                                                <input class="form-control" type="email" required name="email" value="{{ old('email', $user->email) }}">
                                            </div>
                                        </div>
                            
                                        <!-- Phone -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Phone</label>
                                                <input class="form-control" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                                            </div>
                                        </div>
                            
                                        <!-- Categories -->
                                        <div class="row">
                                            <label class="col-form-label">Category</label>
                                            @foreach($jobCategories as $category)
                                            <div class="col-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="categories[]"
                                                        value="{{ $category->id }}"
                                                        id="cat_{{ $category->id }}"
                                                        {{ in_array($category->id, old('categories', $user->candidateProfile?->categories->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cat_{{ $category->id }}">{{ $category->name }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                            
                                        <!-- About -->
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">About Candidate</label>
                                                <textarea class="form-control" name="about" rows="5">{{ old('about', $user->candidateProfile?->about) }}</textarea>
                                            </div>
                                        </div>
                            
                                        <!-- Gender -->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Gender</label>
                                                <div class="d-flex align-items-center gap-3">
                                                    @foreach(['Male','Female','Other'] as $gender)
                                                    <div>
                                                        <input type="radio" name="gender" id="gender_{{ strtolower($gender) }}" value="{{ $gender }}" {{ old('gender', optional($user->candidateProfile)->gender) == $gender ? 'checked' : '' }}>
                                                        <label for="gender_{{ strtolower($gender) }}">{{ $gender }}</label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Profession</label>
                                        <input class="form-control" type="text" name="profession" value="{{ old('profession', $user->candidateProfile->profession ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Linkedin</label>
                                        <input class="form-control" type="text" name="linkedin" value="{{ old('linkedin', $user->candidateProfile->linkedin_url ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Github</label>
                                        <input class="form-control" type="text" name="github" value="{{ old('github', $user->candidateProfile->github_url ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Website URL</label>
                                        <input class="form-control" type="text" name="website_url" value="{{ old('website_url', $user->candidateProfile->website_url ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">DOB</label>
                                        <input class="form-control" type="date" name="dob" value="{{ old('dob', $user->candidateProfile->dob ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Salary</label>
                                        <input class="form-control" type="text" name="salary" value="{{ old('salary', $user->candidateProfile->salary ?? '') }}">
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-3 form-group">
                                            <label for="profile_image" class="col-form-label">Profile Image</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                                            @if($user->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $user->image) }}" class="img-thumbnail" width="80">
                                            </div>
                                            @endif
                                        </div>
                            
                                        <!-- Skills -->
                                        <div class="col-md-12 mb-3 form-group">
                                            <label for="skills"><strong>Skills</strong></label>
                                            <div id="skills-container" class="row">
                                                @foreach($allSkills as $skill)
                                                @php
                                                    $checked = false;
                                                    $level = 'beginner';
                                                    foreach($user->candidateProfile->skills ?? [] as $userSkill) {
                                                        if ($userSkill->id == $skill->id) {
                                                            $checked = true;
                                                            $level = $userSkill->pivot->proficiency_level;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-md-2 skill-item mb-2">
                                                    <input type="checkbox" name="skills[{{ $skill->id }}][id]" value="{{ $skill->id }}" {{ $checked ? 'checked' : '' }}>
                                                    <label>{{ $skill->skill_name }}</label><br />
                                                    <select name="skills[{{ $skill->id }}][proficiency_level]" class="form-control d-inline-block w-auto">
                                                        <option value="beginner" {{ $level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                                        <option value="intermediate" {{ $level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                        <option value="expert" {{ $level == 'expert' ? 'selected' : '' }}>Expert</option>
                                                    </select>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                            
                                        <!-- Languages (loop over $user->candidateLanguages) -->
                                        <div class="col-md-12 mb-3 form-group">
                                            <label for="languages"><strong>Languages</strong></label>
                                            <div id="languages-container" class="row">
                                                @if($user->candidateLanguages->count())
                                                    @foreach($user->candidateLanguages as $i => $language)
                                                        <div class="col-md-2 language-item mb-3">
                                                            <input type="text" name="languages[{{ $i }}][language_name]" class="form-control mb-2" value="{{ old("languages.$i.language_name", $language->language_name) }}" placeholder="Language Name">
                                                            <select name="languages[{{ $i }}][proficiency_level]" class="form-control mb-2">
                                                                <option value="Basic" {{ $language->proficiency_level == 'Basic' ? 'selected' : '' }}>Basic</option>
                                                                <option value="Fluent" {{ $language->proficiency_level == 'Fluent' ? 'selected' : '' }}>Fluent</option>
                                                                <option value="Native" {{ $language->proficiency_level == 'Native' ? 'selected' : '' }}>Native</option>
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-2 language-item mb-3">
                                                        <input type="text" name="languages[0][language_name]" class="form-control mb-2" value="" placeholder="Language Name">
                                                        <select name="languages[0][proficiency_level]" class="form-control mb-2">
                                                            <option value="Basic">Basic</option>
                                                            <option value="Fluent">Fluent</option>
                                                            <option value="Native">Native</option>
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                            <button type="button" id="add-language" class="btn btn-success mt-2">Add Languages</button>
                                        </div>
                                        
                                        <div class="col-md-12 mb-3 form-group">
                                            <label for="education"><strong>Education</strong></label>
                                            <div id="education-container" class="row">
                                                @if($user->educations->count())
                                                    @foreach($user->educations as $i => $education)
                                                        <div class="col-md-12 education-item mb-3">
                                                            <input type="text" name="educations[{{ $i }}][degree]" class="form-control mb-2" value="{{ old("educations.$i.degree", $education->degree) }}" placeholder="Degree">
                                                            <input type="text" name="educations[{{ $i }}][institution]" class="form-control mb-2" value="{{ old("educations.$i.institution", $education->institution) }}" placeholder="Institution">
                                                            <input type="text" name="educations[{{ $i }}][field_of_study]" class="form-control mb-2" value="{{ old("educations.$i.field_of_study", $education->field_of_study) }}" placeholder="Field of Study">
                                                            <input type="date" name="educations[{{ $i }}][from_date]" class="form-control mb-2" value="{{ old("educations.$i.from_date", $education->from_date) }}" placeholder="From Date">
                                                            <input type="date" name="educations[{{ $i }}][to_date]" class="form-control mb-2" value="{{ old("educations.$i.to_date", $education->to_date) }}" placeholder="To Date">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-12 education-item mb-3">
                                                        <input type="text" name="educations[0][degree]" class="form-control mb-2" placeholder="Degree">
                                                        <input type="text" name="educations[0][institution]" class="form-control mb-2" placeholder="Institution">
                                                        <input type="text" name="educations[0][field_of_study]" class="form-control mb-2" placeholder="Field of Study">
                                                        <input type="date" name="educations[0][from_date]" class="form-control mb-2" placeholder="From Date">
                                                        <input type="date" name="educations[0][to_date]" class="form-control mb-2" placeholder="To Date">
                                                    </div>
                                                @endif
                                            </div>
                                            <button type="button" id="add-education" class="btn btn-success mt-2">Add More Education</button>
                                        </div>

                                        <div class="col-md-12 mb-3 form-group">
                                            <label for="experience"><strong>Experience</strong></label>
                                            <div id="experience-container" class="row">
                                                @if($user->experiences->count())
                                                    @foreach($user->experiences as $i => $experience)
                                                        <div class="col-md-12 experience-item mb-3">
                                                            <input type="text" name="experiences[{{ $i }}][job_title]" class="form-control mb-2" value="{{ old("experiences.$i.job_title", $experience->job_title) }}" placeholder="Job Title">
                                                            <input type="text" name="experiences[{{ $i }}][company]" class="form-control mb-2" value="{{ old("experiences.$i.company", $experience->company) }}" placeholder="Company">
                                                            <input type="date" name="experiences[{{ $i }}][from_date]" class="form-control mb-2" value="{{ old("experiences.$i.from_date", $experience->from_date) }}" placeholder="From Date">
                                                            <input type="date" name="experiences[{{ $i }}][to_date]" class="form-control mb-2" value="{{ old("experiences.$i.to_date", $experience->to_date) }}" placeholder="To Date" {{ $experience->ongoing ? 'disabled' : '' }}>
                                                            <div class="form-check">
                                                                <!-- Remove hidden input and rely on the checkbox for the ongoing value -->
                                                                <input type="checkbox" name="experiences[{{ $i }}][ongoing]" value="1" class="form-check-input ongoing-checkbox" id="experience_ongoing_{{ $i }}" {{ old("experiences.$i.ongoing", $experience->ongoing) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="experience_ongoing_{{ $i }}">Ongoing</label>
                                                            </div>
                                                            <textarea name="experiences[{{ $i }}][description]" class="form-control mb-2" placeholder="Job Description">{{ old("experiences.$i.description", $experience->description) }}</textarea>
                                                            <input type="text" name="experiences[{{ $i }}][location]" class="form-control mb-2" value="{{ old("experiences.$i.location", $experience->location) }}" placeholder="Location (City, Country)">
                                                            <input type="text" name="experiences[{{ $i }}][job_type]" class="form-control mb-2" value="{{ old("experiences.$i.job_type", $experience->job_type) }}" placeholder="Job Type (e.g., Full-Time)">
                                                            <input type="text" name="experiences[{{ $i }}][portfolio_url]" class="form-control mb-2" value="{{ old("experiences.$i.portfolio_url", $experience->portfolio_url) }}" placeholder="Portfolio URL (optional)">
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="col-md-12 experience-item mb-3">
                                                        <input type="text" name="experiences[0][job_title]" class="form-control mb-2" value="{{ old('experiences.0.job_title') }}" placeholder="Job Title">
                                                        <input type="text" name="experiences[0][company]" class="form-control mb-2" value="{{ old('experiences.0.company') }}" placeholder="Company">
                                                        <input type="date" name="experiences[0][from_date]" class="form-control mb-2" value="{{ old('experiences.0.from_date') }}" placeholder="From Date">
                                                        <input type="date" name="experiences[0][to_date]" class="form-control mb-2" value="{{ old('experiences.0.to_date') }}" placeholder="To Date">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="experiences[0][ongoing]" value="1" class="form-check-input ongoing-checkbox" id="experience_ongoing_0" {{ old('experiences.0.ongoing') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="experience_ongoing_0">Ongoing</label>
                                                        </div>
                                                        <textarea name="experiences[0][description]" class="form-control mb-2" placeholder="Job Description">{{ old('experiences.0.description') }}</textarea>
                                                        <input type="text" name="experiences[0][location]" class="form-control mb-2" value="{{ old('experiences.0.location') }}" placeholder="Location (City, Country)">
                                                        <input type="text" name="experiences[0][job_type]" class="form-control mb-2" value="{{ old('experiences.0.job_type') }}" placeholder="Job Type (e.g., Full-Time)">
                                                        <input type="text" name="experiences[0][portfolio_url]" class="form-control mb-2" value="{{ old('experiences.0.portfolio_url') }}" placeholder="Portfolio URL (optional)">
                                                    </div>
                                                @endif
                                                
                                            </div>
                                            <button type="button" id="add-experience" class="btn btn-success mt-2">Add More Experience</button>
                                        </div>
                                        
                                        
                            
                                        <div class="address-group row" id="permanent-address">
                                            <label for="permanent_address"><strong>Permanent Address</strong></label>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Address</label>
                                                    <input type="text" class="form-control" name="permanent_address" value="{{ old('permanent_address', $user->address) }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">City</label>
                                                    <input type="text" class="form-control city-autocomplete" name="permanent_city" value="{{ old('permanent_address', $user->permanent_city) }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">State</label>
                                                    <input type="text" class="form-control" name="permanent_state" value="{{ old('permanent_state', $user->permanent_state) }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Country</label>
                                                    <input type="text" class="form-control" name="permanent_country" value="{{ old('permanent_country', $user->permanent_country) }}">
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="address-group row" id="mailing-address">
                                            <label for="mailing_address"><strong>Mailing Address</strong></label>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Address</label>
                                                    <input type="text" class="form-control"  name="mailing_address" value="{{ old('address', $user->candidateProfile->address) }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">City</label>
                                                    <input type="text" class="form-control city-autocomplete"  name="mailing_city" value="{{ old('city', $user->candidateProfile->city) }}" >
                                                </div>
                                            </div>
                                
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">State</label>
                                                    <input type="text" class="form-control"  name="mailing_state" value="{{ old('state', $user->candidateProfile->state) }}" >
                                                </div>
                                            </div>
                                
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Country</label>
                                                    <input type="text" class="form-control"  name="mailing_country" value="{{ old('country', $user->candidateProfile->country) }}">
                                                </div>
                                            </div>
                                        </div>
                            
                                        <!-- Resume (show current if exists) -->
                                        <div class="col-sm-3 mb-3 form-group">
                                            <label for="resume">Upload Resume</label>
                                            <input type="file" name="resume" id="resume" class="form-control" accept="image/*,.pdf">
                                            @if($user->candidateProfile && $user->candidateProfile->resume)
                                            <a href="{{ asset('storage/'.$user->candidateProfile->resume) }}" target="_blank" class="d-block mt-2">View Current Resume</a>
                                            @endif
                                        </div>
                                        
                                        <div id="loader" style="display: none; margin-top: 15px;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Processing...
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
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



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize">
    </script>
<script>
    function initialize() {
        var cityInputs = document.querySelectorAll('.city-autocomplete');
        var options = {
            componentRestrictions: { country: 'AU' },
            types: ['(cities)']
        };

        cityInputs.forEach(function(input) {
            var autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                var city = place.name;
                var state = '';
                var country = '';

                if (place.address_components) {
                    place.address_components.forEach(function(component) {
                        if (component.types.includes('administrative_area_level_1')) {
                            state = component.long_name;
                        }
                        if (component.types.includes('country')) {
                            country = component.long_name;
                        }
                    });
                }

                var group = input.closest('.address-group');
                if (group) {
                    var stateInput = group.querySelector('input[name$="_state"]');
                    var countryInput = group.querySelector('input[name$="_country"]');
                    input.value = city;
                    if (stateInput) stateInput.value = state;
                    if (countryInput) countryInput.value = country;
                } else {
                    input.value = city;
                }
            });
        });
    }


    $(document).ready(function () {
        $(".add_multi_ads").select2({
            tags: true,
            tokenSeparators: [",", " "]
        });

        



        $('#edit_professional').on('submit', function (e) {
            e.preventDefault();

            $('.submit-btn').attr('disabled', true);
            $('#loader').show();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('updateProfessionalData', ['id' => $user->id]) }}", 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success(response.message, 'Success');
                    $('#edit_professional')[0].reset();
                    $('.select2').val(null).trigger('change');
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        Object.keys(errors).forEach(function(key) {
                            errors[key].forEach(function(message) {
                                toastr.error(message, 'Error');
                            });
                        });
                    } else {
                        toastr.error('Something went wrong. Please try again.', 'Error');
                    }
                },
                complete: function () {
                    $('.submit-btn').attr('disabled', false);
                    $('#loader').hide();
                }
            });
        });

    });

    let educationIndex = 1; 

    document.getElementById('add-education').addEventListener('click', function () {
        let container = document.getElementById('education-container');
        let newEducation = `
            <div class="education-item mb-3">
                <input type="text" name="educations[${educationIndex}][degree]" class="form-control mb-2" placeholder="Degree">
                <input type="text" name="educations[${educationIndex}][institution]" class="form-control mb-2" placeholder="Institution">
                <input type="text" name="educations[${educationIndex}][field_of_study]" class="form-control mb-2" placeholder="Field of Study">
                <input type="date" name="educations[${educationIndex}][from_date]" class="form-control mb-2" placeholder="From Date">
                <input type="date" name="educations[${educationIndex}][to_date]" class="form-control mb-2" placeholder="To Date">
                <button type="button" class="btn btn-danger remove-education">
                    Remove
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newEducation);
        educationIndex++;
    });

    let experienceIndex = {{ $user->experiences->count() ?? 1 }};

    document.getElementById('add-experience').addEventListener('click', function () {
        let container = document.getElementById('experience-container');
        let newExperience = `
            <div class="col-md-12 experience-item mb-3">
                <input type="text" name="experiences[${experienceIndex}][job_title]" class="form-control mb-2" placeholder="Job Title">
                <input type="text" name="experiences[${experienceIndex}][company]" class="form-control mb-2" placeholder="Company">
                <input type="date" name="experiences[${experienceIndex}][from_date]" class="form-control mb-2" placeholder="From Date">
                <input type="date" name="experiences[${experienceIndex}][to_date]" class="form-control mb-2" placeholder="To Date">
                <div class="form-check">
                    <input type="checkbox" name="experiences[${experienceIndex}][ongoing]" value="1" class="form-check-input ongoing-checkbox" id="experience_ongoing_${experienceIndex}">
                    <label class="form-check-label" for="experience_ongoing_${experienceIndex}">Ongoing</label>
                </div>
                <textarea name="experiences[${experienceIndex}][description]" class="form-control mb-2" placeholder="Job Description"></textarea>
                <input type="text" name="experiences[${experienceIndex}][location]" class="form-control mb-2" placeholder="Location (City, Country)">
                <input type="text" name="experiences[${experienceIndex}][job_type]" class="form-control mb-2" placeholder="Job Type (e.g., Full-Time)">
                <input type="text" name="experiences[${experienceIndex}][portfolio_url]" class="form-control mb-2" placeholder="Portfolio URL (optional)">
                <button type="button" class="btn btn-danger remove-experience">Remove</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newExperience);
        experienceIndex++;
    });

    document.querySelector('form').addEventListener('submit', function () {
        const checkboxes = document.querySelectorAll('.form-check-input');
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                checkbox.value = '0';
            }
        });
    });


    document.getElementById('experience-container').addEventListener('change', function(e) {
        if (e.target.classList.contains('form-check-input')) {
            const experienceItem = e.target.closest('.experience-item');
            if (experienceItem) {
                const toDateInput = experienceItem.querySelector('input[name^="experiences"][name$="[to_date]"]');
                if (toDateInput) {
                    toDateInput.disabled = e.target.checked;
                    if (e.target.checked) {
                        toDateInput.value = '';
                    }
                }
            }
        }

        if (e.target.name && e.target.name.includes('to_date')) {
            const experienceItem = e.target.closest('.experience-item');
            if (experienceItem) {
                const fromDateInput = experienceItem.querySelector('input[name^="experiences"][name$="[from_date]"]');
                const toDateInput = e.target;
                if (fromDateInput && toDateInput) {
                    const fromDate = new Date(fromDateInput.value);
                    const toDate = new Date(toDateInput.value);
                    if (toDate < fromDate) {
                        alert("The 'To Date' cannot be earlier than the 'From Date'.");
                        toDateInput.value = ''; 
                    }
                }
            }
        }
    });



    document.getElementById('experience-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-experience')) {
            e.target.closest('.experience-item').remove();
        }
    });



    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-education')) {
            e.target.closest('.education-item').remove();
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-experience')) {
            e.target.closest('.experience-item').remove();
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        let languageIndex = document.querySelectorAll('.language-item').length;

        const addLanguageButton = document.getElementById('add-language');

        if (addLanguageButton) {
            console.log("Button found");

            addLanguageButton.addEventListener('click', function () {
                console.log("Add Language Button clicked");

                let container = document.getElementById('languages-container');
                let newLanguage = `
                    <div class="col-md-2 language-item mb-3">
                        <input type="text" name="languages[${languageIndex}][language_name]" class="form-control mb-2" placeholder="Language Name">
                        <select name="languages[${languageIndex}][proficiency_level]" class="form-control mb-2">
                            <option value="Basic">Basic</option>
                            <option value="Fluent">Fluent</option>
                            <option value="Native">Native</option>
                        </select>
                        <button type="button" class="btn btn-danger remove-language">Remove</button>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', newLanguage);
                languageIndex++;
            });
        } else {
            console.log("Button not found!");
        }

        document.addEventListener('click', function (e) {
            if (e.target.closest('.remove-language')) {
                e.target.closest('.language-item').remove();
            }
            if (e.target.closest('.remove-education')) {
                e.target.closest('.education-item').remove();
            }
            if (e.target.closest('.remove-experience')) {
                e.target.closest('.experience-item').remove();
            }
        });
    });



</script>


@endsection