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
                            <table class="table custom-table mb-0" id="eventTickets">
                                <thead>
                                        <th>Event Date</th>
                                        <th>Event Name</th>
                                        <th>Amount</th>
                                        <th>Buyer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Description</th>
                                        <th>No. of Tickets</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated here by JavaScript -->
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

.custom-table th,
.custom-table td {
    padding: 8px;
    border: 1px solid #ddd;
    word-wrap: break-word;
    /* Enable text wrapping */
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
            $(document).ready(function() {
            $('#eventTickets').DataTable({
                ajax: {
                    url: '{{ route('admin.ajax.event.tickets') }}',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'event_date' },
                    { data: 'event_title' },
                    { data: 'event_price' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'phone' },
                    { data: 'description' },
                    { data: 'ticket_count' }
                ]
            });
        });
            function deleteEnquiry(id) {
                if (confirm('Are you sure you want to delete this enquiry?')) {
                    $.ajax({
                        url: '{{ url('admin/events/enquiries') }}/' + id,
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