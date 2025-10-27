@extends('admin.template.master')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.info {
    background-color: #e7e7e796;
    padding: 10px;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 0.5rem;
}
</style>
<style>
    /* mycss */
    .nav-tabs .nav-link {
        margin-bottom: -1px;
        background: 0 0;
        border: 1px solid #4e3a3a00 ! IMPORTANT;
        border-top-left-radius: 0.25rem ! IMPORTANT;
        border-top-right-radius: 0.25rem !important;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #495057 ! IMPORTANT;
        background-color: #fff ! IMPORTANT;
        border-color: #dee2e6 #dee2e6 #fff ! IMPORTANT;
        border-top: 2px solid #027bdd ! IMPORTANT;
    }

    .form-control {
        border: 1px solid #00000040 !important;
    }

    .form-control:focus {
        border-color: #00b6f552 !important;
    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid #dcdcdc;
        min-height: 40px !important;
    }

    .business_list_logo {
        height: 45px;
        width: 45px;
        padding: 2px;
        border-radius: 50px;
        margin-right: 8px;
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

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .form-control:focus {
        color: #000 !important;
    }

    .text-right {
        text-align: right;
    }

    .nav-tabs li {
        width: 175px;
    }

    .nav {
        flex-wrap: nowrap;
        align-items: center;
        justify-content: left;
    }

    .tab-pane {
        padding: 0px;
    }

    .nav-tabs li .nav-link {
        width: 100%;
        border: none;
        padding: .5rem 1rem;
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        color: var(--heading);
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border-radius: var(--tab-radius);
        border-bottom: none;
        text-shadow: var(--primary-tshadow);
        /* border-right: 1px solid; */
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

    .form-control:focus {
        outline: none;
        box-shadow: none;
        color: #fff;
        background: #fff;
        border-color: var(--primary);
    }
    </style>
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">

            <div id="messages"></div>

            <div class="row">
                <div class="col float-right ml-auto">
                    {{-- <a href="{{ route('addBusinessByAdmin')}}" class="btn btn-primary" style="float:right"><i
                        class="fa fa-plus"></i> Add Business</a> --}}
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">



                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#ngoListing"
                                        data-bs-toggle="tab">NGO Listing</a></li>
                                <li class="nav-item"><a class="nav-link" href="#createNgo" data-bs-toggle="tab">Create
                                        NGO</a></li>
                            </ul>

                            <div class="tab-content tab-content1">
                                <div class="tab-pane show active" id="ngoListing">
                                    <div class="table table-responsive">
                                        <table class="table custom-table mb-0" id="ngoListingTable">
                                            <thead>
                                                <tr>
                                                    <th>Actions</th>
                                                    <th>NGO User Id </th>
                                                    <th>NGO Name</th>
                                                    <th>Establish</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Feature</th>
                                                    <th>Created Date</th>
                                                    <th>Updated Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="createNgo">
                                    <form action="{{ route('ngo.store') }}" enctype="multipart/form-data" method="post"
                                        role="form" id="add_ngo">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="row mt-3">
                                                <div class="col-sm-12">
                                                    <h5 class="text-left info">Personel Info</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <input type="hidden" name="created_by_admin" value="1">
                                                <div class="col-lg-3 col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">NGO Name :<sup
                                                                class="text-danger">*</sup></label>
                                                        <input class="form-control" type="text" required name="ngo_name"
                                                            value="{{ old('ngo_name')}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Email :</label>
                                                        <input class="form-control" type="text"
                                                            name="contact_email" value="{{ old('contact_email')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Establishment Year :</label>
                                                        <input class="form-control yearpicker" type="text"
                                                            name="establishment" value="{{ old('establishment')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Languages :</label>
                                                        <select class="form-control add_multi_language select2"
                                                            id="languages" multiple="multiple" name="languages[]">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <h5 class="text-left info">NGO Info :</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">ABN :</label>
                                                        <input class="form-control" type="text" name="abn"
                                                            value="{{ old('abn')}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">ACNC :</label>
                                                        <input class="form-control" type="text" name="acnc"
                                                            value="{{ old('acnc')}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">GST :</label>
                                                        <input class="form-control" type="text" name="gst"
                                                            value="{{ old('gst')}}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Category<sup
                                                                class="text-danger">*</sup></label>
                                                        <select class="form-control required select2 ajax_category"
                                                            name="cat_id">

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-form-label">NGO Size :</label>
                                                        <select class="select form-control" name="size">
                                                            <option value="0">Select Size</option>
                                                            <option value="large">Large</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="small">Small</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <h5 class="text-left info">Contact Info :</h5>
                                                    </div>
                                                </div><br />
                                                <div class="col-sm-12">
                                                    <div class="row mt-3">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label">NGO address :</label>
                                                                <input type="text" name="ngo_address"
                                                                    placeholder="Address" class="form-control"
                                                                    id="address-input">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label"> City :<sup
                                                                        class="text-danger">*</sup></label>
                                                                <input type="text" name="ngo_city" placeholder="City"
                                                                    class="form-control" id="city-input">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label">State :</label>
                                                                <input type="text" name="ngo_state" placeholder="State"
                                                                    class="form-control" id="state-input">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Country :</label>
                                                                <input type="text" name="ngo_country"
                                                                    placeholder="Country" class="form-control"
                                                                    id="country-input">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Contact phone :</label>
                                                                <input class="form-control" type="number"
                                                                    id="contact_phone" name="contact_phone"
                                                                    value="{{ old('contact_phone')}}" maxlength="20"
                                                                    title="Please enter max 20 digits">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Website URL :</label>
                                                                <input class="form-control" type="url"
                                                                    name="website_url" value="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-sm-12">
                                                            <h5 class="text-left info">Social Media Info</h5>
                                                        </div>


                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Facebook URL :</label>
                                                                <input class="form-control" type="text"
                                                                    name="facebook_url" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Twitter URL :</label>
                                                                <input class="form-control" type="text"
                                                                    name="twitter_url" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Instagram URL :</label>
                                                                <input class="form-control" type="text"
                                                                    name="instagram_url" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Linkedin URL :</label>
                                                                <input class="form-control" type="text"
                                                                    name="linkedin_url" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-12">
                                                            <h5 class="text-left info">Others Info</h5>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Feature :</label><br />
                                                                <input class="form-check-input" name="feature"
                                                                    type="checkbox" role="switch" value="1">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Order By :</label>
                                                                <input class="form-control" name="orderby" type="text"
                                                                    value="0">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Logo/Main Image :</label>
                                                                <input type="file" class="form-control" id="image"
                                                                    name="logo_path">
                                                            </div> 
                                                        </div>
                                                        <input type="hidden" name="status" value="1">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Other Images :</label>
                                                                <input type="file" class="form-control"
                                                                    id="other_images" name="other_images[]" multiple>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Description :</label>
                                                                <textarea class="form-control" id="adDescription"
                                                                    placeholder="Describe your message" maxlength="5000"
                                                                    name="ngo_description">{{ old('ngo_description') }}</textarea>
                                                                <p id="charCount" class="text-muted">
                                                                    {{ strlen(old('ngo_description')) }} / 5000
                                                                    characters
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="submit-section">
                                                <button id="submit_button" type="submit" class="btn btn-primary submit-btn">
                                                    <span class="btn-text">Submit</span>
                                                    <span class="btn-loader spinner-border spinner-border-sm" id="loader" style="display: none;" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </span>
                                                </button>
                                            </div>

                                    </form>
                                </div>

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
                            <h3>Delete Request</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-bs-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Modal -->

        <!-- Modal -->
        <div class="modal custom-modal fade" tabindex="-1" role="dialog" id="removeNgoModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header remove">
                        <h4 class="modal-title">Remove NGO</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form role="form" action="{{ route('ngo.delete') }}" method="post" id="removeNgoForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Do you really want to remove?</p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="submit" class="btn btn-danger submit-btn">Delete NGO</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        {{-- reponse modal --}}
        <div class="modal fade" id="submit_responseModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalCenterTitle">Response</h6>
                        <button type="button" class="close " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i></span>
                        </button>
                    </div>
                    <!--end modal-header-->

                    <div class="modal-body " id="responseMrmEdit">
                        <div id="model_messages"></div>

                    </div>
                    <!--end modal-body-->
                    <div class="modal-footer">
                    </div>
                    <!--end modal-footer-->

                </div>
                <!--end modal-content-->
            </div>
            <!--end modal-dialog-->
        </div>
        <!--end response modal-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js">
        </script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
            async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#add_ngo input, #add_ngo select, #add_ngo textarea').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            $('.ajax_category').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    placeholder: '--- Search Category ---',
                    allowClear: true,
                    ajax: {
                        url: "{{route('ajaxSearchNgoCategory')}}",
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
 

            var maxChars = 5000;
            var charCount = $('#charCount');
            var adDescription = $('#adDescription');

            adDescription.summernote({
                height: 150,
                callbacks: {
                    onKeyup: function(e) {
                        updateCharCount();
                    },
                    onChange: function(contents, $editable) {
                        updateCharCount();
                    }
                }
            });

            function updateCharCount() {
                var currentChars = adDescription.summernote('code').replace(/(<([^>]+)>)/gi, "").length;
                charCount.text(currentChars + ' / ' + maxChars + ' characters');

                if (currentChars > maxChars) {
                    var truncatedText = adDescription.summernote('code').replace(/(<([^>]+)>)/gi, "").substring(
                        0, maxChars);
                    adDescription.summernote('code', truncatedText);
                    charCount.text(maxChars + ' / ' + maxChars + ' characters');
                }
            }

            updateCharCount();
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

        $(function() {
            $(".timepicker").datetimepicker({
                format: "hh:mm A" 
            });
        });
        </script>


        <script type="text/javascript">
        var base_url = "{{ url('/admin/') }}";
        var ngoTable;
        $(document).ready(function() {

            ngoTable = $('#ngoListingTable').DataTable({
                'ajax': "{{ route('ngoList')}}",
                'order': [],
            });


            $('body').on('click', '.change-business-status', function() {
                let isCHecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{route('ngo.change-status')}}",
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


            $(".add_multi_language").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });





            $("#removeNgoForm").on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                $(".text-danger").remove();

                var id = form.data('ngo-id');

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
                        $("#removeNgoModal").modal('hide');

                        if (response.success) {
                            toastr.success(response.message);
                            $('#item-' + id).remove();
                            $("#ngo-" + id).remove();
                        } else {
                            toastr.error(response.error);
                        }
                    },
                    error: function(xhr) {
                        $("#removeNgoModal").modal('hide');
                        if (xhr.status === 422) {
                            var response = xhr.responseJSON;
                            toastr.error(response.error);
                        } else {
                            toastr.error(
                                'An error occurred while deleting the business. Please try again.'
                            );
                        }
                    }
                });

                return false;
            });


        });

        function removeNgoFunc(id) {
            $("#removeNgoForm").data('ngo-id', id);
            $("#removeNgoModal").modal('show');
        };

        function viewFunc(id) {
            console.log(id);
            var url = "{{ route('viewPost', ':id') }}";
            url = url.replace(':id', id);
            console.log(url);
            window.open(url, '_blank');
        };
        </script>

       

        <script>
        $(document).ready(function() {
            $('.yearpicker').datepicker({
                dateFormat: 'yy', 
                changeYear: true,
                changeMonth: false, 
                showButtonPanel: true,
                yearRange: '1900:' + new Date().getFullYear(),
                closeText: 'Select',
                currentText: 'This Year',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).val(year);
                },
                beforeShow: function(input, inst) {
                    if ((datestr = $(this).val()).length > 0) {
                        year = datestr.substring(datestr.length - 4, datestr.length);
                        $(this).datepicker('option', 'defaultDate', new Date(year, 0, 1));
                        $(this).datepicker('setDate', new Date(year, 0, 1));
                    }
                    inst.dpDiv.css({
                        marginTop: '10px',
                        top: 'auto',
                        bottom: 'auto'
                    });
                }
            });

            $.datepicker._defaults.onAfterUpdate = null;
            var _updateDatepicker = $.datepicker._updateDatepicker;
            $.datepicker._updateDatepicker = function(inst) {
                _updateDatepicker.call(this, inst);
                var onAfterUpdate = this._get(inst, 'onAfterUpdate');
                if (onAfterUpdate)
                    onAfterUpdate.apply((inst.input ? inst.input[0] : null), [(inst.input ? inst : null)]);
            };

            $('.yearpicker').datepicker('option', 'onAfterUpdate', function() {
                var inst = $(this).data('datepicker');
                var dpDiv = inst.dpDiv;

                dpDiv.find('.ui-datepicker-calendar').hide();

                dpDiv.find('.ui-datepicker-month').hide();

                dpDiv.find('.ui-datepicker-prev').hide();
                dpDiv.find('.ui-datepicker-next').hide();

                dpDiv.find('.ui-datepicker-current').hide();

                dpDiv.find('.ui-datepicker-close').css('float', 'right');
            });




            $('#add_ngo').submit(function(e) {
                e.preventDefault();
                e.stopPropagation();
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
                        $('#add_ngo')[0].reset();
                        $('#adDescription').val('');
                        $('#adDescription').text('');
                        $('#languages').val(null).trigger('change');

                        $('#charCount').text('0 / 5000 characters');

                        toastr.success(response.message); 
                        $('#loader').hide();
                        $('#submit_button').prop('disabled', false);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
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



            $('body').on('click', '.change-ngo-status', function() {
                let isCHecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{route('ngo.change-status')}}",
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: isCHecked,
                        id: id
                    },
                    success: function(response) {
                        toastr.success(response.message)
                    }
                })
            });


            $('body').on('click', '.change-ngo-feature', function() {
                let isCHecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{route('ngo.change-feature')}}",
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        feature: isCHecked,
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        toastr.success(response.message)
                    }
                })
            });


        }); 
        </script>

        @endsection