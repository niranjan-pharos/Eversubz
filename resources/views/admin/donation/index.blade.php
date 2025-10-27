@extends('admin.template.master')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

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
                                <table class="table custom-table mb-0" id="donationTable">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Amount</th>
                                            <th>Tip</th>
                                            <th>Total Amount</th>
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th class="text-right">Action</th>
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

        <!-- Delete confirmation Modal -->
        <div class="modal custom-modal fade" id="delete_category" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Fundraising</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-bs-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Modal -->

        <!-- Response Modal -->
        <div class="modal fade" id="submit_responseModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="exampleModalCenterTitle">Response</h6>
                        <button type="button" class="close " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body " id="responseMrmEdit">
                        <div id="model_messages"></div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
        <!-- End Response Modal -->

        <script type="text/javascript">
            var donationTable = null;
        
            function buildDonationTable() {
                const urlSegments = window.location.href.split('/').filter(Boolean);
                const fundraising_id = urlSegments.pop();

                if ($.fn.DataTable.isDataTable('#donationTable')) {
                    $('#donationTable').DataTable().clear().destroy();
                    $('#donationTable').empty();
                }

                $('#donationTable').DataTable({
                    ajax: {
                        url: "{{ route('adminDonationList') }}" + "?fundraising_id=" + fundraising_id,
                        dataSrc: 'data',
                        error: function (xhr, error, thrown) {
                            console.error('DataTables Ajax Error:', xhr?.responseText || error || thrown);
                        }
                    },
                    order: [],
                    columns: [
                        { title: "Number" },
                        { title: "Title" },
                        { title: "Name" },
                        { title: "Email" },
                        { title: "Amount" },
                        { title: "Tip" },
                        { title: "Total Amount" },
                        { title: "Country" },
                        { title: "Status" },
                        { title: "Created At" },
                        { title: "Action" }
                    ],
                    columnDefs: [
                        {
                            targets: -1,
                            orderable: false,
                            searchable: false,
                            className: 'no-export text-right'
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'csvHtml5',
                            text: 'Download CSV',
                            title: 'Donations',
                            className: 'btn btn-sm btn-primary',
                            exportOptions: { columns: ':visible:not(.no-export)' }
                        },
                        {
                            extend: 'excelHtml5',
                            text: 'Download Excel',
                            title: 'Donations',
                            className: 'btn btn-sm btn-success',
                            exportOptions: { columns: ':visible:not(.no-export)' }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'Download PDF',
                            title: 'Donations',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            className: 'btn btn-sm btn-danger',
                            exportOptions: { columns: ':visible:not(.no-export)' }
                        },
                        {
                            extend: 'print',
                            text: 'Print Table',
                            className: 'btn btn-sm btn-secondary',
                            exportOptions: { columns: ':visible:not(.no-export)' }
                        }
                    ]
                });
            }

            $(document).ready(function () {
                buildDonationTable();
        
                $('body').on('click', '.change-status', function () {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: '{{ route('fundraisingChangeStatus') }}',
                        method: 'PUT',
                        data: { "_token": "{{ csrf_token() }}", status: isChecked ? 'active' : 'inactive', id },
                        success: function (response) {
                            toastr.success(response.message);
                            if (donationTable) donationTable.ajax.reload(null, false);
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            toastr.error('Failed to change status');
                        }
                    });
                });
        
                $('body').on('click', '.featured-status', function () {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        url: '{{ route('fundraisingChangeFeatured') }}',
                        method: 'PUT',
                        data: { "_token": "{{ csrf_token() }}", status: isChecked, id },
                        success: function (response) {
                            toastr.success(response.message);
                            if (donationTable) donationTable.ajax.reload(null, false);
                        }
                    });
                });
        
                $('body').on('click', '.delete-fundraising', function () {
                    let slug = $(this).data('slug');
                    $('#delete_category').modal('show');
                    $('.continue-btn').data('slug', slug);
                });
        
                $('.continue-btn').on('click', function () {
                    let slug = $(this).data('slug');
                    $.ajax({
                        url: '{{ route('fundraisingDestroyBySlug') }}',
                        method: 'DELETE',
                        data: { "_token": "{{ csrf_token() }}", slug },
                        success: function (response) {
                            toastr.success(response.message);
                            $('#delete_category').modal('hide');
                            if (donationTable) donationTable.ajax.reload(null, false);
                        }
                    });
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
        </style>
        @endsection