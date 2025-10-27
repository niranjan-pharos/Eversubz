@extends('admin.template.master')
@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>
            <div class="row">
                <div class="col float-right ml-auto">
                    <a href="{{ route('adminDonationPackages')}}" class="btn btn-primary mb-3" style="float:right"><i
                            class="fa fa-mail-reply"></i> Donation List </a>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form  id="add_package" action="{{ route('adminDonationPackageCreate') }}" enctype="multipart/form-data" method="post"
                                role="form">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Package Name <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" required name="name" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Price</label>
                                                <input type="number" step="0.01" class="form-control" id="price"
                                                    name="price">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Quantity</label>
                                                <input type="number" class="form-control" id="quantity"
                                                    name="quantity">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Pakcage Includes</label>
                                                <textarea class="form-control" id="packageIncludes"
                                                    placeholder="Describe your Packagge Information" maxlength="1000"
                                                    name="in_packages"
                                                    oninput="updateCharCount()">{{ old('packageIncludes') }}</textarea>
                                                
                                            </div>
                                        </div>                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description</label>
                                                <textarea class="form-control" id="adDescription"
                                                    placeholder="Describe your message" maxlength="1000"
                                                    name="description"
                                                    oninput="updateCharCount()">{{ old('description') }}</textarea>
                                                
                                            </div>
                                        </div>                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Image</label>
                                                <input type="file" class="form-control" id="image"
                                                    name="image">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gallery Images (optional)</label>
                                            <input type="file" name="gallery[]" id="gallery" class="form-control" multiple accept=".jpg,.jpeg,.png,.webp">
                                            <small class="text-muted">You can choose multiple files.</small>
                                        </div>                                      
                                        <div class="col-sm-6">
                                            <div class="form-group"><br />
                                                <label for="col-form-label">Status:</label><br />
                                                <input type="checkbox" id="status" name="status" value="1">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                              

                                <div class="submit-section">
                                    <button class="btn btn-primary submitBtn">Submit</button>
                                    <br>
                                </div>
                                <div id="loader" style="display: none;">
                                    <div class="spinner">Loading...</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script>
    $(document).ready(function() {
        $('#adDescription, #packageIncludes').summernote({
            height: 150
        });
    });



    $('#add_package').on('submit', function(e) {
        e.preventDefault();

        $('.submitBtn').attr('disabled', 'disabled');

        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('adminDonationPackageStore') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(response) {
                toastr.success(response.message);
                $('#add_package')[0].reset(); 
                $('#adDescription').summernote('code', '');
                $('#packageIncludes').summernote('code', '');
                if (typeof updateCharCount === 'function') {
                    updateCharCount();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            },
            complete: function() {
                $('#loader').hide();
                $('#submitBtn').removeAttr('disabled');
            }
        });
    });

</script>
<style>
.form-control {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #000;
    height: 40px;

    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    border: 1px solid #00000040 !important;

}

.form-control:focus {
    outline: none;
    box-shadow: none;
    background: #fff;
    border-color: var(--primary);
}

.col-form-label {
    color: #000;
}
</style>

@endsection