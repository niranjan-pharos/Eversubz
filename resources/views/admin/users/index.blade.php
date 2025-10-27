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
                                <table class="table custom-table mb-0" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Created Date</th>
                                            <th>User Id</th>
                                            <th>Email</th>
                                            <th>Account Type</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th>Admin Approved</th>
                                            <th>Module Access</th>
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
        $(document).on('change', '.status-switch', function() {
            let userId = $(this).data('user-id');
            let status = $(this).is(':checked') ? 1 : 0;
            let label = $(this).next('label');
    
            $.ajax({
                url: '{{route('update.user.status')}}',
                type: 'POST',
                data: {
                    user_id: userId,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error(response.message);
                }
            });
        });
    
        
        $(document).on('change', '.admin-approved-switch', function() {
            let userId = $(this).data('user-id');
            let isAdminApproved = $(this).is(':checked') ? 1 : 0;
            let label = $(this).next('label');
    
            $.ajax({
                url: '{{route('update.admin.approved')}}',
                type: 'POST',
                data: {
                    user_id: userId,
                    is_admin_approved: isAdminApproved,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error(response.message);
                }
            });
        });


        $(document).on('change', '.module-enable-switch', function() {
            let userId = $(this).data('user-id');
            let moduleApproved = $(this).is(':checked') ? 1 : 0;
            let label = $(this).next('label');
    
            $.ajax({
                url: '{{route('update.admin.module')}}',
                type: 'POST',
                data: {
                    user_id: userId,
                    is_module_visible: moduleApproved,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error(response.message);
                }
            });
        });
    });
    </script>


<script>
var base_url = "{{ url('/admin') }}"; 
var userTable;

$(document).ready(function() {
    userTable = $('#userTable').DataTable({
        'ajax': {
            'url': "{{ route('userList') }}", 
            'dataSrc': 'data'
        },
        columns: [
            { data: 0, name: 'Action', className: 'text-center' },
            { data: 1, name: 'Created Date' },
            { data: 2, name: 'UserID' },
            { data: 3, name: 'Email' },
            { data: 4, name: 'Account Type' },
            { data: 5, name: 'Phone' },
            { data: 6, name: 'Status' },
            { data: 7, name: 'Admin Approved' },
            { data: 8, name: 'Module Visible' }
        ]
    });
});




function removeUser(userId) {
    var confirmation = confirm("Are you sure you want to delete this user?");
    if (confirmation) {
        $.ajax({
            url: "{{ route('user.delete') }}",
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": userId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#user-row-' + userId).remove();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Failed to delete user: ' + (xhr.responseJSON ? xhr.responseJSON.message :
                    error));
            }
        });
    }
};


function viewUser(userId) {
    window.open("{{ url('admin/viewUser', ['id' => '']) }}/" + userId, '_blank');
};
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