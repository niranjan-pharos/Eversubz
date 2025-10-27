@extends('admin.template.master')

@section('content')
<style>
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th, .custom-table td {
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

    .price-negative {
        color: #ff0000;                  /* Red text */
        background-color: rgba(255,0,0,0.15); /* Light red background */
        font-weight: 500;
        padding: 2px 17px;
        border-radius: 4px;
        display: inline-block;
        font-size: 12px;
    }

    .price-positive {
        color: #28a745; /* Green text */
        background-color: rgba(40,167,69,0.15); /* Light green background */
        font-weight: 500;
        padding: 2px 17px;
        border-radius: 4px;
        display: inline-block;
        font-size: 12px;
    }
</style>

<div class="search-lists">
    <div class="tab-content">
        <div id="messages"></div>

        <div class="row mb-3">
            <div class="col text-end">
                <button class="btn btn-primary add-btn" data-bs-toggle="modal"
                        data-bs-target="#addModalAttribute">
                    <i class="fa fa-plus"></i> Add Attribute
                </button>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0" id="attributeTable">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Attribute Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attribute</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="attribute_id" id="attribute_id">

                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_type" name="edit_type" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_value" class="form-label">Value <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_value" name="edit_value" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="edit_status" name="edit_status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Attribute</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Attribute Modal -->
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header remove">
                <h5 class="modal-title">Remove Attribute</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="removeForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Do you really want to remove this attribute?</p>
                    <input type="hidden" name="attribute_id" id="attribute_remove_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete Attribute</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var attributeTable = $('#attributeTable').DataTable({
            ajax: "{{ route('fetchAttributeList') }}",
            columns: [
                { data: 'type' },
                { data: 'value' },
                { 
                    data: 'status',
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="change-status" data-id="${row.id}" ${data == 1 ? 'checked' : ''} />`;
                    }
                },
                { 
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-sm btn-info" onclick="editFunc(${row.id})">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="removeFunc(${row.id})">Delete</button>
                        `;
                    }
                }
            ]
        });

        // Change Status
        $('body').on('change', '.change-status', function() {
            let status = $(this).is(':checked') ? 1 : 0;
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('attribute.change-status') }}",
                type: 'PUT',
                data: { _token: '{{ csrf_token() }}', id: id, status: status },
                success: function(response) { toastr.success(response.message); }
            });
        });

        // Edit Attribute
        window.editFunc = function(id) {
            $.get(`{{ url('admin/attribute') }}/${id}/edit`, function(response) {
                $('#attribute_id').val(response.data.id);
                $('#edit_type').val(response.data.type);
                $('#edit_value').val(response.data.value);
                $('#edit_status').val(response.data.status);
                $('#editModal').modal('show');

                $('#updateForm').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        url: `{{ url('admin/attribute') }}/${id}`,
                        type: 'PUT',
                        data: formData,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#editModal').modal('hide');
                            attributeTable.ajax.reload();
                        },
                        error: function(xhr) {
                            toastr.error("An error occurred!");
                        }
                    });
                });
            });
        }

        // Delete Attribute
        window.removeFunc = function(id) {
            $('#attribute_remove_id').val(id);
            $('#removeModal').modal('show');

            $('#removeForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: `{{ url('admin/attribute') }}/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#removeModal').modal('hide');
                        attributeTable.ajax.reload();
                    },
                    error: function(xhr) {
                        toastr.error("Failed to delete attribute!");
                    }
                });
            });
        }
    });
</script>

@include('admin.product_attributes.create')
@endsection
