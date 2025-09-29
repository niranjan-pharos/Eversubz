<p><strong>Name:</strong> {{ $candidate->name }}</p>
<p><strong>Email:</strong> {{ $candidate->email }}</p>
@if(isset($candidate->cover_letter))
    <p><strong>Cover Letter:</strong> {{ $candidate->cover_letter }}</p>
@endif
@if(isset($candidate->resume))
    <a href="{{ asset('storage/' . $candidate->resume) }}" class="btn btn-success btn-sm" download>Download Resume</a>
@endif
