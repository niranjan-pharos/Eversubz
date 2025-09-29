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
                            <table class="table custom-table mb-0" id="enquiryTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Business Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Description</th>
                                        <th>Enquiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated here dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    $(document).ready(function() {
        function fetchEnquiries() {
            $.ajax({
                url: '{{ route('admin.ajax.business.enquiries') }}',
                method: 'GET',
                success: function(data) {
                    var tableBody = $('#enquiryTable tbody');
                    tableBody.empty();

                    data.forEach(function(enquiry, index) {
                        var businessName = enquiry.enquiryable ? enquiry.enquiryable.business_name : 'N/A';
                        var enquiryDate = new Date(enquiry.created_at);
                        var formattedDate = ('0' + enquiryDate.getDate()).slice(-2) + '/' + ('0' + (enquiryDate.getMonth() + 1)).slice(-2) + '/' + enquiryDate.getFullYear();

                        var row = `
                            <tr data-enquiry-id="${enquiry.id}">
                                <td>${index + 1}</td>
                                <td>${businessName}</td>
                                <td>${enquiry.name}</td>
                                <td>${enquiry.email}</td>
                                <td>${enquiry.phone}</td>
                                <td>${enquiry.description}</td>
                                <td>${formattedDate}</td>
                                <td>
                                    <button class="btn btn-danger delete-enquiry" data-enquiry-id="${enquiry.id}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });

                    $('.delete-enquiry').on('click', function() {
                        var enquiryId = $(this).data('enquiry-id');
                        deleteEnquiry(enquiryId);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        };

        function deleteEnquiry(id) {
            if (confirm('Are you sure you want to delete this enquiry?')) {
                $.ajax({
                    url: '{{ url('admin/business/enquiries') }}/' + id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        fetchEnquiries();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        };

        fetchEnquiries();
    });
</script>

@endsection
