@extends('frontend.template.master')
@section('title', "Job Applications")

@section('content')
@include('frontend.template.usermenu')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
body {
    background: #fff !important;
}
</style>

<section class="inner-section category-part myads-part">
    <div class="container">
        <h4>Job Applications</h4>
<br>
        <h5>Registered Candidates</h5>
        <br>
        <div class="table-responsive">
            <table id="registeredCandidatesTable" class="display table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Cover Letter</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registeredCandidates as $key => $candidate)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($candidate->cover_letter, 50) }}</td>
                        <td>
                            <button class="btn btn-info btn-sm view-candidate" data-id="{{ $candidate->id }}"
                                data-type="registered">View</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        <h4>Guest Candidates</h4>
        <br>
        <div class="table-responsive">

            <table id="guestCandidatesTable" class="display  table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Resume</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guestCandidates as $key => $candidate)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>
                            @if(isset($candidate->resume) && !empty($candidate->resume))
                            <a href="{{ asset('storage/' . $candidate->resume) }}" class="btn btn-success btn-sm"
                                download>Download Resume</a>
                            @else
                            <span>No Resume Uploaded</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="viewCandidateModal" tabindex="-1" aria-labelledby="viewCandidateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCandidateModalLabel">Candidate Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="candidateDetails">
                    Loading candidate details...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</section>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#registeredCandidatesTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        order: [
            [0, 'asc']
        ],
    });

    $('#guestCandidatesTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        order: [
            [0, 'asc']
        ],
    });
});


$(document).on('click', '.view-candidate', function() {
    let candidateId = $(this).data('id');
    let candidateType = $(this).data('type');

    $.ajax({
        url: '/candidates/details/' + candidateId + '/' + candidateType,
        type: 'GET',
        success: function(response) {
            $('#candidateDetails').html(response.html);
            $('#viewCandidateModal').modal('show');
        },
        error: function() {
            alert('Failed to load candidate details.');
        }
    });
});
</script>
@endpush
@endsection