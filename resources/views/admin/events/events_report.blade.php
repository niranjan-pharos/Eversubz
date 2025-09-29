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
                            <table class="table custom-table mb-0" id="reportTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Event Name</th>
                                        <th>User Name</th>
                                        <th>Reason</th>
                                        <th>Report Date</th>
                                        <th>Action</th>
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
        $(document).ready(function () {
            function fetchReports() {
                $.ajax({
                    url: '{{ route('admin.ajax.event.reports') }}',
                    method: 'GET',
                    success: function (data) {
                        var tableBody = $('#reportTable tbody');
                        tableBody.empty();

                        data.forEach(function (report, index) {
                            var eventName = report.event ? report.event.title : 'N/A';
                            var userName = report.user ? report.user.name : 'N/A';

                            var reportDate = new Date(report.created_at);
                            var formattedDate = ('0' + reportDate.getDate()).slice(-2) + '/' + ('0' + (reportDate.getMonth() + 1)).slice(-2) + '/' + reportDate.getFullYear();

                            var row = `
                                <tr data-report-id="${report.id}">
                                    <td>${index + 1}</td>
                                    <td>${eventName}</td>
                                    <td>${userName}</td>
                                    <td>${report.reason}</td>
                                    <td>${formattedDate}</td>
                                    <td>
                                        <button class="btn btn-danger delete-report" data-report-id="${report.id}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });

                        $('.delete-report').on('click', function () {
                            var reportId = $(this).data('report-id');
                            deleteReport(reportId);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            };

            function deleteReport(id) {
                if (confirm('Are you sure you want to delete this report?')) {
                    $.ajax({
                        url: '{{ url('admin/events/reports') }}/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            alert(response.success);
                            fetchReports();
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            };

            fetchReports();
        });
    </script>


@endsection