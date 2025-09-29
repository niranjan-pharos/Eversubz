@extends('admin.template.master')

@section('content')
<div class="search-lists">
    <div class="tab-content">
     
        <div id="messages"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <form action="{{ route('admin.updateProfile') }}" method="post" role="form" id="add_department" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                            <input class="form-control" required type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" required type="email" name="email" value="{{ Auth::guard('admin')->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                            <input class="form-control" required type="number" name="phone" value="{{ Auth::guard('admin')->user()->phone }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Profile Image </label>
                                            <input class="form-control" type="file" name="image">
                                        </div>
                                    </div>
                                </div>
        
                                <div class="text-center modal-footer-div">
                                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection