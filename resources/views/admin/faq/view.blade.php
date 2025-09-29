@extends('admin.template.master')



@section('content')

<div class="container my-5">
    <h1 class="mb-4">{{ $faq->question }}</h1>

    <div class="mb-3">
        <strong>Category:</strong> {{ $faq->category->name ?? 'N/A' }}
    </div>

    @if($faq->subcategory)
        <div class="mb-3">
            <strong>Subcategory:</strong> {{ $faq->subcategory->name }}
        </div>
    @endif

    <div class="faq-answer">
        {!! $faq->answer !!}
    </div>

    <div class="mt-5">
        <a href="{{ route('faqList') }}" class="btn btn-secondary">Back to FAQs</a>
    </div>
</div>

@endsection

