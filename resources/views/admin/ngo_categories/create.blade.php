<!-- create category modal -->
<div class="modal custom-modal center-model fade" tabindex="-1" role="dialog" id="addModalCategory">
    <div class="modal-dialog right-side" role="document">
        <div class="modal-content right-content">
            <div class="modal-header">

                <h4 class="modal-title">Add Category Info</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
            <form action="{{ route('ngoCategory.create') }}" method="post" role="form" id="add_category">
    @csrf
    <div class="col-md-12"> 
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-form-label">Name <span class="text-danger">*</span></label>
                    <input class="form-control" required type="text" name="name">
                </div>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control selec" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="text-center modal-footer-div">
            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
        </div>
    </div>
</form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->