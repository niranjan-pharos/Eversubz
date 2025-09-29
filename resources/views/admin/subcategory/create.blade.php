<!-- create category modal -->
<div class="modal custom-modal center-model fade" tabindex="-1" role="dialog" id="addModalSubcategory">
    <div class="modal-dialog right-side" role="document">
        <div class="modal-content right-content">
            <div class="modal-header">

                <h4 class="modal-title">Add SubCategory Info</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('subcategory.store') }}" method="post" role="form" id="add_subcategory">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">

                            <div class="form-group">
                                <label class="col-form-label">Category <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control select2 ajax_category" name="category">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Subcategory Name <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" required type="text" name="name">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control selec" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
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