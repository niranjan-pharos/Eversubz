@extends('frontend.template.master')
@section('title',  "My Posts")

@section('content')

@include('frontend.template.usermenu')

<link rel="stylesheet" href="assets/css/custom/my-ads.css">

<section class="bookmark-part">
        <div class="container">
            <div class="row">
                <h5>Enquiries for {{ $adPost->title }}</h5>
                <div class="table-responsive">
                <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Reason</th>
                                <th>Email</th>
                                <th>Details</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adPost->reports as $key => $report)
                                <tr id="report-{{ $report->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $report->reason }}</td>
                                    <td>{{ $report->email }}</td>
                                    <td>{{ $report->details }}</td>
                                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <button class="btn btn-danger delete-enquiry" data-report-id="{{ $report->id }}">
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

    <script>
      $(document).ready(function(){$('.delete-enquiry').on('click',function(e){e.preventDefault();var button=$(this);var reportId=button.data('report-id');if(confirm('Are you sure you want to delete this report?')){$.ajax({url:'/report/'+reportId,type:'DELETE',data:{_token:'{{ csrf_token() }}'},success:function(response){$('#report-'+reportId).remove();alert(response.success)},error:function(xhr){alert('An error occurred while deleting the report.')}})}})})
    </script>
@endsection