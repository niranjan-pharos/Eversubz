@extends('frontend.template.master')
@section('title',  "my events enquiries")

@section('content')
@include('frontend.template.usermenu')

<style>
   h5{margin-bottom:20px}.product-card{border-radius:8px;margin-bottom:30px;background:var(--chalk);overflow:hidden;border:1px solid var(--border);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s}body{background:#fff}.btn{padding:.375rem .75rem}
</style>
<section class="bookmark-part">
    <div class="container">
        <div class="row">
            <h1>Event Ticket Listings</h1>

            @if(!$is_approved)
                <div class="alert alert-warning">
                    Your business is not approved yet.
                </div>
            @endif
            <div class="table-responsive">
                <table id="enquiries-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <tr>
                                <th>Icon</th>
                                <th>Order ID</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Event Time</th>
                                <th>Location</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Ticket Name</th>
                                <th>Ticket Type</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderTickets as $ticket)
                        <tr>
                            <td>
                                @if($ticket['icon'])
                                    <img src="{{ asset($ticket['icon']) }}" alt="Ticket Icon" width="50" height="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $ticket['order_id'] }}</td>
                            <td>{{ $ticket['event_title'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket['event_date'])->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket['event_time'])->format('H:i') }}</td>
                            <td>{{ $ticket['event_location'] }}</td>
                            <td>{{ $ticket['quantity'] }}</td>
                            <td>${{ number_format($ticket['price'], 2) }}</td>
                            <td>{{ $ticket['ticket_name'] }}</td>
                            <td>{{ ucfirst($ticket['ticket_type']) }}</td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
   $(document).ready(function(){$('#enquiries-table').DataTable({"paging":!0,"searching":!0,"ordering":!0,"info":!0});$('.delete-enquiry').on('click',function(){var enquiryId=$(this).data('enquiry-id');var row=$('#enquiry-row-'+enquiryId);if(confirm('Are you sure you want to delete this enquiry?')){$.ajax({url:'{{ url('business/enquiries') }}/'+enquiryId,method:'DELETE',data:{_token:'{{ csrf_token() }}'},success:function(response){if(response.success){row.fadeOut(300,function(){row.remove()});alert(response.success)}else{alert('Failed to delete enquiry.')}},error:function(xhr,status,error){console.error(error)}})}})})
</script>
@endsection
