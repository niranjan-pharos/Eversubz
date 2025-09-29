@extends('admin.template.master')

@section('content')
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">

            <div id="messages"></div>

            <div class="row">
                <div class="col float-right ml-auto">
                    <button class="btn btn-primary add-btn add-button" data-bs-toggle="modal"
                        data-bs-target="#addModalCategory"><i class="fa fa-plus"></i> Add NGO Category </button>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0" id="categoryTable">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


 

        <!-- edit modal -->
        <div class="modal custom-modal fade" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-validate" role="form" action="{{ route('ngoCategoryUpdate') }}"
                            method="post" id="updateForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="row">
                                    <input type="hidden" name="cat_id" id="cat_id">

                                    <div class="form-group">
                                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" required class="form-control" id="edit_name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Image</label>
                                        <input type="file" id="edit_image" name="image" class="img img-thumbnail"
                                            style="width:60px;height:60px;">
                                    </div>
                                    <div class="current-image">
                                        <img src="#" id="current_image" class="img img-thumbnail"
                                            style="width:100px; height:100px;" alt="Current Category Icon">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Status <span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="edit_status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center modal-footer-div">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <!-- Delete confirmation Modal -->
        <div class="modal custom-modal fade" id="delete_category" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Category</h3>
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

        <!-- remove brand modal -->
        <div class="modal custom-modal fade" tabindex="-1" role="dialog" id="removeModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header remove">

                        <h4 class="modal-title">Remove Category</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form role="form" action="{{ route('categoryDelete') }}" method="post" id="removeForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Do you really want to remove?</p>
                        </div>
                        <input type="hidden" name="category_id" id="category_id">
                        <div class="modal-footer modal-footer-uniform">
                            <button type="submit" class="btn btn-danger submit-btn">Delete Category</button>
                        </div>
                    </form>>
                    </form>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

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

        <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            padding: 8px;
            border: 1px solid #ddd;
            word-wrap: break-word;
            /* Enable text wrapping */
            white-space: break-spaces;
        }

        .custom-table th {
            background-color: #f2f2f2 !important;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .custom-table tbody tr:hover {
            background-color: #ddd;
        }

        .text-right {
            text-align: right;
        }
        </style>

        <script type="text/javascript">
        $(document).ready(function() {

            categoryTable = $('#categoryTable').DataTable({
                ajax: "{{ route('get.ngo.categories') }}",
                columns: [{
                        data: 0,
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 1,
                        name: 'name'
                    },
                    {
                        data: 2,
                        name: 'slug'
                    },
                    {
                        data: 3,
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 4,
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


            $('body').on('click', '.change-status', function() {
                let isCHecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{route('ngo.change-category-status')}}",
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

            $("#add_category").unbind('submit').on('submit', function(event) {
                event.preventDefault(); 

                var form = $(this)[0]; 
                var formData = new FormData(form);

                $(".text-danger").remove();

                console.log("Submitting form data:", formData);

                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === true) {
                            toastr.success(response.messages);

                            $("#addModalCategory").modal('hide');

                            $("#add_category")[0].reset();
                            categoryTable.ajax.reload(null, false);
                        } else {
                            var errorMessages = '';
                            $.each(response.errors, function(key, value) {
                                errorMessages += value.join('<br>');
                            });
                            toastr.error(errorMessages);

                            $("#addModalCategory").modal('hide');
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value.join('<br>');
                        });
                        toastr.error(errorMessages);
                    }
                });

                return false;
            });
        });

        function editNgoCatFunc(id) {
            var baseUrl = '{{ url(' / ') }}';
            $.ajax({
                url: baseUrl + "/admin/ngo-edit/" + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response.success);
                    $("#current_image").attr('src', baseUrl + '/storage/' + response.success.image);
                    if (response.success.image === 'empty' || response.success.image === 'null' || response
                        .success.image === '') {
                        $("#current_image").hide();
                    }
                    $("#edit_name").val(response.success.name);
                    if (response.success.status === 0) {
                        $("#edit_status").val('0');
                    } else {
                        $("#edit_status").val('1');
                    }
                    $("#cat_id").val(id);

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
                                    console.log(response.message);
                                    toastr.success(response.message);
                                    $("#editModal").modal('hide');
                                    $("#updateForm .form-group").removeClass(
                                        'has-error').removeClass('has-success');

                                } else {
                                    if (response.error instanceof Array) {
                                        var errorMessages = '';
                                        $.each(response.error, function(key, value) {
                                            errorMessages += value.join(
                                            '<br>'); 
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


        function removeFunc(id) {
            if (id) {
                $('#category_id').val(id);
                $("#removeForm").on('submit', function(event) {
                    event.preventDefault();

                    var form = $(this);
                    var formData = {
                        "_token": "{{ csrf_token() }}",
                        del_id: id,
                        _method: 'DELETE'
                    };

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            categoryTable.ajax.reload(null, false);
                            $("#removeModal").modal('hide');

                            if (response.success === true) {
                                toastr.success(response.messages);
                            } else {
                                if (Array.isArray(response.error)) {
                                    var errorMessages = response.error.join('<br>');
                                    toastr.error(errorMessages);
                                } else {
                                    toastr.error(response.error);
                                }
                            }
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value.join('<br>');
                            });
                            toastr.error(errorMessages);
                        }
                    });

                    return false;
                });
            }
        };
        </script>



        @include('admin.ngo_categories.create')
        @endsection