@extends('admin.template.master')

@section('content')

<div class="search-lists">
    <div class="tab-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Job Details - {{ $job->title }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="user-title">Job Title:</p>
                                <p class="user-title1">{{ $job->title }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="user-title">Slug:</p>
                                <p class="user-title1">{{ $job->slug }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="user-title">Category:</p>
                                <p class="user-title1">{{ $job->category->name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="user-title">Posted By:</p>
                                <p class="user-title1">{{ $job->user->name ?? 'N/A' }}</p>
                            </div>

                            <div class="col-md-12">
                                <p class="user-title">Job Description:</p>
                                <p class="user-title1">{!! $job->description !!}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Skills</h4>
                            </div>
                            @foreach($job->skills as $skill)
                            <div class="col-md-2">
                                <p class="user-title">{{ $skill->skill_name }}</p>
                            </div>
                            @endforeach
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Tags</h4>
                            </div>
                            @foreach($job->tags as $tag)
                            <div class="col-md-2">
                                <p class="user-title">{{ $tag->tag_name }}</p>
                            </div>
                            @endforeach
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Applications</h4>
                            </div>
                            @foreach($job->applications as $application)
                            <div class="col-md-4">
                                <p class="user-title">Applicant: {{ $application->name }}</p>
                                <p class="user-title1">Status: {{ $application->email }}</p>

                                @if ($application->resume)
                                <p class="user-title1">
                                    <a href="{{ route('admin.downloadResume', ['file' => basename($application->resume)]) }}"
                                        class="btn btn-primary">Download Resume</a>
                                </p>
                                @else
                                <p class="user-title1">No resume uploaded</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.user-title {
    font-size: 18px;
    font-weight: 800;
}

.user-title1 {
    font-size: 16px;
}

h4 {
    font-size: 22px;
    margin-bottom: 15px;
}
</style>

@endsection