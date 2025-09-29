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
