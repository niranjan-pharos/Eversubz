@extends('admin.template.master')

@section('content')
{{-- CSS --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<div class="search-lists">
    <div class="tab-content">
        <div id="messages"></div>

        <div class="row">
            <div class="col float-right ml-auto">
                <a href="{{ route('adminDonationPackages') }}" class="btn btn-primary mb-3" style="float:right">
                    <i class="fa fa-mail-reply"></i> Donation List
                </a>
            </div>

            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <form id="update_package"
                              action="{{ route('adminDonationPackageUpdate', $donationInfo->id) }}"
                              enctype="multipart/form-data"
                              method="POST"
                              role="form">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <div class="row">

                                    {{-- Package Name --}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Package Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" required name="name"
                                                   value="{{ old('name', $donationInfo->name) }}">
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Price</label>
                                            <input type="number" step="0.01" class="form-control" id="price"
                                                   name="price" value="{{ old('price', $donationInfo->price) }}">
                                        </div>
                                    </div>

                                    {{-- Quantity --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Quantity</label>
                                            <input type="number" class="form-control" id="quantity"
                                                   name="quantity" value="{{ old('quantity', $donationInfo->quantity) }}">
                                        </div>
                                    </div>

                                    {{-- Package Includes --}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Package Includes</label>
                                            <textarea class="form-control" id="packageIncludes"
                                                      name="in_packages"
                                                      maxlength="1000">{{ old('in_packages', $donationInfo->in_packages) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Description</label>
                                            <textarea class="form-control" id="adDescription"
                                                      name="description"
                                                      maxlength="1000">{{ old('description', $donationInfo->description) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Main Image --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Main Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            @if($donationInfo->image)
                                                <img src="{{ asset('storage/' . $donationInfo->image) }}"
                                                     alt="Current Image" class="mt-2" width="100">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Gallery --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Gallery Images (optional)</label>
                                            <input type="file" name="gallery[]" id="gallery" class="form-control"
                                                   multiple accept=".jpg,.jpeg,.png,.webp">
                                            <small class="text-muted">You can choose multiple files.</small>

                                            @if($donationInfo->gallery && $donationInfo->gallery->count() > 0)
                                                <div class="mt-2 d-flex flex-wrap">
                                                    @foreach($donationInfo->gallery as $image)
                                                        <div class="position-relative me-2 mb-2" style="display:inline-block;">
                                                            <img src="{{ asset('storage/' . $image->image) }}" 
                                                                 width="80" height="80" 
                                                                 style="object-fit:cover; border:1px solid #ccc; border-radius:5px;">
                                                            
                                                            <button type="button" 
                                                                    class="btn btn-danger btn-sm position-absolute delete-gallery"
                                                                    data-id="{{ $image->id }}"
                                                                    style="top:2px; right:2px; border-radius:50%; width:24px; height:24px; line-height:10px; padding:0;">
                                                                ×
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="status">Status:</label><br>
                                            <input type="checkbox" id="status" name="status" value="1"
                                                   {{ old('status', $donationInfo->status) ? 'checked' : '' }}>
                                            <label for="status">Active</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submitBtn">Update</button>
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

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
$(document).ready(function() {
    $('#adDescription, #packageIncludes').summernote({ height: 150 });

    $('#update_package').on('submit', function(e) {
        e.preventDefault();
        $('.submitBtn').attr('disabled', true);
        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() { $('#loader').show(); },
            success: function(response) {
                toastr.success(response.message || 'Updated successfully!');
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
                $('.submitBtn').removeAttr('disabled');
            }
        });
    });
});

$(document).on('click', '.delete-gallery', function() {
    let imageId = $(this).data('id');
    let button = $(this);

    if (!confirm('Are you sure you want to delete this image?')) return;

    $.ajax({
        url: "{{ route('adminDonationGalleryDelete') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: imageId
        },
        success: function(response) {
            toastr.success(response.message);
            button.closest('div').remove();
        },
        error: function() {
            toastr.error('Failed to delete image. Try again.');
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
    border: 1px solid #00000040 !important;
    height: 40px;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
.form-control:focus {
    outline: none;
    box-shadow: none;
    background: #fff;
    border-color: var(--primary);
}
.col-form-label { color: #000; }
</style>
@endsection
