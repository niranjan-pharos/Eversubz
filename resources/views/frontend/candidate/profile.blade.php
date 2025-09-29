@extends('frontend.template.master')
@section('title', "Professional profile info")

@section('content')
@include('frontend.template.usermenu')
@push('style')
<link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
    rel="stylesheet" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css">
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
    height: 40px;
  
    border-radius: .25rem;
    /* transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out; */
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
<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Edit Candidate Profile</h3>
                    </div>
                    <form id="updateCandidateForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="bio" name="bio">
                        <div class="row">

                        <!-- Profile Image -->
                        <div class="col-md-4 mb-3 form-group">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control"
                                    accept="image/*">
                                @if($user->image)
                                <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name}}"
                                    style="max-height: 100px; margin-top: 10px;">
                                @endif
                            </div>
                            <!-- Full Name -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            <!-- DOB -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="profession">DOB</label>
                                <input type="date" name="dob" id="dob" class="form-control"
                                    value="{{ old('dob', $user->candidateProfile->dob ?? '') }}">
                            </div>

                           

                            <!-- Phone -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone', $user->phone ?? '') }}">
                            </div>

                            
                             <!-- category -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="category">Select Category</label>
                                <div class="form-control form-control-category">
                                    @foreach($jobCategories as $category)
                                        <div style="display:flex; column-gap: 10px;">
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{
                                                $user->candidateProfile &&
                                            $user->candidateProfile->categories->pluck('id')->contains($category->id) ?
                                            'checked' : '' }}>
                                            <p>{{ $category->name }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <!-- Permanent Address -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="address">Permanent Address</label>
                                <input type="text" name="permanent_address" id="permanent_address" class="form-control"
                                    value="{{ old('address', $user->address ?? '') }}">
                            </div>

                            <!-- City -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="city">City</label>
                                <input type="text" name="permanent_city" id="permanent_city" class="form-control"
                                    value="{{ old('city', $user->candidateProfile->city ?? '') }}">
                            </div>

                            <!-- State -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="state"> State</label>
                                <input type="text" name="permanent_state" id="permanent_state" class="form-control"
                                    value="{{ old('state', $user->candidateProfile->state ?? '') }}">
                            </div>

                            <!-- Country -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="country">Country</label>
                                <input type="text" name="permanent_country" id="permanent_country" class="form-control"
                                    value="{{ old('country', $user->candidateProfile->country ?? '') }}">
                            </div>

                            <!-- Mailing Address -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="address">Mailing Address</label>
                                <input type="text" name="mailing_address" id="mailing_address" class="form-control"
                                    value="{{ old('address', $user->candidateProfile->address ?? '') }}">
                            </div>

                            <!-- City -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="city">City</label>
                                <input type="text" name="mailing_city" id="mailing_city" class="form-control"
                                    value="{{ old('city', $user->candidateProfile->city ?? '') }}">
                            </div>

                            <!-- State -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="state">State</label>
                                <input type="text" name="mailing_state" id="mailing_state" class="form-control"
                                    value="{{ old('state', $user->candidateProfile->state ?? '') }}">
                            </div>

                            <!-- Country -->
                            <div class="col-md-6 mb-3 form-group">
                                <label for="country">Country</label>
                                <input type="text" name="mailing_country" id="mailing_country" class="form-control"
                                    value="{{ old('country', $user->candidateProfile->country ?? '') }}">
                            </div>

                            <!-- Profession -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="profession">Profession</label>
                                <input type="text" name="profession" id="profession" class="form-control"
                                    value="{{ old('profession', $user->candidateProfile->profession ?? '') }}">
                            </div>

                            <!-- Salary -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="salary">Salary</label>
                                <input type="text" name="salary" id="salary" class="form-control"
                                    value="{{ old('salary', $user->candidateProfile->salary ?? '') }}">
                            </div>


                            <!-- Gender -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="gender">Gender</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div>
                                        <input type="radio" name="gender" id="gender_male" value="Male" {{ old('gender',
                                            $user->candidateProfile->gender ?? '') === 'Male' ? 'checked' : '' }}>
                                        <label for="gender_male">Male </label>
                                    </div>
                                    <div>
                                        &nbsp;<input type="radio" name="gender" id="gender_female" value="Female" {{
                                            old('gender', $user->candidateProfile->gender ?? '') === 'Female' ?
                                        'checked' : '' }}>
                                        <label for="gender_female">Female</label>
                                    </div>
                                    <div>
                                        &nbsp;<input type="radio" name="gender" id="gender_other" value="Other" {{
                                            old('gender', $user->candidateProfile->gender ?? '') === 'Other' ? 'checked'
                                        : '' }}>
                                        <label for="gender_other">Other</label>
                                    </div>
                                </div>
                            </div>


                            <!-- Profession -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="linkedin">Linkedin URL</label>
                                <input type="text" name="linkedin" id="linkedin" class="form-control"
                                    value="{{ old('linkedin', $user->candidateProfile->linkedin_url ?? '') }}">
                            </div>

                            <!-- DOB -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="github">GitHub URL</label>
                                <input type="text" name="github" id="github" class="form-control"
                                    value="{{ old('github', $user->candidateProfile->github_url ?? '') }}">
                            </div>

                            <!-- DOB -->
                            <div class="col-md-4 mb-3 form-group">
                                <label for="website_url">Website URL</label>
                                <input type="text" name="website_url" id="website_url" class="form-control"
                                    value="{{ old('website_url', $user->candidateProfile->website_url ?? '') }}">
                            </div>


                            <!-- Upload Resume -->
                            <div class="col-md-8 mb-3 form-group">
                                <label for="resume">Upload Resume</label>
                                <input type="file" name="resume" id="resume" class="form-control"
                                    accept=".pdf,.doc,.docx">
                                        </div>
                                    <div class="col-md-4 mb-3 form-group" style="display:grid;">
                                @if(!empty($user->candidateProfile->resume))
                                <label>Current Resume: </label>

                                <a
                                        href="{{ asset('storage/' . $user->candidateProfile->resume) }}"
                                        target="_blank">View</a>
                                @endif
                                @error('resume')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <!-- Bio -->
                            <div class="col-md-12 mb-3 form-group">
                                <label for="about">Bio / Description</label>
                                <textarea name="about" id="about-summernote"
                                    class="form-control summernote">{{ old('about', $user->candidateProfile->about ?? '') }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="skills">Skills</label>
                                <div id="skills-container" class="row">
                                    @if($allSkills->isEmpty())
                                    <p>No skills available to select. Add new skills below.</p>
                                    @else
                                    @foreach($allSkills as $skill)

                                    <div class="col-md-2 skill-item mb-2">
                                        <!-- Skill checkbox -->
                                       <div>
                                       <input type="checkbox" name="skills[{{ $skill->id }}][id]"
                                            value="{{ $skill->id }}" {{ $user->candidateProfile &&
                                        $user->candidateProfile->skills->pluck('id')->contains($skill->id) ? 'checked' :
                                        '' }}>
                                        <label>{{ $skill->skill_name }}</label>
                                       </div>

                                        <!-- Proficiency level dropdown -->
                                        <select name="skills[{{ $skill->id }}][proficiency_level]"
                                            class="form-control d-inline-block w-auto">
                                            <option value="beginner" {{ $user->candidateProfile &&
                                                $user->candidateProfile->skills->where('id',
                                                $skill->id)->first()?->pivot->proficiency_level === 'beginner' ?
                                                'selected' : '' }}>
                                                Beginner
                                            </option>
                                            <option value="intermediate" {{ $user->candidateProfile &&
                                                $user->candidateProfile->skills->where('id',
                                                $skill->id)->first()?->pivot->proficiency_level === 'intermediate' ?
                                                'selected' : '' }}>
                                                Intermediate
                                            </option>
                                            <option value="expert" {{ $user->candidateProfile &&
                                                $user->candidateProfile->skills->where('id',
                                                $skill->id)->first()?->pivot->proficiency_level === 'expert' ?
                                                'selected' : '' }}>
                                                Expert
                                            </option>
                                        </select>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>



                                <!-- Add New Skill -->
                                <div class="mt-3">
                                    <label for="new_skill">Add New Skill</label>
                                    <input type="text" id="new_skill" class="form-control mb-2"
                                        placeholder="Enter new skill name">
                                    <button type="button" id="add-new-skill" class="btn btn-primary">Add Skill</button>
                                </div>
                            </div>



                            <!-- Languages -->
                            <div class="col-md-12 mb-3 form-group">
                                <label for="languages">Languages</label>

                                <div id="languages-container" class="row">
                                    @if($user->candidateLanguages->isEmpty())
                                    <!-- Empty language inputs for new entry -->
                                    <div class="col-md-2 language-item mb-3">
                                        <input type="text" name="languages[0][language_name]" class="form-control mb-2"
                                            placeholder="Language Name">
                                        <select name="languages[0][proficiency_level]" class="form-control mb-2">
                                            <option value="Basic">Basic</option>
                                            <option value="Fluent">Fluent</option>
                                            <option value="Native">Native</option>
                                        </select>
                                        <button type="button" class="btn btn-danger remove-language"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
                                        <path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
                                        </svg></button>
                                    </div>
                                    @else
                                    @foreach($user->candidateLanguages as $key => $language)
                                    <div class="col-md-2 language-item mb-3">
                                        <input type="text" name="languages[{{ $key }}][language_name]"
                                            class="form-control mb-2"
                                            value="{{ old('languages[' . $key . '][language_name]', $language->language_name) }}"
                                            placeholder="Language Name">
                                        <select name="languages[{{ $key }}][proficiency_level]"
                                            class="form-control mb-2">
                                            <option value="Basic" {{ $language->proficiency_level === 'Basic' ?
                                                'selected' : '' }}>Basic
                                            </option>
                                            <option value="Fluent" {{ $language->proficiency_level === 'Fluent' ?
                                                'selected' : '' }}>Fluent
                                            </option>
                                            <option value="Native" {{ $language->proficiency_level === 'Native' ?
                                                'selected' : '' }}>Native
                                            </option>
                                        </select>
                                        <button type="button" class="btn btn-danger remove-language"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
                                        <path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
                                        </svg></button>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <button type="button" id="add-language" class="btn btn-success">Add More
                                    Languages</button>
                            </div>


                            <!-- Education -->
                            <div class="col-md-12 mb-3">
                                <label for="education">Education</label>
                                <div id="education-container">
                                    @if($user->educations->isEmpty())
                                    <!-- Empty input for new education -->
                                    <div class="education-item mb-3">
                                        <input type="text" name="educations[0][degree]" class="form-control mb-2"
                                            placeholder="Degree">
                                        <input type="text" name="educations[0][institution]" class="form-control mb-2"
                                            placeholder="Institution">
                                        <input type="text" name="educations[0][field_of_study]"
                                            class="form-control mb-2" placeholder="Field of Study">
                                        <label>From Date</label>
                                        <input type="date" name="educations[0][from_date]" class="form-control mb-2">
                                        <label>To Date</label>
                                        <input type="date" name="educations[0][to_date]" class="form-control mb-2">
                                        <div class="form-check">
                                            <input type="checkbox" name="educations[0][ongoing]"
                                                class="form-check-input" id="education_ongoing_0">
                                            <label class="form-check-label" for="education_ongoing_0">Ongoing</label>
                                        </div>
                                        <input type="text" name="educations[0][grade]" class="form-control mb-2"
                                            placeholder="Grade (e.g., GPA)">
                                        <input type="text" name="educations[0][location]" class="form-control mb-2"
                                            placeholder="Location (City, Country)">
                                        <textarea name="educations[0][achievements]" class="form-control mb-2"
                                            placeholder="Achievements (e.g., Awards, Scholarships)"></textarea>
                                        <textarea name="educations[0][description]" class="form-control mb-2"
                                            placeholder="Description"></textarea>
                                        <input type="text" name="educations[0][certificate_url]"
                                            class="form-control mb-2" placeholder="Certificate URL (optional)">
                                        <button type="button"
                                            class="btn btn-danger  btn-sm remove-education"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
                            <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
                            <path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
                            </svg></button>
                                    </div>
                                    @else
                                    @foreach($user->educations as $key => $education)
                                    <div class="education-item mb-3">
                                        <input type="text" name="educations[{{ $key }}][degree]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][degree]', $education->degree) }}"
                                            placeholder="Degree">
                                        <input type="text" name="educations[{{ $key }}][institution]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][institution]', $education->institution) }}"
                                            placeholder="Institution">
                                        <input type="text" name="educations[{{ $key }}][field_of_study]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][field_of_study]', $education->field_of_study) }}"
                                            placeholder="Field of Study">
                                        <label>From Date</label>
                                        <input type="date" name="educations[{{ $key }}][from_date]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][from_date]', optional($education->from_date)->format('Y-m-d')) }}">
                                        <label>To Date</label>
                                        <input type="date" name="educations[{{ $key }}][to_date]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][to_date]', optional($education->to_date)->format('Y-m-d')) }}">
                                        <div class="form-check">
                                            <input type="checkbox" name="educations[{{ $key }}][ongoing]"
                                                class="form-check-input" id="education_ongoing_{{ $key }}" {{
                                                $education->to_date === null ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="education_ongoing_{{ $key }}">Ongoing</label>
                                        </div>
                                        <input type="text" name="educations[{{ $key }}][grade]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][grade]', $education->grade) }}"
                                            placeholder="Grade (e.g., GPA)">
                                        <input type="text" name="educations[{{ $key }}][location]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][location]', $education->location) }}"
                                            placeholder="Location (City, Country)">
                                        <textarea name="educations[{{ $key }}][achievements]" class="form-control mb-2"
                                            placeholder="Achievements">{{ old('educations[' . $key . '][achievements]', $education->achievements) }}</textarea>
                                        <textarea name="educations[{{ $key }}][description]" class="form-control mb-2"
                                            placeholder="Description">{{ old('educations[' . $key . '][description]', $education->description) }}</textarea>
                                        <input type="text" name="educations[{{ $key }}][certificate_url]"
                                            class="form-control mb-2"
                                            value="{{ old('educations[' . $key . '][certificate_url]', $education->certificate_url) }}"
                                            placeholder="Certificate URL (optional)">
                                        <button type="button" class="btn btn-danger remove-education"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
                        <path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
                        </svg></button>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                                <button type="button" id="add-education" class="btn btn-success btn-sm">Add More
                                    Education</button>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="experience">Experience</label>
                                <div id="experience-container">
                                    @if($user->experiences->isEmpty())
                                    <!-- Empty input for new experience -->
                                    <div class="experience-item mb-3">
                                        <input type="text" name="experiences[0][job_title]" class="form-control mb-2"
                                            placeholder="Job Title">
                                        <input type="text" name="experiences[0][company]" class="form-control mb-2"
                                            placeholder="Company">
                                        <label>From Date</label>
                                        <input type="date" name="experiences[0][from_date]" class="form-control mb-2">
                                        <label>To Date</label>
                                        <input type="date" name="experiences[0][to_date]" class="form-control mb-2">
                                        <div class="form-check">
                                            <input type="checkbox" name="experiences[0][ongoing]"
                                                class="form-check-input" id="experience_ongoing_0">
                                            <label class="form-check-label" for="experience_ongoing_0">Ongoing</label>
                                        </div>
                                        <textarea row="4" name="experiences[0][description]" class="form-control mb-2"
                                            placeholder="Job Description"></textarea>
                                        <input type="text" name="experiences[0][location]" class="form-control mb-2"
                                            placeholder="Location (City, Country)">
                                        <input type="text" name="experiences[0][job_type]" class="form-control mb-2"
                                            placeholder="Job Type (e.g., Full-Time)">
                                        <input type="text" name="experiences[0][portfolio_url]"
                                            class="form-control mb-2" placeholder="Portfolio URL (optional)">
                                        <button type="button" class="btn btn-danger remove-experience"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
<path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
<path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
</svg></button>
                                    </div>
                                    @else
                                    @foreach($user->experiences as $key => $experience)
                                    <div class="experience-item mb-3">
                                        <input type="text" name="experiences[{{ $key }}][job_title]"
                                            class="form-control mb-2"
                                            value="{{ old('experiences[' . $key . '][job_title]', $experience->job_title) }}"
                                            placeholder="Job Title">
                                        <input type="text" name="experiences[{{ $key }}][company]"
                                            class="form-control mb-2"
                                            value="{{ old('experiences[' . $key . '][company]', $experience->company) }}"
                                            placeholder="Company">
                                        <label>From Date</label>
                                        <input type="date" name="experiences[{{ $key }}][from_date]"
                                            class="form-control mb-2"
                                            value="{{ old('experiences[' . $key . '][from_date]', $experience->from_date) }}">
                                        <label>To Date</label>
                                        <input type="date" name="experiences[{{ $key }}][to_date]"
                                            class="form-control mb-2"
                                            value="{{ old('experiences[' . $key . '][to_date]', $experience->to_date) }}">
                                        <div class="form-check">
                                            <input type="checkbox" name="experiences[{{ $key }}][ongoing]"
                                                class="form-check-input" id="experience_ongoing_{{ $key }}" {{
                                                $experience->to_date === null ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="experience_ongoing_{{ $key }}">Ongoing</label>
                                        </div>
                                        <textarea row="4" name="experiences[{{ $key }}][description]" class="form-control mb-2"
                                            placeholder="Job Description">{{ old('experiences[' . $key . '][description]', $experience->description) }}</textarea>
                                        <input type="text" name="experiences[{{ $key }}][location]"
                                            class="form-control mb-2"
                                            value="{{ old('experiences[' . $key . '][location]', $experience->location) }}"
                                            placeholder="Location (City, Country)">
                                        <input type="text" name="experiences[{{ $key }}][job_type]"
                                            class="form-control mb-2"
                                            value="{{ old('experiences[' . $key . '][job_type]', $experience->job_type) }}"
                                            placeholder="Job Type (e.g., Full-Time)">
                                        <input type="text" name="experiences[{{ $key }}][portfolio_url]"
                                            class="form-control mb-2"
                                            value="{{ old('experiences[' . $key . '][portfolio_url]', $experience->portfolio_url) }}"
                                            placeholder="Portfolio URL (optional)">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-experience"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
<path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
<path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
</svg></button>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <button type="button" id="add-experience" class="btn btn-success btn-sm">Add More
                                    Experience</button>
                            </div>




                            <!-- Submit Button -->
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
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
        var premanentCityInput = document.getElementById('permanent_city');
        var premanentStateInput = document.getElementById('permanent_state');
        var premanentCountryInput = document.getElementById('permanent_country');

        var mailingCityInput = document.getElementById('mailing_city');
        var mailingStateInput = document.getElementById('mailing_state');
        var mailingCountryInput = document.getElementById('mailing_country');

        var options = {
            componentRestrictions: {
                country: 'AU'
            },
            types: ['(cities)']
        };

        var premanentAutocomplete = new google.maps.places.Autocomplete(premanentCityInput, options);
        premanentAutocomplete.addListener('place_changed', function () {
            var place = premanentAutocomplete.getPlace();
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
            premanentCityInput.value = city;
            premanentStateInput.value = state;
            premanentCountryInput.value = country;
        });

        var mailingAutocomplete = new google.maps.places.Autocomplete(mailingCityInput, options);
        mailingAutocomplete.addListener('place_changed', function () {
            var place = mailingAutocomplete.getPlace();
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
            mailingCityInput.value = city;
            mailingStateInput.value = state;
            mailingCountryInput.value = country;
        });
    }

    $('#updateCandidateForm').on('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });


    $(document).ready(function () {
        $(".add_multi_ads").select2({
            tags: true,
            tokenSeparators: [",", " "]
        });

        $('.summernote').summernote({
            height: 200
        });

        $('#updateCandidateForm').on('submit', function (e) {
            e.preventDefault();

            $('#description').val($('.summernote').summernote('code'));
            $('#requirements').val($('.summernote').summernote('code'));

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('candidate.update',['id' => $user->id]) }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success(response.message, 'Success');
                    $('#jobForm')[0].reset();
                    $('.select2').val(null).trigger('change');
                    $('.summernote').summernote('code', '');
                    $('#requirements').summernote('code', '');
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        Object.values(errors).forEach(error => {
                            toastr.error(error[0], 'Error');
                        });
                    } else {
                        toastr.error('Something went wrong. Please try again.', 'Error');
                    }
                }
            });
        });
    });
</script>
<script>
    let educationIndex = {{ $user->educations->count() }};
    let experienceIndex = {{ $user->experiences->count() }};
    let languageIndex = {{ $user->candidateLanguages->count() }};

    document.getElementById('add-education').addEventListener('click', function () {
        let container = document.getElementById('education-container');
        let newEducation = `
            <div class="education-item mb-3">
                <input type="text" name="educations[${educationIndex}][degree]" class="form-control mb-2" placeholder="Degree">
                <input type="text" name="educations[${educationIndex}][institution]" class="form-control mb-2" placeholder="Institution">
                <input type="text" name="educations[${educationIndex}][field_of_study]" class="form-control mb-2" placeholder="Field of Study">
                <label>From Date</label>
                <input type="date" name="educations[${educationIndex}][from_date]" class="form-control mb-2">
                <label>To Date</label>
                <input type="date" name="educations[${educationIndex}][to_date]" class="form-control mb-2">
                <div class="form-check">
                    <input type="checkbox" name="educations[${educationIndex}][ongoing]" class="form-check-input" id="education_ongoing_${educationIndex}">
                    <label class="form-check-label" for="education_ongoing_${educationIndex}">Ongoing</label>
                </div>
                <textarea name="educations[${educationIndex}][description]" class="form-control mb-2" placeholder="Description"></textarea>
                <button type="button" class="btn btn-danger remove-education"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
<path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
<path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
</svg></button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newEducation);
        educationIndex++;
    });

    document.getElementById('add-experience').addEventListener('click', function () {
        let container = document.getElementById('experience-container');
        let newExperience = `
            <div class="experience-item mb-3">
                <input type="text" name="experiences[${experienceIndex}][job_title]" class="form-control mb-2" placeholder="Job Title">
                <input type="text" name="experiences[${experienceIndex}][company]" class="form-control mb-2" placeholder="Company">
                <label>From Date</label>
                <input type="date" name="experiences[${experienceIndex}][from_date]" class="form-control mb-2">
                <label>To Date</label>
                <input type="date" name="experiences[${experienceIndex}][to_date]" class="form-control mb-2">
                <div class="form-check">
                    <input type="checkbox" name="experiences[${experienceIndex}][ongoing]" class="form-check-input" id="experience_ongoing_${experienceIndex}">
                    <label class="form-check-label" for="experience_ongoing_${experienceIndex}">Ongoing</label>
                </div>
                <textarea name="experiences[${experienceIndex}][description]" class="form-control mb-2" placeholder="Job Description"></textarea>
                <input type="text" name="experiences[${experienceIndex}][location]" class="form-control mb-2" placeholder="Location (City, Country)">
                <button type="button" class="btn btn-danger remove-experience"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
<path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
<path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
</svg></button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newExperience);
        experienceIndex++;
    });

    document.getElementById('add-language').addEventListener('click', function () {
        let container = document.getElementById('languages-container');
        let newLanguage = `
            <div class="language-item mb-3">
                <input type="text" name="languages[${languageIndex}][language_name]" class="form-control mb-2" placeholder="Language Name">
                <select name="languages[${languageIndex}][proficiency_level]" class="form-control mb-2">
                    <option value="Basic">Basic</option>
                    <option value="Fluent">Fluent</option>
                    <option value="Native">Native</option>
                </select>
                <button type="button" class="btn btn-danger remove-language"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
<path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
<path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
</svg></button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newLanguage);
        languageIndex++;
    });

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

</script>
<script>
    document.getElementById('add-new-skill').addEventListener('click', function () {
        let newSkillName = document.getElementById('new_skill').value.trim();
        if (newSkillName === '') {
            alert('Please enter a skill name.');
            return;
        }

        let container = document.getElementById('skills-container');
        let newSkillId = 'new-' + Date.now();

        let newSkillHTML = `
            <div class="col-md-2 skill-item mb-2">
                <!-- New Skill Hidden Input -->
                <input type="hidden" name="skills[new][${newSkillId}][name]" value="${newSkillName}">
                <label>${newSkillName}</label>

                <!-- Proficiency Level Dropdown -->
                <select name="skills[new][${newSkillId}][proficiency_level]" class="form-control d-inline-block w-auto">
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Expert">Expert</option>
                </select>
                <button type="button" class="btn btn-danger remove-skill"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#ffffff"></path>
<path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#ffffff"></path>
<path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="white"></path>
</svg></button>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', newSkillHTML);
        document.getElementById('new_skill').value = '';
    });


    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-skill')) {
            e.target.closest('.skill-item').remove();
        }
    });
</script>

@endpush
@endsection