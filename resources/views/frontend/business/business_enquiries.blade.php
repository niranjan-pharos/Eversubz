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
            <h5>Enquiries for {{ $business->business_name }}</h5>
            <div class="table-responsive">
                <table id="enquiries-table" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Appointment Date</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enquiries as $key => $enquiry)
                            <tr id="enquiry-row-{{ $enquiry->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $enquiry->name }} {{ $enquiry->last_name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($enquiry->appointment_date)->format('d M Y') }}
                                </td>
                                <td>{{ $enquiry->description }}</td>
                                <td>
                                    <button class="btn btn-danger delete-enquiry" data-enquiry-id="{{ $enquiry->id }}">
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
   $(document).ready(function(){$('#enquiries-table').DataTable({"paging":!0,"searching":!0,"ordering":!0,"info":!0});$('.delete-enquiry').on('click',function(){var enquiryId=$(this).data('enquiry-id');var row=$('#enquiry-row-'+enquiryId);if(confirm('Are you sure you want to delete this enquiry?')){$.ajax({url:'{{ url('business/enquiries') }}/'+enquiryId,method:'DELETE',data:{_token:'{{ csrf_token() }}'},success:function(response){if(response.success){row.fadeOut(300,function(){row.remove()});alert(response.success)}else{alert('Failed to delete enquiry.')}},error:function(xhr,status,error){console.error(error)}})}})})
</script>
@endsection
