@extends('admin.template.master')

@section('content')
<div class="search-lists">
    <div class="tab-content">
        <div id="messages"></div> 

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table mb-0" id="reviewTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Post Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Ratings</th>
                                        <th>Review Category</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $key => $review)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ $review->category }}</td>
                                        <td>{{ $review->description }}</td>
                                        <td>
                                            <span class="change-review-status-span">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input change-status-checkbox"
                                                        data-review-id="{{ $review->id }}" type="checkbox"
                                                        role="switch" id="reviewStatus_{{ $review->id }}"
                                                        {{ $review->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger delete-review" data-review-id="{{ $review->id }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete confirmation Modal -->

<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th, .custom-table td {
        padding: 8px;
        word-wrap: break-word; /* Enable text wrapping */
        white-space: normal;
    }

    .custom-table th {
        background-color: #f2f2f2;
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


<script>
    $(document).ready(function () {

       
        // change status 
        $('body').on('change', '.change-status-checkbox', function () {
            let isChecked = $(this).is(':checked');
            let reviewId = $(this).data('review-id');
            $.ajax({
                url: "{{ route('review.change_status') }}",
                method: 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: isChecked ? 1 : 0,
                    id: reviewId
                },
                success: function (response) {
                    console.log(response);
                    toastr.success(response.message);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    toastr.error("Error changing review status");
                }
            });
        });

         // delete review
         $('body').on('click', '.delete-review', function () {
            if (confirm('Are you sure you want to delete this review?')) {
                let reviewId = $(this).data('review-id');
                $.ajax({
                    url: "{{ route('review.destroy') }}",
                    method: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: reviewId
                    },
                    success: function (response) {
                        console.log(response);
                        toastr.success(response.message);
                        // Reload page or update the table as needed
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        toastr.error("Error deleting review");
                    }
                });
            }
        });
    });
</script>



@endsection