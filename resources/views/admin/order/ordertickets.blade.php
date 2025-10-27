 @extends('admin.template.master')

@section('content')

<style>
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 12px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    /* Pending (yellow) */
    .bg-warning-faint { background-color: #fff3cd; }   /* faint */
    .text-warning-dark { color: #856404; }             /* dark */
    .bg-warning-dark { background-color: #ffc107; }    /* dot */

    /* Completed (green) */
    .bg-success-faint { background-color: #d4edda; }
    .text-success-dark { color: #155724; }
    .bg-success-dark { background-color: #28a745; }

    /* Failed (red) */
    .bg-danger-faint { background-color: #f8d7da; }
    .text-danger-dark { color: #721c24; }
    .bg-danger-dark { background-color: #dc3545; }

    /* Default (grey) */
    .bg-secondary-faint { background-color: #e2e3e5; }
    .text-secondary-dark { color: #383d41; }
    .bg-secondary-dark { background-color: #6c757d; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 12px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    /* Blue */
    .bg-primary-faint { background-color: #cfe2ff; }
    .text-primary-dark { color: #084298; }
    .bg-primary-dark { background-color: #0d6efd; }

    /* Grey (default) */
    .bg-secondary-faint { background-color: #e2e3e5; }
    .text-secondary-dark { color: #383d41; }
    .bg-secondary-dark { background-color: #6c757d; }



</style>
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">

            <div id="messages"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <!-- <a href="{{ route('adminEventsAdd')}}" class="btn btn-primary" style="float:right"><i
                                    class="fa fa-arrow"></i> Add Events </a> -->
                            <div class="table table-responsive">
                            <table class="table custom-table mb-0" id="eventTicketTable">
                                    <thead>
                                        <tr>
                                        <th>Order Id</th> 
                                                                            <th>Event</th>
                                                                            <th>User</th>
                                                                            <th>Email</th>
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

<script type="text/javascript">
 var base_url = "{{ url('/admin/') }}";
    var eventTicketTable;
    $(document).ready(function() {

        eventTicketTable = $('#eventTicketTable').DataTable({
            'ajax': "{{ route('adminticketorderList')}}",
            'order': [],
           
        });

 

    });
    function viewFunc(id) {
        console.log(id); 
        var url = "{{ route('viewOrder', ':id') }}";
        url = url.replace(':id', id); 
        console.log(url); 
        window.open(url, '_blank');
    };


</script>













@endsection
