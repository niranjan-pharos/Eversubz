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
                            <a href="{{ route('adminEventsAdd')}}" class="btn btn-primary btn-event" style="float:right"><i
                                    class="fa fa-arrow"></i> Add Events </a>
                            <div class="table table-responsive">
                                <table class="table custom-table mb-0" id="eventTable">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Created By</th>
                                            <th>Host Name</th>
                                            <th>Location</th>
                                            <th>Duration</th>
                                            <th>Feature</th>
                                            <th>Status</th>
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
    var base_url = "{{ url('/admin/') }}";
    var eventTable;
    $(document).ready(function() {

        eventTable = $('#eventTable').DataTable({
            'ajax': "{{ route('adminEventsList')}}",
            'order': [],
           
        });

 
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
        });

        $('body').on('click','.feature-status',function(){
            let isCHecked = $(this).is(':checked');
            let id= $(this).data('id');
            $.ajax({
                url: '{{ route('eventsChangeFeature') }}',
                method : 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    feature: isCHecked,
                    id: id
                },
                success:function(response){
                    console.log(response);
                    toastr.success(response.message)
                }
            })
        })

    });


    function removeFunc(slug) {
            if (confirm('You won\'t get back your event. Are you sure you want to delete?')) {
                $.ajax({
                url: '{{ url('admin') }}/events/' + slug,
                type: 'DELETE', 
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.messages);
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
    };


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
@endsection