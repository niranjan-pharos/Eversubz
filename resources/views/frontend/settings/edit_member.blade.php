@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
.dash-avatar a img{width:175px;border-radius:50%;border:3px solid #fff;height:175px}.setting-form .btn{padding:.25rem .5rem;border:0;margin:0}
</style>

<section class="setting-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Edit Member</h3>
                    </div>
                    <form action="{{ route('ngo.updateMember', $member->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="col-form-label">Member's Name :<sup class="text-danger">*</sup></label>
                            <input class="form-control" type="text" required name="name" value="{{ old('name', $member->name) }}">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Designation :<sup class="text-danger">*</sup></label>
                            <input class="form-control" type="text" required name="designation" value="{{ old('designation', $member->designation) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Image :</label>
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="Member Image" width="100">
                            @endif
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>



@endsection