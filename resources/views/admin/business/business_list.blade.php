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
                                <li class="nav-item"><a class="nav-link active" href="#businesslisting"
                                        data-bs-toggle="tab">Businss Listing</a></li>
                                <li class="nav-item"><a class="nav-link" href="#createbusiness"
                                        data-bs-toggle="tab">Create
                                        Business</a></li>
                            </ul>

                            <div class="tab-content tab-content1">
                                <div class="tab-pane show active" id="businesslisting">
                                    <div class="table table-responsive">
                                        <table class="table custom-table mb-0" id="businessListingTable">
                                            <thead>
                                                <tr>
                                                    <th>Actions</th>
                                                    <th>Business Name</th>
                                                    <th>Establish</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Feature</th>
                                                    {{-- <th class="text-right">Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="createbusiness">
                                <form action="{{ route('business.store') }}" enctype="multipart/form-data" method="post" role="form" id="add_business">
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
                    <label class="col-form-label">Business Name :<sup class="text-danger">*</sup></label>
                    <input class="form-control" type="text" required name="business_name"
                        value="{{ old('business_name')}}">
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label class="col-form-label">Category :<sup class="text-danger">*</sup></label>
                    <select class="form-control required select2 business_category" name="business_category">

                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label class="col-form-label">Email :</label>
                    <input class="form-control" type="text"  name="contact_email"
                        value="{{ old('contact_email')}}">
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label class="col-form-label">Establishment Year :</label>
                    <input class="form-control yearpicker" type="text" name="establish_year"
                        value="">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Languages :</label>
                    <select class="form-control add_multi_language select2" id="languages" multiple="multiple"
                        name="languages[]">
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Deals In :</label>
                    <select class="form-control add_multi_deals select2" id="deals" multiple="multiple" name="deals[]">
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <h5 class="text-left info">Business Info :</h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-form-label">ABN :</label>
                    <input class="form-control" type="text" name="abn" value="">
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
                            <label class="col-form-label">Business address :</label>
                            <input type="text" name="business_address" placeholder="Address" class="form-control"
                                id="address-input">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Business City :<sup class="text-danger">*</sup></label>
                            <input type="text" name="business_city" placeholder="City" class="form-control"
                                id="city-input">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Business State :</label>
                            <input type="text" name="business_state" placeholder="State" class="form-control"
                                id="state-input">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Business Country :</label>
                            <input type="text" name="business_country" placeholder="Country" class="form-control"
                                id="country-input">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Contact phone :</label>
                            <input class="form-control" type="text" id="contact_phone" name="contact_phone"
                                value="{{ old('contact_phone')}}" maxlength="10" pattern="\d{10}"
                                title="Please enter exactly 10 digits"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Website URL :</label>
                            <input class="form-control" type="url" name="website_url" value="">
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
                            <input class="form-control" type="text" name="facebook_url" value="">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">Twitter URL :</label>
                            <input class="form-control" type="text" name="twitter_url" value="">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">Instagram URL :</label>
                            <input class="form-control" type="text" name="instagram_url" value="">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">Linkedin URL :</label>
                            <input class="form-control" type="text" name="linkedin_url" value="">
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
                            <input class="form-check-input" name="feature" type="checkbox" role="switch" value="1">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">Order By :</label>
                            <input class="form-control" name="orderby" type="text" value="0">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Logo/Main Image :</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label">Other Images :</label>
                            <input type="file" class="form-control" id="other_images"  name="other_images[]" multiple>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">Description :</label>
                            <textarea class="form-control" id="adDescription" placeholder="Describe your message"
                                name="business_description"></textarea>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="accordion_primary" class="accordion-wrapper mb-3 ">
    <div class="cad">
        <div id="primary_head text-center" class="card-header p-2">
            <button type="button" data-bs-toggle="collapse" data-bs-target="#primary" aria-expanded="true"
                aria-controls="collapseOne2" class="clr-white text-left btn  btn-block btn-info w-p100">
                <span class="m-0 p-0 h6" style="color:white;"><i class="fa fa-plus"></i> Business Hours</span>
            </button>
        </div>
        <div data-bs-parent="#accordion_primary" id="primary" aria-labelledby="primary_head" class="collapse">
            <div class="card-body">
                <div class="">
                    <input type="hidden" id="businessHourInfo" name="id" value="{{ $businessHour->id ?? '' }}">
                    <div class="row">

                        <div class="form-group row">
                            <label for="monday_start" class="col-sm-2 col-form-label">Monday:<sup
                                    class="text-danger">*</sup></label>
                            <div class="col-sm-4">
                                <input class="form-control timepicker"  type="text" id="monday_start"
                                    name="monday_start" placeholder="Start Time"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="monday_end" name="monday_end"
                                    placeholder="End Time"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tuesday_start" class="col-sm-2 col-form-label">Tuesday:</label>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="tuesday_start"
                                    name="tuesday_start" placeholder="Start Time"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="tuesday_end" name="tuesday_end"
                                    placeholder="End Time"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="wednesday_start" class="col-sm-2 col-form-label">Wednesday:</label>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="wednesday_start"
                                    name="wednesday_start" placeholder="Start Time"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="wednesday_end"
                                    name="wednesday_end" placeholder="End Time"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="thursday_start" class="col-sm-2 col-form-label">Thursday:</label>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="thursday_start"
                                    name="thursday_start" placeholder="Start Time"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="thursday_end" name="thursday_end"
                                    placeholder="End Time"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="friday_start" class="col-sm-2 col-form-label">Friday:</label>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="friday_start" name="friday_start"
                                    placeholder="Start Time"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="friday_end" name="friday_end"
                                    placeholder="End Time"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="saturday_start" class="col-sm-2 col-form-label">Saturday:</label>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="saturday_start"
                                    name="saturday_start" placeholder="Start Time"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="saturday_end" name="saturday_end"
                                    placeholder="End Time"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sunday_start" class="col-sm-2 col-form-label">Sunday:</label>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="sunday_start" name="sunday_start"
                                    placeholder="Start Time"
                                    value="">
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control timepicker" type="text" id="sunday_end" name="sunday_end"
                                    placeholder="End Time"
                                    value="">
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
 
</div>


        <div class="submit-section">
            <button  class="btn btn-primary submit-btn">Submit</button>
            <br>
            <div id="loader" style="display: none;" class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
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
        <div class="modal custom-modal fade" tabindex="-1" role="dialog" id="removeBusinessModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header remove">
                        <h4 class="modal-title">Remove Business</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form role="form" action="{{ route('business.delete') }}" method="post" id="removeBusinessForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Do you really want to remove?</p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="submit" class="btn btn-danger submit-btn">Delete Business</button>
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
           
            $('#adDescription').summernote({
                height: 150
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

        $(function() {
            $(".timepicker").datetimepicker({
                format: "hh:mm A" 
            });
        });
        </script>


        <script type="text/javascript">
        var base_url = "{{ url('/admin/') }}";
        var businessTable;
        $(document).ready(function() {

            businessTable = $('#businessListingTable').DataTable({
                'ajax': "{{ route('businessList')}}",
                'order': [],
            });


            $('body').on('click', '.change-business-status', function() {
                let isCHecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{route('business.change-status')}}",
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


            $(".add_multi_deals, .add_multi_language").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });


            $('body').on('click', '.change-business-feature', function() {
                let isCHecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{route('business.change-feature')}}",
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


            $("#removeBusinessForm").on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                $(".text-danger").remove();

                var id = form.data('business-id');

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
                        $("#removeBusinessModal").modal('hide');

                        if (response.success) {
                            toastr.success(response.message);
                            $('#item-' + id).remove();
                            $("#business-" + id).remove();
                        } else {
                            toastr.error(response.error);
                        }
                    },
                    error: function(xhr) {
                        $("#removeBusinessModal").modal('hide');
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

        function removeBusinessFunc(id) {
            $("#removeBusinessForm").data('business-id', id);
            $("#removeBusinessModal").modal('show');
        };

        function viewFunc(id) {
            console.log(id);
            var url = "{{ route('viewPost', ':id') }}";
            url = url.replace(':id', id);
            console.log(url); 
            window.open(url, '_blank');
        };


        $('.business_category').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: '--- Search Business Category ---',
                allowClear: true,
                ajax: {
                    url: "{{route('ajaxSearchBusinessCategory')}}",
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
        </script>

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

        /* .bootstrap-datetimepicker-widget table td span {
    display: inline-block;
    width: 54px;
    height: 54px;
    line-height: 54px;
    margin: 2px 1.5px;
    cursor: pointer;
    border-radius: 4px
  }

  .bootstrap-datetimepicker-widget table td span:hover {
    background: green
  }

  .bootstrap-datetimepicker-widget table td span.active {
    background-color: blue;
    color: red;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25)
  }

  .bootstrap-datetimepicker-widget table td span.old {
    color: pink
  }

  .bootstrap-datetimepicker-widget table td span.disabled,
  .bootstrap-datetimepicker-widget table td span.disabled:hover {
    background: none;
    color: yellow;
    cursor: not-allowed
  }

  .bootstrap-datetimepicker-widget table td.today:before {
    content: '';
    display: inline-block;
    border: solid transparent;
    border-width: 0 0 7px 7px;
    border-bottom-color: #337ab7;
    border-top-color: rgba(0, 0, 0, 0.2);
    position: absolute;
    bottom: 4px;
    right: 4px;color:red; background-color: #000;
  } */

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

        /* .custom-table th,
            .custom-table td {
                padding: 8px;
                border: 1px solid #ddd;
                word-wrap: break-word;
                Enable text wrapping
                white-space: break-spaces;
            } */



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

        <script>
        $(document).ready(function() {
            $('.yearpicker').datepicker({
                dateFormat: 'yy',
                changeYear: true,
                changeMonth: false, 
                showButtonPanel: true,
                yearRange: '1900:' + new Date().getFullYear(),
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 0, 1));
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





            $('#add_business').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $('#loader').show(); 
                $(':input[type="submit"]').prop('disabled', true);

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#add_business')[0].reset();
                        $('#image').val('');
                        toastr.success(response.success);;
                        $('#loader').hide();
                        $(':input[type="submit"]').prop('disabled', false);
                    },
                    error: function(xhr) {
                        $('#loader').hide(); 
                        $(':input[type="submit"]').prop('disabled', false);
                        if (xhr.status === 422) { 
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                errors[key].forEach(function(message) {
                                    console.log(key);
                                    console.log(message);
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

        @endsection