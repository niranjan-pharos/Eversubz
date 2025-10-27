@extends('admin.template.master')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#jobListing" data-bs-toggle="tab">Job
                                        Listing</a></li>
                                <li class="nav-item"><a class="nav-link" href="#createJob" data-bs-toggle="tab">Create
                                        Job</a></li>
                            </ul>

                            <div class="tab-content tab-content1">
                                <div class="tab-pane show active" id="jobListing" style="padding: 0px 8px;">
                                    <div class="table table-responsive">
                                        <table class="table custom-table mb-0" id="jobTable">
                                            <thead>
                                                <tr>
                                                    <th>Job</th>
                                                    <th>Company</th>
                                                    <th>Location</th>
                                                    <th> Category</th>
                                                    <th> Status</th>
                                                    <th>Created Date</th>
                                                    <th>Updated Date</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="createJob">
                                    <form action="{{ route('job.store') }}" enctype="multipart/form-data" method="post" role="form" id="add_job">
                                        @csrf
                                        <div class="col-md-12">
                                            
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Job Title :<sup class="text-danger">*</sup></label>
                                                        <input class="form-control" type="text" required name="job_title" value="{{ old('job_title') }}">
                                                    </div>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Company Name :<sup class="text-danger">*</sup></label>
                                                        <input class="form-control" type="text" required name="company_name" value="{{ old('company_name') }}">
                                                    </div>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Category :</label>
                                                        <select class="form-control required select2 ajax_category" name="category_id">
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Phone :</label>
                                                        <input class="form-control" type="number" name="contact_phone" value="{{ old('contact_phone') }}" maxlength="20">
                                                    </div>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Website URL :</label>
                                                        <input class="form-control" type="url" name="website_url" value="{{ old('website_url') }}">
                                                    </div>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Address :</label>
                                                        <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                                                    </div>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">City :</label>
                                                        <input class="form-control" type="text" name="city" id="city-input" value="{{ old('city') }}">
                                                    </div>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">State :</label>
                                                        <input class="form-control" id="state-input" type="text" name="state" value="{{ old('state') }}">
                                                    </div>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Country :</label>
                                                        <input class="form-control" type="text" id="country-input" name="country" value="{{ old('country') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Salary :</label>
                                                        <input class="form-control" type="text" name="salary" value="{{ old('salary') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Job Role :</label>
                                                        <input class="form-control" type="text" name="job_role" value="{{ old('job_role') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Experience Level :</label>
                                                        <select name="experience_id" id="experience_id" class="form-control select2" required>
                                                            <option value="" disabled selected>Select Experience</option>
                                                            @foreach(config('jobs.experience_levels') as $key => $label)
                                                            <option value="{{ $key }}">{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Job Mode :</label>
                                                        <select name="job_mode" id="job_mode" class="form-control select2" >
                                                            <option value="" disabled selected>Select Job Mode</option>
                                                            @foreach(config('jobs.job_modes') as $key => $label)
                                                            <option value="{{ $key }}">{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Payment Type :</label>
                                                        <select name="payment_type" id="payment_type" class="form-control">
                                                            <option value="" disabled selected>Select Payment Type</option>
                                                            @foreach (config('jobs.payment_types') as $key => $label)
                                                                <option value="{{ $key }}">{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Upload Image :</label>
                                                        <input class="form-control" type="file" name="image" id="image"  accept="image/*">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description" class="col-form-label">Description :</label>
                                                        <textarea class="form-control"  id="description" class="form-control summernote" rows="4" name="description"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 mb-3">
                                                    <label for="requirements">Requirements</label>
                                                    <textarea name="requirements" id="requirements" class="form-control summernote" rows="4"></textarea>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="skills">Skills</label>
                                                    <select class="form-control add_multi_skills select2" id="select_skills"
                                                        multiple="multiple" name="skills[]">
                                                    </select>
                                                </div>
                    
                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="tags">Tags</label>
                                                    <select class="form-control add_multi_ads select2" id="select_tag" multiple="multiple" name="tags[]">
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="is_featured">Is Featured?</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_featured" value="1" > Yes
                                                    </label>
                                                    <label class="radio-inline ml-2">
                                                        <input type="radio" name="is_featured" value="0" checked> No
                                                    </label>
                                                </div>
                                                
                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="is_urgent">Is Urgent?</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_urgent" value="1" > Yes
                                                    </label>
                                                    <label class="radio-inline ml-2">
                                                        <input type="radio" name="is_urgent" value="0" checked> No
                                                    </label>
                                                </div>

                                            </div>
                                            
                                            </div>
                                
                                            
                                
                                
                                            <div class="submit-section">
                                                <button id="submit_button" class="btn btn-primary submit-btn">Submit</button>
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

        
<!-- Delete confirmation Modal -->
<div class="modal custom-modal fade" id="delete_category" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Job</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->

<!-- remove brand modal -->
<div class="modal custom-modal fade" tabindex="-1" role="dialog" id="removeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header remove">

                <h4 class="modal-title">Remove Job</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form role="form" action="{{ route('admin.jobDelete') }}" method="post" id="removeForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">                   
                    <p>Do you really want to remove?</p>
                </div>
                <input type="hidden" name="job_id" id="job_id">
                <div class="modal-footer modal-footer-uniform">
                    <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-danger submit-btn">Delete Job</button>
                    <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                </div>
            </form>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
    async defer></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        var base_url = "{{ url('/admin/') }}";
        var jobTable;
        $(document).ready(function() {
            jobTable = $('#jobTable').DataTable({
                'ajax': "{{ route('fetchJobsData') }}",
                'order': [],

            });

            $('#description').summernote({
                height: 150
            });

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

            $('#select_tag').select2({
                tags: true, 
                tokenSeparators: [',', ' '], 
                placeholder: 'Enter tags separated by comma',
            });


            $('#add_job').submit(function(event) {
                event.preventDefault();
                
                var formData = new FormData(this); 
                
                $('#submit_button').prop('disabled', true);
                $('#loader').show();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(response.message);
                        clearForm();
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong, please try again!');
                    },
                    complete: function() {
                        $('#submit_button').prop('disabled', false);
                        $('#loader').hide();
                    }
                });
            });

            function clearForm() {
                $('#add_job')[0].reset();
                $('#select_skills').val([]).trigger('change');
                $('#select_tag').val([]).trigger('change');
                $('textarea').val('');
                $('#description').summernote('reset');
                $('#requirements').summernote('reset');
            }

            $('body').on('click', '.change-status', function() {
                let isCHecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{route('jobs.change-status')}}",
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: isCHecked,
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        toastr.success(response.message)
                    }
                })
            });


        });

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
                console.log(place); 
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
        };

        function removeFunc(id) {
            if (id) { 
                $("#removeForm").on('submit', function() {
                    var form = $(this);

                    $(".text-danger").remove();

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: {
                            "_token": "{{ csrf_token() }}",
                            del_id: id,
                            _method: 'DELETE'  
                        },
                        dataType: 'json',
                        success: function(response) {
                            jobTable.ajax.reload(null, false);
                            $("#removeModal").modal('hide');
                            console.log(response.message);
                            if (response.success === true) {
                                toastr.success(response.message);
                            } else {
                                if (response.error instanceof Array) {
                                        var errorMessages = '';
                                        $.each(response.error, function (key, value) {
                                            errorMessages += value.join('<br>'); 
                                        });
                                        toastr.error(errorMessages);
                                    } else {
                                        toastr.error(response.error);
                                    }
                                    
                                    $("#removeModal").modal('hide');
                            
                                }
                            }
                    });

                    return false;
                });
            }
        };

        function editFunc(id) {
            var baseUrl = '{{ url(' / ') }}';
            $.ajax({
                url: "{{ url('admin/job') }}/" + id + "/edit",
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    $("#edit_name").val(response.name);
                    if (response.status === 0) {
                        $("#edit_status").val('0');
                    } else {
                        $("#edit_status").val('1');
                    }
                    $("#cat_id").val(response.id);

                    $("#updateForm").unbind('submit').bind('submit', function() {
                        event.preventDefault();
                        var form = $(this); 
                        var formData = new FormData(form[0]);
                        $(".text-danger").remove();

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: formData,
                            dataType: 'json',
                            processData: false, 
                            contentType: false,
                            success: function(response) {
                                console.log(response);
                                categoryTable.ajax.reload(null, false);

                                if (response.success === true) {
                                    toastr.success(response.messages);
                                    $("#editModal").modal('hide');
                                    $("#updateForm .form-group").removeClass(
                                        'has-error').removeClass('has-success');

                                } else {
                                    if (response.error instanceof Array) {
                                        var errorMessages = '';
                                        $.each(response.error, function(key, value) {
                                            errorMessages += value.join(
                                                '<br>'
                                            );
                                        });
                                        toastr.error(errorMessages);
                                    } else {
                                        toastr.error(response.error);
                                    }

                                    $("#editModal").modal('hide');

                                }
                            }
                        });

                        return false;
                    });

                }
            });
        };

    </script>
    <style>
        .custom-table td:nth-child(8),
        .custom-table th:nth-child(8) {
          text-align: center;
        }

        .custom-table td:nth-child(8) {
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 8px;
        }

    </style>
@endsection
