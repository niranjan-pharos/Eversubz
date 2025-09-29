@extends('layouts.eventlayout')
@section('title', 'Fundraiser Details | Eversabz')
@section('description', 'Welcome to Eversabz')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    /* Remove Bootstrap gray shading and shadow */
    .form-control {
        background-color: #fff !important;
        border: 1px solid #ced4da !important;
        box-shadow: none !important;
    }

    .form-control:focus {
        background-color: #fff !important;
        border-color: #86b7fe !important; /* Bootstrap blue border on focus */
        box-shadow: none !important;
    }
</style>

<div class="container mt-4">
    <h3 class="mb-4">Candidate Form</h3>
    <form id="candidate_form" method="POST">
        @csrf

        <!-- Username -->
        <div class="card mb-3">
            <div class="card-header fw-bold">Basic Information</div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Row 1 -->
                    <div class="col-md-4">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" autocomplete="off" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>

                    <!-- Row 2 -->
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                    </div>
                </div>
            </div>
        </div>


        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach (($jobCategories ?? []) as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

        </div>

        <!-- About Candidate -->
        <div class="mb-3">
            <label class="form-label">About Candidate</label>
            <textarea name="about" class="form-control" rows="3" placeholder="Write about candidate..."></textarea>
        </div>

        <div class="row g-3 mb-3">
            <!-- DOB -->
            <div class="col-md-4">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control">
            </div>

            <!-- Gender -->
            <div class="col-md-4">
                <label class="form-label d-block mb-3">Gender</label>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Male" class="form-check-input">
                    <label class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Female" class="form-check-input">
                    <label class="form-check-label">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Other" class="form-check-input">
                    <label class="form-check-label">Other</label>
                </div>
            </div>

            <!-- Profession -->
            <div class="col-md-4">
                <label class="form-label">Profession</label>
                <input type="text" name="profession" class="form-control" placeholder="Enter Profession">
            </div>
        </div>

        <!-- Education -->
        <h5 class="mt-4">Education</h5>
        <div id="education-section">
            <div class="education-block border rounded p-3 mb-3">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="education[0][degree]" class="form-control" placeholder="Degree">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="education[0][institute]" class="form-control" placeholder="Institute">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="education[0][field]" class="form-control" placeholder="Field of Study">
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="date" name="education[0][from_date]" class="form-control" placeholder="From Date">
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="date" name="education[0][to_date]" class="form-control" placeholder="To Date">
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-check">
                            <input type="checkbox" name="education[0][ongoing]" class="form-check-input ongoingCheck">
                            <label class="form-check-label">Ongoing</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="add-education" class="btn btn-outline-primary btn-sm mb-3">+ Add More Education</button>


        <!-- Permanent Address -->
        <div class="card mb-3">
            <div class="card-header fw-bold">Permanent Address</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="permanent[address]" class="form-control" placeholder="Street Address">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="permanent[city]" class="form-control city-autocomplete" placeholder="City">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="permanent[state]" class="form-control" placeholder="State">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="permanent[country]" class="form-control" placeholder="Country">
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Documents -->
        <div class="mb-3">
            <label class="form-label">Upload Documents</label>
            <input type="file" name="documents[]" class="form-control" multiple>
        </div>

        <!-- Uploaded Docs List (dummy example - load from DB in controller) -->
        @if($documents ?? [])
            <div class="mb-3">
                <h6>Uploaded Documents</h6>
                <ul class="list-group">
                    @foreach (($documents ?? []) as $doc)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $doc->filename }}
                            <button type="button" class="btn btn-sm btn-outline-primary view-doc" data-url="{{ asset('storage/documents/'.$doc->filename) }}">
                                <i class="fa fa-eye"></i>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Save -->
        <button type="submit" class="btn btn-success mb-4">Save</button>
    </form>
</div>

