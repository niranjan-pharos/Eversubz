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
                                        <th>Updated Date</th>
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

<div class="modal custom-modal fade" tabindex="-1" role="dialog" id="removeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header remove">

                <h4 class="modal-title">Remove Report</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form method="DELETE" id="removeForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">                   
                    <p>Do you really want to remove?</p>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger submit-btn">Delete Report</button>
                    <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                </div>
            </form>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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
            var base_url = "{{ url('/admin/') }}";
            var reportTable;

            reportTable = $('#reportTable').DataTable({
                'ajax': "{{ route('admin.ajax.event.reports') }}",
                'order': [],
                dom: '<"row mb-3" <"col-md-4"l> <"col-md-4 text-center"B> <"col-md-4 d-flex justify-content-end"f> >rtip',
                buttons: [
                  {
                    extend: 'collection',
                    text: '<i class="fa fa-print"></i> Export',
                    className: 'btn btn-outline-dark',
                    buttons: [
                      { extend: 'print', text: 'Print' },
                      { extend: 'excelHtml5', text: 'Excel' },
                      { extend: 'csvHtml5', text: 'CSV' },
                      { extend: 'pdfHtml5', text: 'PDF', orientation: 'landscape', pageSize: 'A4' },
                      {
                        text: 'Word',
                        action: function ( e, dt, node, config ) {
                          var data = dt.buttons.exportData({decodeEntities: true});

                          var html = '<table border="1">';
                          html += '<tr>' + data.header.map(h => '<th>' + h + '</th>').join('') + '</tr>';
                          data.body.forEach(row => {
                            html += '<tr>' + row.map(cell => {
                                var div = document.createElement('div');
                                div.innerHTML = cell;
                                var img = div.querySelector('img');
                                if(img) return '<td>' + img.src + '</td>';
                                return '<td>' + div.textContent + '</td>';
                            }).join('') + '</tr>';
                          });
                          html += '</table>';

                          var blob = new Blob(['\ufeff', html], { type: 'application/msword' });
                          var url = URL.createObjectURL(blob);
                          var a = document.createElement('a');
                          a.href = url;
                          a.download = 'Orders.doc';
                          document.body.appendChild(a);
                          a.click();
                          document.body.removeChild(a);
                        }
                      }
                    ]
                  }
                ]
            });

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

        });

    function removeFunc(id) {
        if (id) { 
            $("#removeForm").on('submit', function() {
                var form = $(this);
                $(".text-danger").remove();

                $.ajax({
                    url: '{{ route("admin.event.report.delete", ":id") }}'.replace(':id', id),
                    type: form.attr('method'),
                    data: {
                        "_token": "{{ csrf_token() }}",
                        del_id: id,
                        _method: 'DELETE'  
                    },
                    dataType: 'json',
                    success: function(response) {
                        if ($.fn.DataTable.isDataTable('#reportTable')) {
                            $('#reportTable').DataTable().ajax.reload(null, false);
                        }
                        $("#removeModal").modal('hide');
                        if (response.success === true) {
                            toastr.success(response.messages);
                        } else {
                            if (response.error instanceof Array) {
                                    var errorMessages = '';
                                    $.each(response.error, function (key, value) {
                                        errorMessages += value.join('<br>'); 
                                    });
                                    toastr.error(errorMessages);
                                } else {
                                    toastr.error(response.error);
                                }
                                
                                $("#removeModal").modal('hide');
                        
                            }
                        }
                });

                return false;
            });
        }

    };
    </script>


@endsection