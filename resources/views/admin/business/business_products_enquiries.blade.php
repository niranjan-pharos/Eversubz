@extends('admin.template.master')

@section('content')

<style>
    h5{margin-bottom:20px}.product-card{border-radius:8px;margin-bottom:30px;background:var(--chalk);overflow:hidden;border:1px solid var(--border);transition:all linear .3s;-webkit-transition:all linear .3s;-moz-transition:all linear .3s;-ms-transition:all linear .3s;-o-transition:all linear .3s}body{background:#fff}.btn{padding:.375rem .75rem}

    .container {
        max-width: fit-content !important;
      }
 </style>
 <section class="bookmark-part">
     <div class="container">
         <div class="row">
             <h5 class="mb-4">Business Products Enquiries</h5>
             <div class="table-responsive">
                 @if (session('error'))
                     <div class="alert alert-danger">
                         {{ session('error') }}
                     </div>
                 @endif
                 @if ($enquiries->isEmpty())
                     <div class="alert alert-info">
                         No enquiries found for your products.
                     </div>
                 @else
                     <table id="enquiries-table" class="table table-bordered table-striped">
                         <thead>
                             <tr>
                                 <th>Sr.No.</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Phone</th>
                                 <th>Message</th>
                                 <th>Product</th>
                                 <th>Date</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($enquiries as $enquiry)
                             <tr id="enquiry-row-{{ $enquiry->id }}">
                                     <td>{{ $loop->iteration }}</td>
                                     <td>{{ $enquiry->name }}</td>
                                     <td>{{ $enquiry->email }}</td>
                                     <td>{{ $enquiry->phone ?? '-' }}</td>
                                     <td>{{ $enquiry->message ?? '-' }}</td>
                                     <td>{{ $enquiry->product_slug }}</td>
                                     <td>{{ $enquiry->created_at->format('d-m-Y H:i') }}</td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
             </div>
                     <div class="d-flex justify-content-center">
                         {{ $enquiries->links('pagination::bootstrap-5') }}
                     </div>
                 @endif
             
         </div>
     </div>
 </section> 
 

 
 <script>
    $(document).ready(function(){$('#enquiries-table').DataTable({"paging":!0,"searching":!0,"ordering":!0,"info":!0});$('.delete-enquiry').on('click',function(){var enquiryId=$(this).data('enquiry-id');var row=$('#enquiry-row-'+enquiryId);if(confirm('Are you sure you want to delete this enquiry?')){$.ajax({url:'{{ url('business/enquiries') }}/'+enquiryId,method:'DELETE',data:{_token:'{{ csrf_token() }}'},success:function(response){if(response.success){row.fadeOut(300,function(){row.remove()});alert(response.success)}else{alert('Failed to delete enquiry.')}},error:function(xhr,status,error){console.error(error)}})}})})
 </script>
@endsection
