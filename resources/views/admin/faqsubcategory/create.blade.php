<!-- resources/views/faq_sub_categories/create.blade.php -->
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
                <form action="{{ route('faqSubcategory.create') }}" method="POST" role="form" id="add_subcategory">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-form-label">Category <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($faqCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Subcategory Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" required>
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
