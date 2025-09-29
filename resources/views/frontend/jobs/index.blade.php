@extends('frontend.template.master')
@section('title',  "My Jobs")


@section('content')
@include('frontend.template.usermenu')
@push('style')
<style>
.btn{padding:.375rem .75rem}.product-card{margin:0}.product-btn a,.product-btn button{margin-left:6px;padding-left:6px}.events-links{text-decoration:underline;font-size:14px}.events-links:hover{font-size:15px}body{background:#fff}.flat-badge{position:absolute;top:0;right:0}body{background:#F9FAFB}.product-widget,.product-card{background:#fff}.product-category .breadcrumb-item::before{content:none}.product-category{height:auto;margin-bottom:0;padding:10px 0 8px;border-bottom:1px solid var(--border);flex-wrap:nowrap;column-gap:10px;justify-content:space-between}.product-price{font-size:14px!important}.filter-button1{display:flex;column-gap:5px}.product-content{padding:.875rem}.product-img img{width:100%;height:200px;object-fit:contain}.product-title{height:auto;font-size:.875rem}.product-card-column{padding:0 5px}.product-card{margin:0 0 10px}@media only screen and (max-width:737px){.product-img img{width:100%;height:auto}.product-card{width:auto !important;  
        margin: 0 auto 10px !important;
        height: auto;}.myads-part{padding:50px 0 80px}    .myads-part {
        margin-bottom: 75px;
    }.product-card-column {
    padding: 0 5px;
    margin-bottom: 0;
    padding: 0 5px;
}}
</style>
@endpush
<section class="inner-section category-part myads-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-filter">
                    <div class="filter-show">
                        <label class="filter-label">Show :</label>
                        <select class="custom-select filter-select" id="resultsPerPage">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="filter-short">
                        <label class="filter-label">Short by :</label>
                        <select class="custom-select filter-select" id="postFilter">
                            <option selected="" data-filter="all">All Job</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($jobs as $job)
                <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 product-card-column">
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-img recommend-product-img">
                                <img loading="eager" src="{{ asset('storage/'.$job->image ) }}" alt="{{ $job->title }}">
                            </div>
                        </div>
                        <div class="product-content">
                            <ol class="breadcrumb product-category">
                                <li class="breadcrumb-item product-price">
                                    @if(empty($job->salary) || $job->salary == 0 || $job->salary == '0.00')
                                        No salary Defined
                                    @else
                                        ${{ $job->salary }}
                                    @endif
                                </li>
                            </ol>
                            <h5 class="product-title">
                                <a href="{{ route('job.details', ['slug' => $job->slug]) }}">
                                    {{ strlen($job->title) > 30 ? substr($job->title, 0, 30) . '...' : $job->title }}
                                </a>
                            </h5>
                            <div class="product-meta">
                                <span><i class="fas fa-map-marker-alt"></i> {{ $job->city }}, {{ $job->state }}, {{ $job->country }}</span>
                            </div>
                            <div class="product-info">
                                <div class="product-btn">
                                    <!-- View Candidates Icon -->
                                    <a href="{{ route('jobs.applications', ['jobId' => $job->id]) }}" class="job-action-icon" title="View Applied Candidates">
                                        <i class="fas fa-users"></i>
                                    </a>
                                
                                    <!-- Edit Icon -->
                                    <a href="{{ route('jobs.edit', ['slug' => $job->slug]) }}" class="job-action-icon" title="Edit Job">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                
                                    <!-- Delete Button -->
                                    <a href="javascript:void(0);" class="job-action-icon delete-job-button" data-url="{{ route('jobs.destroy', $job->slug) }}" title="Delete Job">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        
        <div class="row">
            <div class="col-lg-12">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    
    $(document).on('click', '.delete-job-button', function () {
        const url = $(this).data('url');
        if (confirm('Are you sure you want to delete this job?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    alert('Job deleted successfully.');
                    location.reload();
                },
                error: function () {
                    alert('Failed to delete the job.');
                }
            });
        }
    });



</script>
@endsection