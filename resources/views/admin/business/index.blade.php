@extends('admin.template.master')

@section('content')
    <div class="search-lists">
        <div class="search-lists">
            <div class="tab-content">
                <div id="messages"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="table table-responsive">
                                    <table class="table custom-table mb-0" id="businessTable">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>User Id</th>
                                                <th>User</th>
                                                <th>Email</th>
                                                <th>Business Name</th>
                                                <th>Request Status</th>
                                                <th>Feature</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
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

    <!-- remove brand modal -->
    <div class="modal custom-modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header remove">

                    <h4 class="modal-title">Remove Business Request</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form role="form" action="{{ route('business.delete') }}" method="post" id="removeForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Do you really want to remove?</p>
                    </div>
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="modal-footer modal-footer-uniform">
                        <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-danger submit-btn">Delete Request</button>
                        <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                    </div>
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

    <script type="text/javascript">
        var businessTable;
        $(document).ready(function() {
            businessTable = $('#businessTable').DataTable({
                'ajax': {
                    'url': "{{ route('RequestList') }}",
                    'type': 'GET',
                    'dataSrc': 'data'
                },
                'columns': [{
                        'data': 0
                    },
                    {
                        'data': 1
                    },
                    {
                        'data': 2
                    },
                    {
                        'data': 3
                    },
                    {
                        'data': 4
                    },
                    {
                        'data': 5
                    }
                    , {
                        'data': 6
                    }
                ],
                'order': [],
            });

            $('body').on('click', '.change-business-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('business.change-status') }}",
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: isChecked,
                        id: id
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            toastr.error(xhr.responseJSON.error);
                        } else {
                            toastr.error('An unexpected error occurred.');
                        }
                    }
                });
            });
        


                $('body').on('click', '.change-feature-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                        url: "{{ route('business.change-feature') }}",
                        method: 'PUT',
                        data: {
                        "_token": "{{ csrf_token() }}",
                        feature: isChecked,
                        id: id
                        },
                        success: function(response) {
                        toastr.success(response.message);
                        },
                        error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                                toastr.error(xhr.responseJSON.error);
                        } else {
                                toastr.error('An unexpected error occurred.');
                        }
                        }
                });
        });
        });

        function removeBusinessRequestFunc(id) {
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
                            toastr.success(response.message);
                            businessTable.ajax.reload();
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                toastr.error(xhr.responseJSON.error);
                            } else {
                                toastr.error('An unexpected error occurred.');
                            }
                        }
                    });
                    return false;
                });
            }
        };

        function viewFunc(id) {
            var url = "{{ route('viewPost', ':id') }}";
            url = url.replace(':id', id);
            window.open(url, '_blank');
        };
    </script>

    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }
    </style>
@endsection
