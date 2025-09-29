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
                            <form id="add_professionals" action="{{ route('adminStoreProfessionals') }}" enctype="multipart/form-data" method="post" role="form">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Username</label>
                                                <input class="form-control" type="text" required name="username" value="">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Full Name</label>
                                                <input class="form-control" type="text" required name="name" value="">
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Email</label>
                                                <input class="form-control" type="email" required name="email" value="">
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Phone</label>
                                                <input class="form-control" type="text" name="phone" value="">
                                            </div>
                                        </div>
                                     </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <hr>
                                               <label class="col-form-label">Category</label>
                                             </div>
                                            @foreach($jobCategories as $category)
                                                <div class="col-sm-2">
                                                    <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat_{{ $category->id }}">
                                                    <label class="form-check-label" for="cat_{{ $category->id }}">{{ $category->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-sm-12">
                                                <hr>
                                             </div>
                                        </div>
                                    <div class="row">
                                     
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">About Candidate</label>
                                                <textarea class="form-control" name="about" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Gender</label>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div>
                                                        <input type="radio" name="gender" id="gender_male" value="Male">
                                                        <label for="gender_male">Male</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="gender" id="gender_female" value="Female">
                                                        <label for="gender_female">Female</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="gender" id="gender_other" value="Other">
                                                        <label for="gender_other">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">DOB</label>
                                                <input class="form-control" type="date" name="dob" value="">
                                            </div>
                                        </div>                                        

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Salary</label>
                                                <input class="form-control" type="text" name="salary" value="">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Profession</label>
                                                <input class="form-control" type="text" name="profession" value="">
                                            </div>
                                        </div>                                        
                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">LinkedIn URL</label>
                                                <input class="form-control" type="text" name="linkedin" value="">
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">GitHub URL</label>
                                                <input class="form-control" type="text" name="github" value="">
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Website URL</label>
                                                <input class="form-control" type="text" name="website_url" value="">
                                            </div>
                                        </div>

                                        <div class="col-sm-3 form-group">
                                            <label for="profile_image" class="col-form-label">Profile Image</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                                        </div>
                                         <div class="col-sm-12">
                                           <hr>
                                         </div>
                                        <div class="col-md-12 mb-3 form-group">
                                            <label for="skills"><strong>Skills</strong></label>
                                            <div id="skills-container" class="row">
                                                @foreach($allSkills as $skill)
                                                <div class="col-md-2 skill-item mb-2">
                                                    <input type="checkbox" name="skills[{{ $skill->id }}][id]" value="{{ $skill->id }}">
                                                    <label>{{ $skill->skill_name }}</label><br />
                                                    <select name="skills[{{ $skill->id }}][proficiency_level]" class="form-control d-inline-block w-auto">
                                                        <option value="beginner">Beginner</option>
                                                        <option value="intermediate">Intermediate</option>
                                                        <option value="expert">Expert</option>
                                                    </select>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                 <div class="col-sm-12">
                                           <hr>
                                         </div>
                                        <div class="col-md-12 mb-3 form-group">
                                            <label for="languages"><strong>Languages</strong></label>
                                            <div id="languages-container" class="row">
                                                <div class="col-md-2 language-item mb-3">
                                                    <input type="text" name="languages[0][language_name]" class="form-control mb-2" placeholder="Language Name">
                                                    <select name="languages[0][proficiency_level]" class="form-control mb-2">
                                                        <option value="Basic">Basic</option>
                                                        <option value="Fluent">Fluent</option>
                                                        <option value="Native">Native</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="button" id="add-language" class="btn btn-success">Add More Languages</button>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                           <hr>
                                         </div>
                            
                                        <div class="col-md-12 mb-3">
                                            <label for="education"><strong>Education</strong></label>
                                            <div id="education-container">
                                                <div class="education-item mb-3">
                                                    <input type="text" name="educations[0][degree]" class="form-control mb-2" placeholder="Degree">
                                                    <input type="text" name="educations[0][institution]" class="form-control mb-2" placeholder="Institution">
                                                    <input type="text" name="educations[0][field_of_study]" class="form-control mb-2" placeholder="Field of Study">
                                                    <input type="date" name="educations[0][from_date]" class="form-control mb-2" placeholder="From Date">
                                                    <input type="date" name="educations[0][to_date]" class="form-control mb-2" placeholder="To Date">
                                                </div>
                                            </div>
                                            <button type="button" id="add-education" class="btn btn-success btn-sm">Add More Education</button>
                                        </div>
                                        <div class="col-sm-12">
                                           <hr>
                                         </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="experience"><strong>Experience</strong></label>
                                            <div id="experience-container">
                                            </div>
                                            
                                            <button type="button" id="add-experience" class="btn btn-success btn-sm">Add Experience</button>
                                        </div>                            
                                        <div class="col-sm-12">
                                           <hr>
                                         </div>
                                        <div class="address-group row" id="permanent-address-group">
                                            <label for="permanent_address"><strong>Permanent Address</strong></label>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Address</label>
                                                    <input type="text" class="form-control" name="permanent_address">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">City</label>
                                                    <input type="text" class="form-control city-input" name="permanent_address" id="city-input">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">State</label>
                                                    <input type="text" class="form-control state-input" name="permanent_state" id="state-input">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Country</label>
                                                    <input type="text" class="form-control country-input" name="permanent_country" id="country-input">
                                                </div>
                                            </div>
                                        </div>
                            <div class="col-sm-12">
                                           <hr>
                                         </div>
                                        <div class="address-group row" id="mailing-address-group">
                                            <label for="mailing_address"><strong>Mailing Address</strong></label>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Address</label>
                                                    <input type="text" class="form-control"  name="mailing_address" >
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">City</label>
                                                    <input type="text" class="form-control city-input"  name="mailing_city" >
                                                </div>
                                            </div>
                                
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">State</label>
                                                    <input type="text" class="form-control state-input"  name="mailing_state" >
                                                </div>
                                            </div>
                                
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Country</label>
                                                    <input type="text" class="form-control country-input"  name="mailing_country" >
                                                </div>
                                            </div>
                                        </div>
                            <div class="col-sm-12">
                                           <hr>
                                         </div>
                                        <div class="col-sm-3 mb-3 form-group">
                                            <label for="resume">Upload Resume</label>
                                            <input type="file" name="resume" id="resume" class="form-control" accept="image/*,.pdf">
                                        </div>
                                        <div class="col-sm-12">
                                           <hr>
                                         </div>
                                        
                                        <div id="loader" style="display: none; margin-top: 15px;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Processing...
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
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

<style>
    
@media only screen and (min-width: 767px) {
     .education-item input {
    width: 25%;
    display: inline-block;
    margin-right: 10px; /* optional spacing */
}
}
</style>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
            async defer></script>
<script>
    function initialize() {
        var cityInputs = document.getElementsByClassName('city-input');
        var options = {
            componentRestrictions: { country: 'AU' },
            types: ['(cities)']
        };

        for (var i = 0; i < cityInputs.length; i++) {
            (function(input) {
                var autocomplete = new google.maps.places.Autocomplete(input, options);

                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    var city = place.name;
                    var state = '';
                    var country = '';

                    for (var j = 0; j < place.address_components.length; j++) {
                        var component = place.address_components[j];
                        if (component.types.includes('administrative_area_level_1')) {
                            state = component.long_name;
                        } else if (component.types.includes('country')) {
                            country = component.long_name;
                        }
                    }

                    var group = input.closest('.address-group');
                    var stateInput = group.querySelector('.state-input');
                    var countryInput = group.querySelector('.country-input');

                    input.value = city;
                    if (stateInput) stateInput.value = state;
                    if (countryInput) countryInput.value = country;
                });
            })(cityInputs[i]);
        }
    }



    let educationIndex = 1; 
    let experienceIndex = 0;

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

    document.getElementById('add-experience').addEventListener('click', function () {
        let container = document.getElementById('experience-container');
        let newExperience = `
            <div class="experience-item mb-3">
                <input type="text" name="experiences[${experienceIndex}][job_title]" class="form-control mb-2" placeholder="Job Title">
                <input type="text" name="experiences[${experienceIndex}][company]" class="form-control mb-2" placeholder="Company">
                <input type="date" name="experiences[${experienceIndex}][from_date]" class="form-control mb-2" placeholder="From Date">
                <input type="date" name="experiences[${experienceIndex}][to_date]" class="form-control mb-2" placeholder="To Date">
                <div class="form-check">
                    <input type="checkbox" name="experiences[${experienceIndex}][ongoing]" class="form-check-input" id="experience_ongoing_${experienceIndex}">
                    <label class="form-check-label" for="experience_ongoing_${experienceIndex}">Ongoing</label>
                </div>
                <textarea name="experiences[${experienceIndex}][description]" class="form-control mb-2" placeholder="Job Description"></textarea>
                <input type="text" name="experiences[${experienceIndex}][job_type]" class="form-control mb-2" placeholder="Job Type (e.g., Full-Time)">
                <input type="text" name="experiences[${experienceIndex}][location]" class="form-control mb-2" placeholder="Location (City, Country)">                
                <input type="text" name="experiences[${experienceIndex}][portfolio_url]" class="form-control mb-2" placeholder="Portfolio URL (optional)">
                <button type="button" class="btn btn-danger remove-experience">
                    Remove
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newExperience);
        experienceIndex++;
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
    let languageIndex = 1;

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