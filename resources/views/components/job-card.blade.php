
<div class="job-instructor-layout border">
    <div class="left-tags-capt">
        @if ($job->is_featured)
            <span class="featured-text">Featured</span>
        @endif
    </div>
    <div class="brows-job-type" style="position: relative;z-index: 1;">
            <span class="badge badge-primary">{{ $job->job_mode }}</span>
    </div>
    <div class="job-instructor-thumb">
        <a href="{{ route('job.details', $job->slug) }}">
            <img src="{{ asset('storage/'.$job->image) }}" class="img-fluid" alt="{{ $job->title }}">
        </a>
    </div>
    <div class="job-instructor-content">
        <div class="jbs-job-employer-wrap">
            <span>{{ $job->company_name ?? 'Unknown Company' }}</span>
        </div>
        <h4 class="instructor-title">
            <a href="{{ route('job.details', $job->slug) }}">{{ $job->title }}</a>
        </h4>
        <div class="text-center text-sm-muted">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8 0C5.239 0 3 2.239 3 5c0 4.25 5 10.25 5 10.25S13 9.25 13 5c0-2.761-2.239-5-5-5zm0 14.562S4 9.104 4 5c0-2.209 1.791-4 4-4s4 1.791 4 4c0 4.104-4 9.562-4 9.562zM8 2C6.346 2 5 3.346 5 5s1.346 3 3 3 3-1.346 3-3S9.654 2 8 2zm0 5C7.346 7 7 6.654 7 6s.346-1 1-1 1 .346 1 1-.346 1-1 1z" />
                </svg>
                {{ ($job->city && $job->state && $job->country) 
    ? $job->city . ', ' . $job->state . ', ' . $job->country 
    : 'N/A' }}

            </span>
        </div>
        <div class="jbs-grid-job-edrs-group center mt-2">
            @foreach ($job->skills as $skill)
                <span>{{ $skill->skill_name }}</span>
            @endforeach
        </div>
    </div>
    <div class="jbs-grid-job-apply-btns px-3 py-3">
        <div class="jbs-btn-groups">
            <div class="jbs-sng-blux">
                <div class="jbs-grid-package-title smalls">
                    <h5>{{ $job->salary ?? 'Negotiable' }}</h5>
                </div>
            </div>
            <div class="jbs-sng-blux">
                <a href="{{ route('job.details', $job->slug) }}" class="btn btn-md btn-light-primary">Quick Apply</a>
            </div>
        </div>
    </div>
</div>
