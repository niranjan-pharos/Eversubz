@extends('admin.template.master')

@section('content')
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div> 
            <div class="row" >
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form  method="post" role="form" id="add_message">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Heading <span class="text-danger">*</span></label>
                                                <input class="form-control " type="text" required name="heading" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" required name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="col-form-label">Order By<span class="text-danger">*</span></label>
                                            <input class="form-control " type="text"  name="orderby" >
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="col-form-label">Status<span class="text-danger">*</span></label><br />
                                            <input type="radio" name="status" value="1" checked>Active 
                                            <input type="radio" name="status" value="0" >In Active
                                        </div>
                                        
                                    </div>
                                </div>
                            
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
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


 <script>
    $(document).ready(function() {        

    $('#add_message').on('submit', function(e) {
        e.preventDefault();

        // Disable the submit button
        $('#submitBtn').attr('disabled', 'disabled');

        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('adminAnnouncementCreate') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(response) {
                toastr.success(response.message);
                $('#add_message')[0].reset(); // Reset the form
                $('.select2').val(null).trigger('change'); // Reset Select2 fields
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