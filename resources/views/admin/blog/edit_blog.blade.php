@extends('admin.template.master')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@section('content')
<div class="search-lists">
    <div class="tab-content">
        <div id="messages"></div>
        <div class="row">
            <div class="col float-right ml-auto">
                <a href="{{ asset ('blogs') }}" class="btn btn-primary mb-3" style="float:right"><i class="fa fa-mail-reply"></i> Blogs List
                </a>
            </div>
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <form action="{{ route('adminBlogUpdate', $blog->id) }}" enctype="multipart/form-data"
                            method="post" role="form" id="edit_blog">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Title <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" required name="title"
                                                value="{{ $blog->title }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Date <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" required name="date"
                                                value="{{ $blog->date->format('Y-m-d\TH:i') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Meta Title <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="meta_title"
                                                value="{{ $blog->meta_title }}" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Meta Description <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="meta_description"
                                                value="{{ $blog->meta_description }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Slug <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="slug"
                                                value="{{ $blog->slug }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Alt Text <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="alt_text" id="alt_text"
                                                value="{{ $blog->alt_text }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="blog_image">Blog Image</label>
                                        <input type="file" class="form-control-file" id="blog_image" name="blog_image">
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Event Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="blogDescription" placeholder="Write Blog"
                                                name="blog_description"
                                                required>{{ $blog->blog_description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Update</button>
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

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$(document).ready(function() {
    $('#blogDescription').summernote({
        height: 300, 
        minHeight: null,
        maxHeight: null, 
        focus: true 
    });


    document.getElementById('add_blog').addEventListener('submit', function(event) {
        var imageInput = document.getElementById('blog_image');
        var altTextInput = document.getElementById('alt_text');

        if (imageInput.files.length > 0) {
            var imageFile = imageInput.files[0];
            var newFileName = altTextInput.value + '.' + imageFile.name.split('.').pop();
            var newFile = new File([imageFile], newFileName, {
                type: imageFile.type
            });
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(newFile);
            imageInput.files = dataTransfer.files;
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