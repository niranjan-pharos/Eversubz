@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
 .dash-avatar a img{width:175px;border-radius:50%;border:3px solid #fff;height:175px}.setting-form .btn{padding:.25rem .5rem;border:0;margin:0}
</style>
<section class="setting-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Edit NGO Main Info</h3>
                    </div>

                    <form id="ngoInfoForm" class="setting-form">
                        @csrf
                        @method('patch')
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group"><label class="form-label">NGO Name <span
                                            class="danger">*</span></label>
                                    <input type="text" required class="form-control" placeholder="NGO Name"
                                        id="ngo_name" name="ngo_name" value="{{ $ngoInfo?->ngo_name }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $ngoInfo?->cat_id == $category->id ?
                                            'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="logo_path">Logo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo_path" name="logo_path">
                                        <label class="custom-file-label" for="logo_path">Choose file</label>
                                        @if(!empty($ngoInfo?->logo_path))
                                            <img src="{{ asset('storage/'.$ngoInfo->logo_path) }}" style="width:100px;">
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-form-label">Other Images :</label>
                                    <input type="file" class="form-control" id="other_images" name="other_images[]"
                                        multiple>
                                    <input type="hidden" name="images_to_remove" id="images_to_remove">
                                    @if($ngoInfo && $ngoInfo->images)
                                        <div class="row mt-3">
                                            @foreach($ngoInfo->images as $image)
                                                <div class="col-sm-3">
                                                    <div class="image-container">
                                                        <img src="{{ asset('storage/'.$image->image_path) }}" class="img-fluid"
                                                            style="max-width: 100%; height: auto;" alt="Other Image">
                                                        <button type="button" class="btn btn-danger btn-remove-image"
                                                                data-image-id="{{ $image->id }}">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z"
                                                                    fill="#FFFFFF"></path>
                                                                <path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z"
                                                                    fill="#FFFFFF"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No images available for this NGO.</p>
                                    @endif

                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Description :</label>
                                    <textarea class="form-control" id="adDescription"
                                        placeholder="Describe your message"
                                        name="ngo_description">{{ $ngoInfo?->ngo_description }}</textarea>
                                </div>
                            </div>





                            <div class="col-lg-12"><button class="btn btn-inline"><i
                                        class="fas fa-user-check"></i><span>update
                                        NGO Info</span></button></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.btn-remove-image').forEach(function (button) {
        button.addEventListener('click', function () {
          const imageId = this.dataset.imageId;
          const imagesToRemove = document.getElementById('images_to_remove');
          imagesToRemove.value += (imagesToRemove.value ? ',' : '') + imageId;
          this.closest('.image-container').remove();
        });
      });
    });
  
    $(document).ready(function () {
      $('.custom-file-input').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
      });
  
      $('.remove-image-btn').on('click', function () {
        var imageId = $(this).data('image-id');
        $(this).closest('.form-group').append(
          '<input type="hidden" name="remove_images[]" value="' + imageId + '">'
        );
        $(this).closest('.col-sm-3').remove();
      });
  
      $('#adDescription').summernote({
        height: 150,
        placeholder: 'Describe your message',
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
  
      $('#ngoInfoForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_method', 'PATCH');
  
        $.ajax({
          url: "{{ route('updateNgoMainInfo') }}",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            toastr.success(response.message);
            if (response.ngo_name) {
              $("#ngo_name").val(response.ngo_name);
            }
            if (response.category) {
              $('#category').val(response.category.id);
            }
            if (response.logo_path) {
              $("#logo_image").empty();
              $("#logo_image").html(
                '<img src="{{ asset('storage') }}/' + response.logo_path + '" style="width:100px; height:100px;" >'
              );
            }
          },
          error: function (xhr) {
            toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
            if (xhr.responseJSON.errors) {
              $.each(xhr.responseJSON.errors, function (key, error) {
                toastr.error(error[0]);
              });
            }
          }
        });
      });
    });
  </script>
  
@endsection