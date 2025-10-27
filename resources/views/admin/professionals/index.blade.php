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
                        <a href="{{ route('adminProfessionalsAdd')}}" class="btn btn-primary" style="float:right"><i
                                        class="fa fa-arrow"></i> Add Professionals </a>
                            <div class="table table-responsive">
                                <table class="table custom-table mb-0" id="professionalTable">
                                    <thead>
                                        <tr>
                                            <th>Icon</th>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Profession</th>
                                            <th>Salary</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                            <th class="text-right">Action</th>
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

<!-- Modals for delete confirmation and remove business request -->
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
                                        <a href="javascript:void(0);"
                                                class="btn btn-primary continue-btn">Delete</a>
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


        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="removeModalLabel">Confirm Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this professional?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</button>
            </div>
          </div>
        </div>
      </div>
      

{{-- reponse modal --}}
<div class="modal fade" id="submit_responseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
        $(document).on('change', '.change-user-status', function() {
                let userId = $(this).data('id');
                let newStatus = $(this).is(':checked') ? 'active' : 'inactive';

                $.ajax({
                        url: 'professionals/update-status', 
                        type: 'POST',
                        data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: userId,
                        status: newStatus
                        },
                        success: function(response) {
                        toastr.success(response.message, 'Status Updated');
                        },
                        error: function(xhr) {
                        toastr.error('Failed to update status');
                        }
                });
        });


        var base_url = "{{ url('/admin/') }}";
        var professionalTable;
        $(document).ready(function() {
    
            professionalTable = $('#professionalTable').DataTable({
                'ajax': "{{ route('fetchProfessionalssData')}}",
                'order': [],
               
            });
    
     
            $('body').on('click','.change-status',function(){
                let isCHecked = $(this).is(':checked');
                let id= $(this).data('id');
                $.ajax({
                    url: '{{ route('changeProfessionalsStatus') }}',
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
    
        });
    
    
        let deleteId = null;

        function removeFunc(id) {
                deleteId = id;
                $('#removeModal').modal('show');
        }

        $('#confirmDeleteBtn').on('click', function() {
        if (!deleteId) return;
        $.ajax({
                url: '{{ url('admin') }}/professionals/' + deleteId,
                type: 'DELETE',
                data: {
                _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                if (response.success) {
                        toastr.success(response.success);
                        location.reload();
                } else if (response.error) {
                        toastr.error(response.error);
                }
                },
                error: function (xhr) {
                if (xhr.status === 403) {
                        toastr.error('Unauthorized action.');
                } else {
                        toastr.error('An error occurred while trying to delete the professional.');
                }
                }
        });
        $('#removeModal').modal('hide');
        deleteId = null;
        });

    
    
        function viewFunc(id) {
            console.log(id); 
            var url = "{{ route('adminEventsShow', ':id') }}";
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

        .text-right {
                text-align: right;
        }
</style>
@endsection