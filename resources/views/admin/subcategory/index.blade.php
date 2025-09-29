@extends('admin.template.master')

@section('content')
    <div class="search-lists">
        <div class="search-lists">
            <div class="tab-content">

                <div id="messages"></div>

                <div class="row"> 
                    <div class="col float-right ml-auto">
                        <button class="btn btn-primary add-btn add-button" data-bs-toggle="modal"
                            data-bs-target="#addModalSubcategory"><i class="fa fa-plus"></i> Add SubCategory </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table custom-table mb-0" id="subcategoryTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Category</th>
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
            <form class="form form-validate" role="form" action="{{ route('subcategoryUpdate') }}" method="post" id="updateForm">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="cat_id" id="cat_id">
                        
                        <div class="form-group">
                            <label class="col-form-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control select2 ajax_category" id="edit_category" name="edit_category">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                            <input type="text" required class="form-control" id="edit_name" name="edit_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="edit_status" name="edit_status">
                                    <option value="1">Active</option>        
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center modal-footer-div">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
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

                    <h4 class="modal-title">Remove Category</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form role="form" action="{{ route('subcategoryDelete') }}" method="post" id="removeForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">                   
                        <p>Do you really want to remove?</p>
                    </div>
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="modal-footer modal-footer-uniform">
                        <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-danger submit-btn">Delete Category</button>
                        <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                    </div>
                </form>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- reponse modal --}}
    <div class="modal fade" id="submit_responseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

    .custom-table th, .custom-table td {
        padding: 8px;
        border: 1px solid #ddd;
        word-wrap: break-word; /* Enable text wrapping */
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
    var base_url = "{{ url('/admin/') }}";
    var subcategoryTable;
    $(document).ready(function() {

        subcategoryTable = $('#subcategoryTable').DataTable({
            'ajax': "{{route('subcategoryList')}}",
            'order': []
        });

        $('body').on('click','.change-status',function(){
            let isCHecked = $(this).is(':checked');
            let id= $(this).data('id');
            $.ajax({
                url: "{{route('subcategory.change-status')}}",
                method : 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: isCHecked,
                    id: id
                },
                success:function(response){
                    console.log(response);
                    toastr.success(response.message)
                }
            })
        });


        $("#add_subcategory").unbind('submit').on('submit', function() {
            var form = $(this);

            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        toastr.success(response.messages);

                        $("#addModalSubcategory").modal('hide');

                        $("#add_subcategory")[0].reset();
                        $("#add_subcategory .form-group").removeClass('has-error').removeClass('has-success');
                        subcategoryTable.ajax.reload(null, false);
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
                        
                        $("#addModalSubcategory").modal('hide');
                        
                    }
                }


            });

            return false;
        });


        
        $('.ajax_category').each(function() {
            $(this).select2({
            dropdownParent: $(this).parent(),
            placeholder: '--- Search Category ---',
            allowClear: true,
            ajax: {
                url:"{{route('ajaxSearchCategory')}}",
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
        

    });


    function editFunc(id) {
        $.ajax({
            url: "{{ url('admin/subcategory') }}/" + id + "/edit",
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var $newOption = $("<option selected='selected'></option>").val(response.category_id).text(response.category_name);
                $("#edit_category").append($newOption).trigger('change');
                $("#edit_name").val(response.subcategory.name);
                $("#edit_status").val(response.subcategory.status);
                $("#cat_id").val(id);

                $("#updateForm").unbind('submit').bind('submit', function() {
                    var form = $(this);
                    $(".text-danger").remove();

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(), 
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            
                            if (response.success === true) {
                                subcategoryTable.ajax.reload(null, false);
                                toastr.success(response.message);
                                $("#editModal").modal('hide');
                                $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

                            } else {
                                if (response.errors) {
                                    var errorMessages = '';
                                    $.each(response.errors, function (key, errors) {
                                        errorMessages += errors[0] + '<br>'; 
                                    });
                                    toastr.error(errorMessages);
                                } else {
                                    toastr.error("There was a problem processing your request.");
                                }
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

                        $("#removeModal").modal('hide');

                        if (response.success === true) {
                            toastr.success(response.messages);


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
</script>

@include('admin.subcategory.create')
@endsection
