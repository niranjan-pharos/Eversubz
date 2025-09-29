@extends('frontend.template.master')
@section('title',  "My Events Bookings")

@section('content')
@include('frontend.template.usermenu')


<style>
  h5{margin-bottom:20px}.product-card{border-radius:8px;margin-bottom:30px;background:var(--chalk);overflow:hidden;border:1px solid var(--border);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s}body{background:#fff}.btn{padding:.375rem .75rem}
</style>
<section class="bookmark-part">
    <div class="container">
        <div class="row">
            <h5>Enquiries for {{ $event->title }}</h5>
            <div class="table-responsive">
                <table id="bookings-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Description</th>
                            <th>Tickets</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $key => $booking)
                            <tr id="booking-row-{{ $booking->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->description }}</td>
                                <td>{{ $booking->tickets }}</td>
                                <td>
                                    <button class="btn btn-danger delete-booking" data-booking-id="{{ $booking->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
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
  $(document).ready(function(){$('#bookings-table').DataTable({"paging":!0,"searching":!0,"ordering":!0,"info":!0});$('.delete-booking').on('click',function(){var bookingId=$(this).data('booking-id');var row=$('#booking-row-'+bookingId);if(confirm('Are you sure you want to delete this booking?')){$.ajax({url:'{{ url('events/bookings') }}/'+bookingId,method:'DELETE',data:{_token:'{{ csrf_token() }}'},success:function(response){if(response.success){row.fadeOut(300,function(){row.remove()});alert(response.message)}else{alert('Failed to delete booking.')}},error:function(xhr,status,error){console.error(error);alert('An error occurred while deleting the booking.')}})}})})
</script>
@endsection
