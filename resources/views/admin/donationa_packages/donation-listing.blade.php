@extends('admin.template.master')

@section('content')
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table custom-table mb-0" id="donationPackagesListingTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Amount</th>
                                            <th>Total Amount</th>
                                            <th>Payment Status</th>
                                            <th>Donation Number</th>
                                            <th>Created Date</th>
                                            <th>Updated Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript">
        var base_url = "{{ url('/admin/') }}";

        $(document).ready(function () {
            $('#donationPackagesListingTable').DataTable({
                'ajax': "{{ route('adminDonationPaymentList') }}",
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
                                action: function (e, dt, node, config) {
                                    var data = dt.buttons.exportData({decodeEntities: true});

                                    var html = '<table border="1">';
                                    html += '<tr>' + data.header.map(h => '<th>' + h + '</th>').join('') + '</tr>';
                                    data.body.forEach(row => {
                                        html += '<tr>' + row.map(cell => {
                                            var div = document.createElement('div');
                                            div.innerHTML = cell;
                                            var img = div.querySelector('img');
                                            if (img) return '<td>' + img.src + '</td>';
                                            return '<td>' + div.textContent + '</td>';
                                        }).join('') + '</tr>';
                                    });
                                    html += '</table>';

                                    var blob = new Blob(['\ufeff', html], { type: 'application/msword' });
                                    var url = URL.createObjectURL(blob);
                                    var a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'DonationPackagesList.doc';
                                    document.body.appendChild(a);
                                    a.click();
                                    document.body.removeChild(a);
                                }
                            }
                        ]
                    }
                ]
            });
        });

    </script>

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
            white-space: break-spaces;
        }

        .custom-table th {
            background-color: #f2f2f2 !important;
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

        .dt-button-background{
            background: none !important;
        }

        .item-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 12px;
        }

        .item-status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .item-status-pending {
            background-color: #fff3cd; /* light yellow */
            color: #ffc107;            /* dark yellow/brown */
        }
        .item-status-pending .item-status-dot {
            background-color: #ffc107; /* dark yellow */
        }

        .item-status-success {
            background-color: #d4edda; /* light green */
            color: #28a745;
        }
        .item-status-success .item-status-dot {
            background-color: #28a745;
        }

        .item-status-failed {
            background-color: #f8d7da; /* light red */
            color: #dc3545;
        }
        .item-status-failed .item-status-dot {
            background-color: #dc3545;
        }
    </style>
@endsection
