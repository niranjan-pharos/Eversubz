@extends('admin.template.master')

@section('content')
<style>
    .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    padding: 4px 10px;
    border-radius: 12px;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

/* Info (Normal User) */
.bg-info-faint { background-color: #cff4fc; }
.text-info-dark { color: #055160; }
.bg-info-dark { background-color: #0dcaf0; }

/* Primary (Business A/c) */
.bg-primary-faint { background-color: #cfe2ff; }
.text-primary-dark { color: #084298; }
.bg-primary-dark { background-color: #0d6efd; }

/* Success (NGO A/c) */
.bg-success-faint { background-color: #d1e7dd; }
.text-success-dark { color: #0f5132; }
.bg-success-dark { background-color: #198754; }

/* Warning (Candidate Profile) */
.bg-warning-faint { background-color: #fff3cd; }
.text-warning-dark { color: #664d03; }
.bg-warning-dark { background-color: #ffc107; }

/* Secondary (Unknown) */
.bg-secondary-faint { background-color: #e2e3e5; }
.text-secondary-dark { color: #383d41; }
.bg-secondary-dark { background-color: #6c757d; }

</style>
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0" id="deletedUserTable">
                                    <thead>
                                        <tr>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Account Type</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Restore</th>
                                            <th>Deleted Date</th>
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
    </div>
</div>

<!-- Delete confirmation Modal -->


<script>
    $(document).ready(function() {
        $(document).on('change', '.restore-switch', function() {
            let userId = $(this).data('user-id');
            let status = $(this).is(':checked') ? 1 : 0;
            let label = $(this).next('label');

            $.ajax({
                url: '{{ route('update.user.restore') }}',
                type: 'POST',
                data: {
                    user_id: userId,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        deletedUserTable.ajax.reload();
                    } else {
                        toastr.error(response.message);
                        if (!status) {
                            $(this).prop('checked', false);
                        }
                    }
                }.bind(this),
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while processing your request.');
                    if (!status) {
                        $(this).prop('checked', false);
                    }
                }.bind(this)
            });
        });

        
        var base_url = "{{ url('/admin') }}"; 
        var deletedUserTable;

        $(document).ready(function() {
            deletedUserTable = $('#deletedUserTable').DataTable({
                'ajax': {
                    'url': "{{ route('userDeletedList') }}", 
                    'dataSrc': 'data'
                },
                'order': [[0, 'desc']],
                columns: [
                    { data: 0, name: 'ID' },
                    { data: 1, name: 'Name' },
                    { data: 2, name: 'Username' },
                    { data: 3, name: 'Account Type' },
                    { data: 4, name: 'Email' },
                    { data: 5, name: 'Phone' },
                    { data: 6, name: 'Restore' },
                    { data: 7, name: 'Deleted Date' },
                ]
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
    /* Enable text wrapping */
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