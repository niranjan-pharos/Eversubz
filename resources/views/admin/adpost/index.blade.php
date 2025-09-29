@extends('admin.template.master')
{{-- @auth('admin')
{{dd("IN");}}
@endauth --}}
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
                                <table class="table custom-table mb-0" id="adpostTable">
                                    <thead>
                                        <tr>
                                            <th>Post id</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Expiry</th>
                                            <th>Feature</th>
                                            <th>Recommend</th>
                                            <th>Urgent</th>
                                            <th>Eversubz</th>
                                            <th>Status</th>
                                            <th>Product Condition</th>
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




        <!-- Delete confirmation Modal -->
        <div class="modal custom-modal fade" id="delete_category" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Post</h3>
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

                        <h4 class="modal-title">Remove Post</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form role="form" action="{{ route('ad-post.delete')}}" method="post" id="removeForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Do you really want to remove?</p>
                        </div>
                        <input type="hidden" name="category_id" id="category_id">
                        <div class="modal-footer modal-footer-uniform">
                            <!-- <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-danger submit-btn">Delete Post</button>
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
            var base_url = "{{ url('/admin/') }}";
            var adpostTable;
            $(document).ready(function () {

                adpostTable = $('#adpostTable').DataTable({
                    'ajax': "{{ route('adPostList')}}",
                    'order': [[0, 'desc']],  
                    "columnDefs": [
                        { "width": "3%", "targets": 0 },
                        { "width": "30%", "targets": 1 },
                        { "width": "10%", "targets": [2, 3, 4, 10] },
                        { "width": "5%", "targets": [5, 6, 7, 8, 9] }
                    ]
                });


                $('body').on('click', '.change-status', function () {
                    let isCHecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: "{{route('post.change-status')}}",
                        method: 'PUT',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            status: isCHecked,
                            id: id
                        },
                        success: function (response) {
                            console.log(response);
                            toastr.success(response.message)
                        }
                    })
                });

                $('body').on('click', '.change-feature', function () {
                    let isCHecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: "{{route('post.change-feature')}}",
                        method: 'PUT',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            feature: isCHecked,
                            id: id
                        },
                        success: function (response) {
                            console.log(response);
                            toastr.success(response.message)
                        }
                    })
                });

                $('body').on('click', '.change-recommend', function () {
                    let isCHecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: "{{route('post.change-recommend')}}",
                        method: 'PUT',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            recommend: isCHecked,
                            id: id
                        },
                        success: function (response) {
                            console.log(response);
                            toastr.success(response.message)
                        }
                    })
                });

                $('body').on('click', '.change-urgent', function () {
                    let isCHecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: "{{route('post.change-urgent')}}",
                        method: 'PUT',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            urgent: isCHecked,
                            id: id
                        },
                        success: function (response) {
                            console.log(response);
                            toastr.success(response.message)
                        }
                    })
                });

                $('body').on('click', '.change-spotlight', function () {
                    let isCHecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: "{{route('post.change-spotlight')}}",
                        method: 'PUT',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            spotlight: isCHecked,
                            id: id
                        },
                        success: function (response) {
                            console.log(response);
                            toastr.success(response.message)
                        }
                    })
                })



            });


            function removeFunc(id) {

                if (id) {
                    $("#removeForm").on('submit', function () {
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
                            success: function (response) {

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


            function viewFunc(id) {
                console.log(id); 
                var url = "{{ route('viewPost', ':id') }}";
                url = url.replace(':id', id);
                console.log(url); 
                window.open(url, '_blank');
            };


        </script>
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

            /* Target "Action" column */
            .custom-table th:nth-child(12),
            .custom-table td:nth-child(12) {
              text-align: center;
            }

            .custom-table td:nth-child(12) {
              display: flex;
              justify-content: center; /* center horizontally */
              align-items: center;     /* center vertically */
              gap: 8px;                /* spacing between buttons/icons */
            }

        </style>
        @endsection