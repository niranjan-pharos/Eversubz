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
                                <a href="{{ route('adminAddAnnouncement')}}" class="btn btn-primary" style="float:right"><i class="fa fa-arrow"></i> Add Announcement </a>
                                <div class="table table-responsive" style="margin-top: 2.5rem !important;">
                                    <table class="table custom-table mb-0" id="announcementTable">
                                        <thead>
                                             <tr>
                                                <th>Title</th>
                                                <th>description</th>
                                                <th>Order by</th>
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

    
 

    <!-- Delete confirmation Modal -->
    <div class="modal custom-modal fade" id="delete_category" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Event</h3>
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

    
 
<script type="text/javascript">
    var base_url = "{{ url('/admin/') }}";
    var announcementTable;
    $(document).ready(function() {

        announcementTable = $('#announcementTable').DataTable({
            'ajax': "{{ route('adminAnnouncementList')}}",
            'order': []
        });

 
        // change status 
        $('body').on('click','.change-status',function(){
            let isCHecked = $(this).is(':checked');
            let id= $(this).data('id');
            $.ajax({
                url: '{{ route('eventsChangeStatus') }}',
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
        })
    });

     


    // remove functions
    function removeFunc(id) {
        if (confirm("You won't get back your event. Are you sure you want to delete?")) {
            $.ajax({
                url: '{{ url('admin') }}/announcement/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        // Refresh the table or remove the deleted event row
                        location.reload();
                    } else if (response.error) {
                        toastr.error(response.error);
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 403) {
                        toastr.error('Unauthorized action.');
                    } else {
                        toastr.error('An error occurred while trying to delete the event.');
                    }
                }
            });
        }
    }



</script>
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
@endsection
