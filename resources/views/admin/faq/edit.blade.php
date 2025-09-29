@extends('admin.template.master')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Edit FAQ</h3>

            <!-- Display success message if exists -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Edit FAQ Form -->
            <form action="{{ route('faq.update', $faq->slug) }}" method="POST">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="question">FAQ Question</label>
                    <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug (Auto-generated)</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $faq->slug) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $faq->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="subcategory_id">Subcategory</label>
                    <select name="subcategory_id" class="form-control" id="subcategory_id">
                        <option value="">Select Subcategory</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ $faq->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="answer">Answer</label>
                    <textarea name="answer" class="form-control summernote">{{ old('answer', $faq->answer) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update FAQ</button>
            </form>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>

$(document).ready(function() {
        var maxChars = 5000;
        var charCount = $('#charCount');
        var adDescription = $('#adDescription');

        adDescription.summernote({
            height: 150,
            callbacks: {
                onKeyup: function(e) {
                    updateCharCount();
                },
                onChange: function(contents, $editable) {
                    updateCharCount();
                }
            }
        });

     
    });
    $(document).ready(function() {
        
      
        $('input[name="question"]').on('keyup', function() {
            var question = $(this).val();
            var slug = question.replace(/\s+/g, '-').toLowerCase();
            $('input[name="slug"]').val(slug);
        });
    });
</script>
@endsection
