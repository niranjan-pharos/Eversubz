<!-- Add Attribute Modal -->
<div class="modal fade" id="addModalAttribute" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-end" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Attribute Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="add_attribute" method="POST" action="{{ route('storeAttribute') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="value" name="value" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Add Attribute</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
