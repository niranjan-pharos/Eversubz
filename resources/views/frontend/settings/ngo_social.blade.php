@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')
@push('style')

<style>
  .dash-avatar a img{width:175px;border-radius:50%;border:3px solid #fff;height:175px}
</style>
@endpush
<section class="setting-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="account-card alert fade show">
               <div class="account-title">
                  <h3>Edit NGO Address</h3>
               </div>

               <form id="ngoSocialForm" class="setting-form">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Website</label>
                            <input type="text" class="form-control" placeholder="Website" id="website_url" name="website_url" value="{{ $ngoInfo->website_url }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Facebook</label>
                            <input type="text" class="form-control" placeholder="Facebook" id="facebook_url" name="facebook_url" value="{{ $ngoInfo->facebook_url }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Twitter(X)</label>
                            <input type="text" class="form-control" placeholder="Twitter(X)" id="twitter_url" name="twitter_url" value="{{ $ngoInfo->twitter_url }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Instagram URL</label>
                            <input type="text" class="form-control" placeholder="Instagram" id="instagram_url" name="instagram_url" value="{{ $ngoInfo->instagram_url }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Linkedin URL</label>
                            <input type="text" class="form-control" placeholder="Linkedin URL" id="linkedin_url" name="linkedin_url" value="{{ $ngoInfo->linkedin_url }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-inline"><i class="fas fa-user-check"></i><span>Update NGO Info</span></button>
                    </div>
                </div>
            </form>
            
            </div>
         </div>
      </div>
   </div>
</section>

@push('scripts')

<script>
    $(document).ready(function() {
        $('#ngoSocialForm input').on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        $('#ngoSocialForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('_method', 'PATCH');

            $.ajax({
                url: "{{ route('ngo.updateSocialInfo') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);

                    if (response.data) {
                        $("#website_url").val(response.data.website_url);
                        $("#facebook_url").val(response.data.facebook_url);
                        $("#twitter_url").val(response.data.twitter_url);
                        $("#instagram_url").val(response.data.instagram_url);
                        $("#linkedin_url").val(response.data.linkedin_url);
                    }
                },
                error: function(xhr) {
                    var message = xhr.responseJSON.message || 'An error occurred. Please try again.';
                    toastr.error(message);

                    if (xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, error) {
                            toastr.error(error[0]);
                            $(`#${key}`).addClass('is-invalid');
                        });
                    }
                }
            });
        });
    });

</script>


@endpush
@endsection