<!-- Document Preview Modal -->
<div class="modal fade" id="docModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Document Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <iframe id="docFrame" src="" width="100%" height="600px"></iframe>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initAutocomplete">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('candidate_form');
    form.addEventListener('keypress', function(e){
        if(e.key === 'Enter') e.preventDefault();
    });

    const segments = window.location.pathname.split('/');
    const fundraising_slug = segments[segments.length - 1];

    let eduIndex = 1;
    document.getElementById('add-education').addEventListener('click', function() {
        const newBlock = document.createElement('div');
        newBlock.classList.add('education-block', 'border', 'rounded', 'p-3', 'mb-3');
        newBlock.innerHTML = `
            <div class="row g-2">
                <div class="col-md-4"><input type="text" name="education[${eduIndex}][degree]" class="form-control" placeholder="Degree"></div>
                <div class="col-md-4"><input type="text" name="education[${eduIndex}][institute]" class="form-control" placeholder="Institute"></div>
                <div class="col-md-4"><input type="text" name="education[${eduIndex}][field]" class="form-control" placeholder="Field of Study"></div>
                <div class="col-md-6 mt-2"><input type="date" name="education[${eduIndex}][from_date]" class="form-control"></div>
                <div class="col-md-6 mt-2"><input type="date" name="education[${eduIndex}][to_date]" class="form-control"></div>
                <div class="col-md-12 mt-2">
                    <div class="form-check">
                        <input type="checkbox" name="education[${eduIndex}][ongoing]" class="form-check-input ongoingCheck">
                        <label class="form-check-label">Ongoing</label>
                    </div>
                </div>
            </div>`;
        document.getElementById('education-section').appendChild(newBlock);
        eduIndex++;
    });

    document.addEventListener('change', function(e){
        if(e.target.classList.contains('ongoingCheck')){
            const toDate = e.target.closest('.education-block').querySelector('input[name*="[to_date]"]');
            toDate.disabled = e.target.checked;
            if(e.target.checked) toDate.value = '';
        }
    });

    document.addEventListener('click', function(e){
        const btn = e.target.closest('.view-doc');
        if(btn){
            const fileUrl = btn.getAttribute('data-url');
            document.getElementById('docFrame').src = fileUrl;
            $('#docModal').modal('show');
        }
    });

    function initAutocomplete() {
        const cityInputs = document.querySelectorAll('.city-autocomplete');
        const options = { componentRestrictions: { country: 'AU' }, types: ['(cities)'] };

        cityInputs.forEach(input => {
            const autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                let city = '', state = '', country = '';

                if(place.address_components){
                    place.address_components.forEach(c => {
                        if(c.types.includes('locality')) city = c.long_name;
                        if(c.types.includes('administrative_area_level_1')) state = c.long_name;
                        if(c.types.includes('country')) country = c.long_name;
                    });
                }

                input.value = city;

                const group = input.closest('.card-body');
                if(group){
                    const stateInput = group.querySelector('input[name$="[state]"]');
                    const countryInput = group.querySelector('input[name$="[country]"]');
                    if(stateInput) stateInput.value = state;
                    if(countryInput) countryInput.value = country;
                }
            });
        });
    }

    window.initAutocomplete = initAutocomplete;

    if (!form) return;

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const segments = window.location.pathname.split('/');
        const fundraising_slug = segments[segments.length - 1];

        const formData = new FormData(form);
        formData.append('fundraising_slug', fundraising_slug);

        const educationBlocks = document.querySelectorAll(".education-block");
        const education = [];
        educationBlocks.forEach((block, index) => {
            const degree    = block.querySelector(`input[name="education[${index}][degree]"]`)?.value || null;
            const institute = block.querySelector(`input[name="education[${index}][institute]"]`)?.value || null;
            const field     = block.querySelector(`input[name="education[${index}][field]"]`)?.value || null;
            const from_date = block.querySelector(`input[name="education[${index}][from_date]"]`)?.value || null;
            const to_date   = block.querySelector(`input[name="education[${index}][to_date]"]`)?.value || null;
            const ongoing   = block.querySelector(`input[name="education[${index}][ongoing]"]`)?.checked ? 1 : 0;

            if (degree || institute || field || from_date || to_date) {
                education.push({ degree, institute, field, from_date, to_date, ongoing });
            }
        });

        formData.append('education_json', JSON.stringify(education));

        const documentInputs = document.querySelector("input[name='documents[]']");
        if (documentInputs && documentInputs.files.length) {
            Array.from(documentInputs.files).forEach((file, i) => {
                formData.append('documents[]', file);
            });
        }

        try {
            const response = await fetch(form.dataset.action || "/category-candidates/store", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: formData
            });

            let result;
            try {
                result = await response.json();
            } catch (err) {
                toastr.error('Unexpected server response. Please try again.');
                return;
            }

            if (result.success) {
                toastr.success("Record saved successfully!");
                form.reset();
            } else {
                if (result.errors) {
                    Object.values(result.errors).flat().forEach(msg => toastr.error(msg));
                } else {
                    toastr.error("Something went wrong. Please try again.");
                }
            }

        } catch (error) {
            console.error("Error:", error);
            toastr.error("Something went wrong! Check console.");
        }
    });
});
</script>






@endsection
