@extends('admin.template.master')

@section('content')

 <!-- Back Button -->
            <div class="text-center" style="    justify-self: right;">
                <a href="{{ route('adminDonationPackages') }}" class="btn btn-outline-primary btn-lg px-4 rounded-pill shadow-sm">
                    <i class="bi bi-arrow-left-circle me-2"></i> Back to Packages
                </a>
            </div>

<div class="container-fluid py-2">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <!-- Header -->
        <div class="card-header bg-gradient text-white py-3"
             style="background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%);">
            <h3 class="mb-0 fw-bold">
                <i class="bi bi-box-seam me-2"></i> Package Details
            </h3>
        </div>

        <!-- Body -->
        <div class="card-body bg-light p-5">
            <div class="row g-4">

                <!-- Package Name -->
                <div class="col-md-12">
                    <label class="fw-semibold text-secondary text-uppercase small">Package Name</label>
                    <h4 class="text-dark fw-bold border-start border-4 border-primary ps-3">
                        {{ $donationPackage->name }}
                    </h4>
                </div>

                <!-- Price -->
                <div class="col-md-6">
                    <div class="p-4 bg-white border rounded-4 shadow-sm h-100">
                        <p class="fw-semibold text-secondary mb-1">Event Price</p>
                        <h5 class="text-success fw-bold mb-0">
                            ${{ number_format($donationPackage->price, 2) }}
                        </h5>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="col-md-6">
                    <div class="p-4 bg-white border rounded-4 shadow-sm h-100">
                        <p class="fw-semibold text-secondary mb-1">Quantity</p>
                        <h5 class="text-dark fw-bold mb-0">{{ $donationPackage->quantity }}</h5>
                    </div>
                </div>

                <!-- Package Includes -->
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-primary bg-opacity-75 text-white fw-semibold">
                            <i class="bi bi-list-check me-1"></i> Package Includes
                        </div>
                        <div class="card-body bg-white">
                            <div class="tailwind-reset">
                                {!! $donationPackage->in_packages !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-primary bg-opacity-75 text-white fw-semibold">
                            <i class="bi bi-card-text me-1"></i> Description
                        </div>
                        <div class="card-body bg-white">
                            <div class="text-muted lh-base">{!! $donationPackage->description !!}</div>
                        </div>
                    </div>
                </div>

                <!-- Main Image -->
                <div class="col-md-12">
                    <label class="fw-semibold text-secondary d-block mb-2">
                        <i class="bi bi-image me-1"></i> Main Image
                    </label>
                    @if($donationPackage->image)
                        <img src="{{ asset('storage/' . $donationPackage->image) }}"
                             alt="{{ $donationPackage->name }}"
                             class="img-thumbnail rounded-4 shadow-sm hover-zoom"
                             style="max-width: 200px;">
                    @else
                        <p class="text-muted fst-italic">No image available</p>
                    @endif
                </div>

                <!-- Gallery -->
                @if($donationPackage->gallery->count())
                    <div class="col-md-12">
                        <label class="fw-semibold text-secondary d-block mb-3">
                            <i class="bi bi-images me-1"></i> Gallery Images
                        </label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($donationPackage->gallery as $g)
                                <img src="{{ asset('storage/'.$g->image) }}"
                                     alt="Gallery Image"
                                     class="rounded-4 shadow-sm hover-zoom"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Tailwind reset for embedded content */
.tailwind-reset * {
    all: revert;
    font-family: "Segoe UI", Roboto, sans-serif !important;
    color: #333 !important;
    font-size: 15px;
}
.tailwind-reset table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.tailwind-reset th, .tailwind-reset td {
    padding: 10px 12px;
    border-bottom: 1px solid #dee2e6;
}
.tailwind-reset th {
    background-color: #f8f9fa;
    font-weight: 600;
}

/* Image hover zoom effect */
.hover-zoom {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-zoom:hover {
    transform: scale(1.07);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Card header gradient text */
.card-header {
    border-top-left-radius: 0.75rem;
    border-top-right-radius: 0.75rem;
}

.card-header {
     padding: 20px 0px 20px 0px !important;
    font-size: 21px !important;
    font-weight: 600 !important;
     justify-content: left !important; 
     margin-bottom: 0px !important;
}

/* Background fade animation on load */
.card-body {
    animation: fadeIn 0.4s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

@endsection
