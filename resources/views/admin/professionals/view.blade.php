@extends('admin.template.master')

@section('content')
<div class="container professional-details">
    <h3 class="text-center mb-4">Professional Details</h3>
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <strong>Name: {{ $user->name }}</strong> | <strong>Email:</strong> {{ $user->email }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            @if($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                     class="img-fluid rounded-circle mb-2" style="max-width: 120px;">
                            @else
                                <img src="{{ asset('images/default-user.png') }}" alt="No Image"
                                     class="img-fluid rounded-circle mb-2" style="max-width: 120px;">
                            @endif
                            <h5>{{ $user->name }}</h5>
                            <p>{{ $user->candidateProfile->profession ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Basic Details -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5><i class="fas fa-user"></i> Basic Information</h5>
                            <hr>
                            <p><strong>Username:</strong> {{ $user->username }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone ?? '-' }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                            <p><strong>Gender:</strong> {{ $user->gender ?? '-' }}</p>
                            <p><strong>Permanent Address:</strong> {{ $user->address ?? '-' }}</p>
                            <p><strong>City:</strong> {{ $user->permanent_city ?? '-' }}</p>
                            <p><strong>State:</strong> {{ $user->permanent_state ?? '-' }}</p>
                            <p><strong>Country:</strong> {{ $user->permanent_country ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <!-- Profile Details -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5><i class="fas fa-id-card"></i> Profile</h5>
                            <hr>
                            <p><strong>Profession:</strong> {{ $user->candidateProfile->profession ?? '-' }}</p>
                            <p><strong>Salary:</strong> {{ $user->candidateProfile->salary ?? '-' }}</p>
                            <p><strong>Date of Birth:</strong> {{ $user->candidateProfile->dob ?? '-' }}</p>
                            <p><strong>Mailing Address:</strong> {{ $user->candidateProfile->address ?? '-' }}</p>
                            <p><strong>City:</strong> {{ $user->candidateProfile->city ?? '-' }}</p>
                            <p><strong>State:</strong> {{ $user->candidateProfile->state ?? '-' }}</p>
                            <p><strong>Country:</strong> {{ $user->candidateProfile->country ?? '-' }}</p>
                            <p><strong>LinkedIn:</strong> 
                                @if($user->candidateProfile->linkedin_url)
                                    <a href="{{ $user->candidateProfile->linkedin_url }}" target="_blank">{{ $user->candidateProfile->linkedin_url }}</a>
                                @else
                                    -
                                @endif
                            </p>
                            <p><strong>GitHub:</strong> 
                                @if($user->candidateProfile->github_url)
                                    <a href="{{ $user->candidateProfile->github_url }}" target="_blank">{{ $user->candidateProfile->github_url }}</a>
                                @else
                                    -
                                @endif
                            </p>
                            <p><strong>Website:</strong>
                                @if($user->candidateProfile->website_url)
                                    <a href="{{ $user->candidateProfile->website_url }}" target="_blank">{{ $user->candidateProfile->website_url }}</a>
                                @else
                                    -
                                @endif
                            </p>
                            @if($user->candidateProfile->resume)
                                <p><strong>Resume:</strong> 
                                    <a href="{{ asset('storage/'.$user->candidateProfile->resume) }}" target="_blank">View Resume</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- About -->
            @if($user->candidateProfile->about)
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-info-circle"></i> Bio / About</h5>
                            <hr>
                            <div>{!! $user->candidateProfile->about !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Categories, Skills, Languages -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-layer-group"></i> Categories</h5>
                            <ul>
                                @forelse($user->candidateProfile->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @empty
                                    <li>-</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-cogs"></i> Skills</h5>
                            <ul>
                                @forelse($user->candidateProfile->skills as $skill)
                                    <li>{{ $skill->skill_name }} ({{ ucfirst($skill->pivot->proficiency_level) }})</li>
                                @empty
                                    <li>-</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-language"></i> Languages</h5>
                            <ul>
                                @forelse($user->candidateProfile->candidateLanguages as $lang)
                                    <li>{{ $lang->language_name }} ({{ $lang->proficiency_level }})</li>
                                @empty
                                    <li>-</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-graduation-cap"></i> Education</h5>
                            <ul>
                                @forelse($user->candidateProfile->educations as $edu)
                                    <li>
                                        <strong>{{ $edu->degree }}</strong> at {{ $edu->institution }} 
                                        ({{ $edu->from_date }} - {{ $edu->to_date ?? 'Ongoing' }})<br>
                                        <small>{{ $edu->field_of_study }}</small>
                                    </li>
                                @empty
                                    <li>-</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experience -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-briefcase"></i> Experience</h5>
                            <ul>
                                @forelse($user->experiences  as $exp)
                                    <li>
                                        <strong>{{ $exp->job_title }}</strong> at {{ $exp->company }} ({{ $exp->from_date }} - {{ $exp->to_date ?? 'Ongoing' }})<br>
                                        <span>{{ $exp->job_type }}</span> | <span>{{ $exp->location }}</span><br>
                                        <span>{{ $exp->description }}</span>
                                        @if($exp->portfolio_url)
                                            <br>
                                            <a href="{{ $exp->portfolio_url }}" target="_blank">Portfolio</a>
                                        @endif
                                    </li>
                                @empty
                                    <li>-</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>



<style>
.order-details {
    background: #f8f9fa;
    border-radius: 10px;
    font-family: Arial, sans-serif;
}

.card-header {

    background-color: #007bff !important;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    padding: 15px;
}

.card-body {
    padding: 20px;
}

.card p {
    display: flex;
    color: #000;
    justify-content: space-between;
    margin-bottom: 5px;
    text-align: end;
}

.card h5 {
    color: #000;
    text-transform: uppercase;
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 20px;
}

h3,
h5 {
    font-weight: bold;
}

h5 i {
    margin-right: 10px;
    color: #007bff;
}

.table {
    border-collapse: collapse;
    background: white;
}

.card-body .card {
    height: 250px;
}

.order-details .card {
    border: none;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
    padding: 12px 15px;
    vertical-align: middle;
    text-align: left;
    border: 1px solid #ddd;
}

.table th {
    font-weight: bold;
    background-color: #007bff;
}

.table tbody tr:hover {
    background: #f1f1f1;
}



.text-success {
    color: #28a745 !important;
}

img.img-fluid {
    max-height: 80px;
    object-fit: cover;
    border: 1px solid #ddd;
    padding: 5px;
    background: #f9f9f9;
}
</style>
@endsection