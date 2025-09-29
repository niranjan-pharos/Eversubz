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
                    <a href="{{ route('admin.addNgoMember',['id'=>$ngoMember->ngo_id])}}" class="btn btn-primary" style="float:right"><i
                        class="fa fa-arrow-left"></i> Members List</a>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form action="{{ route('ngo_member.update',['id' => $ngoMember->id]) }}" enctype="multipart/form-data"
                                method="post" role="form" id="edit_member">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <input type="hidden" name="member_id" value="{{ $ngoMember->id}}">
                                        <div class="col-lg-3 col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Member's Name :<sup
                                                        class="text-danger">*</sup></label>
                                                <input class="form-control" id="member_name" type="text" required
                                                    name="name" value="{{ $ngoMember->name }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Designation :<sup
                                                        class="text-danger">*</sup></label>
                                                <input class="form-control" type="text" required id="member_designation"
                                                    name="designation" value="{{ $ngoMember->designation }}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">Image :</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                                <img class="img img-thumbnail" id="member_image" src="{{ asset('storage/' . $ngoMember->image) }}" style="width:160px; height:auto;">
                                            </div>
                                        </div>
                                        
                                    <div class="submit-section">
                                        <button id="submit_button" class="btn btn-primary submit-btn">Update</button>
                                        <br>
                                        <div id="loader" style="display: none;"
                                            class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
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


    

    <script>
        $(document).ready(function() {
            $('#edit_member').submit(function(e) {
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
                            $('#member_name').text(response.updated_member.name); 
                            $('#member_designation').text(response.updated_member.designation);
                            if (response.updated_member.image) {
                                $('#member_image').attr('src', '/storage/' + response.updated_member.image); 
                            }

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

        })

    </script>

@endsection