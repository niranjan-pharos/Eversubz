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
                            <div class="table-responsive">
                                <table class="table custom-table mb-0" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Account Type</th>
                                            <th>Email</th>
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
        'order': [[1, 'desc']],
        columns: [
            { data: 0, name: 'Action', className: 'text-center' },
            { data: 1, name: 'ID' },
            { data: 2, name: 'Name' },
            { data: 3, name: 'Username' },
            { data: 4, name: 'Account Type' },
            { data: 5, name: 'Email' },
            { data: 6, name: 'Phone' },
            { data: 7, name: 'Status' },
            { data: 8, name: 'Admin Approved' },
            { data: 9, name: 'Module Visible' }
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