@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@push('style')
<style>
    .dash-avatar a img {
        width: 175px;
        border-radius: 50%;
        border: 3px solid #fff;
        height: 175px
    }

    .setting-form {
        display: flex;
        column-gap: 15px
    }

    .setting-form .btn {
        padding: .25rem .5rem;
        border: 0;
        margin: 0;
        width: 40px;
        height: 35px
    }
</style>
@endpush

<section class="setting-part">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Add New NGO Team Members</h3>
                    </div>
                    <form action="{{ route('ngo.addMember') }}" enctype="multipart/form-data" method="post" role="form" id="add_member">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <input type="hidden" name="ngo_id" id="ngo_id" value="{{ $ngoInfo->id }}">
                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Member's Name :<sup class="text-danger">*</sup></label>
                                        <input class="form-control" type="text" required name="name" id="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                    
                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Designation :<sup class="text-danger">*</sup></label>
                                        <input class="form-control" type="text" required name="designation" id="designation"
                                            value="{{ old('designation') }}">
                                    </div>
                                </div>
                    
                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Image :</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>
                    
                                <div class="submit-section">
                                    <button id="submit_button" class="btn btn-primary submit-btn">Submit</button>
                                    <br>
                                    <div id="loader" style="display: none;" class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    
<hr>
                    <div class="members-list">
                        <h4>NGO Members</h4>
                        <div class="table-responsive">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ngoMembers as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->designation }}</td>
                                        <td>
                                            @if($member->image)
                                            <img src="{{ asset('storage/' . $member->image) }}" alt="Member Image"
                                                width="75">
                                            @endif
                                        </td>
                                        <td class="setting-form">
                                            <a href="{{ route('ngo.editMember', $member->id) }}"
                                                class="btn btn-warning"><svg fill="#ffffff" width="20px" height="20px"
                                                    viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M 25 4.03125 C 24.234375 4.03125 23.484375 4.328125 22.90625 4.90625 L 13 14.78125 L 12.78125 15 L 12.71875 15.3125 L 12.03125 18.8125 L 11.71875 20.28125 L 13.1875 19.96875 L 16.6875 19.28125 L 17 19.21875 L 17.21875 19 L 27.09375 9.09375 C 28.246094 7.941406 28.246094 6.058594 27.09375 4.90625 C 26.515625 4.328125 25.765625 4.03125 25 4.03125 Z M 25 5.96875 C 25.234375 5.96875 25.464844 6.089844 25.6875 6.3125 C 26.132813 6.757813 26.132813 7.242188 25.6875 7.6875 L 16 17.375 L 14.28125 17.71875 L 14.625 16 L 24.3125 6.3125 C 24.535156 6.089844 24.765625 5.96875 25 5.96875 Z M 4 8 L 4 28 L 24 28 L 24 14.8125 L 22 16.8125 L 22 26 L 6 26 L 6 10 L 15.1875 10 L 17.1875 8 Z">
                                                    </path>
                                                </svg></a>

                                            <form action="{{ route('ngo.deleteMember', $member->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')"> <svg width="20px"
                                                        height="20px" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z"
                                                            fill="#FFFFFF"></path>
                                                        <path
                                                            d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z"
                                                            fill="#FFFFFF"></path>
                                                        <path
                                                            d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z"
                                                            fill="#FFFFFF"></path>
                                                    </svg></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#add_member').on('submit', function (e) {
            e.preventDefault();
        
            let formData = new FormData(this);
        
            $.ajax({
                url: "{{ route('ngo.addMember') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#loader').show();
                    $('#submit_button').prop('disabled', true);
                },
                success: function (response) {
                    $('#loader').hide();
                    $('#submit_button').prop('disabled', false);
                    toastr.success(response.message);
        
                    if (response.member) {
                        let newMemberHTML = `
                            <tr>
                                <td>${response.member.name}</td>
                                <td>${response.member.designation}</td>
                                <td>
                                    ${response.image_url ? `<img src="${response.image_url}" alt="Member Image" width="75">` : ''}
                                </td>
                                <td class="setting-form">
                                    <a href="/ngo/editMember/${response.member.id}" class="btn btn-warning">
                                        <svg fill="#ffffff" width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M 25 4.03125 C 24.234375 4.03125 23.484375 4.328125 22.90625 4.90625 L 13 14.78125 L 12.78125 15 L 12.71875 15.3125 L 12.03125 18.8125 L 11.71875 20.28125 L 13.1875 19.96875 L 16.6875 19.28125 L 17 19.21875 L 17.21875 19 L 27.09375 9.09375 C 28.246094 7.941406 28.246094 6.058594 27.09375 4.90625 C 26.515625 4.328125 25.765625 4.03125 25 4.03125 Z M 25 5.96875 C 25.234375 5.96875 25.464844 6.089844 25.6875 6.3125 C 26.132813 6.757813 26.132813 7.242188 25.6875 7.6875 L 16 17.375 L 14.28125 17.71875 L 14.625 16 L 24.3125 6.3125 C 24.535156 6.089844 24.765625 5.96875 25 5.96875 Z M 4 8 L 4 28 L 24 28 L 24 14.8125 L 22 16.8125 L 22 26 L 6 26 L 6 10 L 15.1875 10 L 17.1875 8 Z"></path>
                                        </svg>
                                    </a>
                                    <form action="/ngo/deleteMember/${response.member.id}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#FFFFFF"></path>
                                                <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z" fill="#FFFFFF"></path>
                                                <path d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z" fill="#FFFFFF"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;
        
                        $('.members-list tbody').append(newMemberHTML);
                        $('#add_member')[0].reset();
                    }
                },
                error: function (xhr) {
                    $('#loader').hide();
                    $('#submit_button').prop('disabled', false);
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
        
                    if (xhr.responseJSON.errors) {
                        for (const [key, value] of Object.entries(xhr.responseJSON.errors)) {
                            toastr.error(value[0]);
                        }
                    }
                },
            });
        });
        
        
    });

</script>
@endpush

@endsection