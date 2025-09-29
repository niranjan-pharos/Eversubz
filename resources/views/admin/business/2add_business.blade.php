@extends('admin.template.master')
@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
  .ui-datepicker-calendar {
    display: none !important;
  }

  .ui-datepicker-month {
    display: none !important;
  }

  .ui-priority-secondary {
    display: none !important;
  }
</style>

<div class="search-lists">
  <div class="search-lists">
    <div class="tab-content">
      <div id="messages"></div>
      <div class="row">
        <div class="col float-right ml-auto">
          <a href="{{ route('businessByAdmin')}}" class="btn btn-primary" style="float:right"><i
              class="fa fa-mail-reply"></i> Business List </a>
        </div>
        <div class="col-md-12">
          <div class="card mb-0">
            <div class="card-body">
              <form action="{{ route('business.store') }}" enctype="multipart/form-data" method="post" role="form"
                id="add_business">
                @csrf
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="col-form-label">Business Name:<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" required name="business_name" value="">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Type</label>
                        <input class="form-control" type="text" name="business_type" value="">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Establishment year</label>
                        <input class="form-control yearpicker" type="text" name="establishment" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">ABN</label>
                        <input class="form-control" type="text" name="abn" value="">
                      </div>
                    </div>
                    {{-- <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">ACN</label>
                        <input class="form-control" type="text" name="acn" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">GST</label>
                        <input class="form-control" type="text" name="gst" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">VAT</label>
                        <input class="form-control" type="text" name="vat" value="">
                      </div>
                    </div> --}}
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">Contact email</label>
                        <input class="form-control" type="text" name="contact_email" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">Contact phone</label>
                        <input class="form-control" type="text" name="contact_phone" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">Website URL</label>
                        <input class="form-control" type="text" name="website_url" value="">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">Facebook URL</label>
                        <input class="form-control" type="text" name="facebook_url" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">Twitter URL</label>
                        <input class="form-control" type="text" name="twitter_url" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">Instagram URL</label>
                        <input class="form-control" type="text" name="instagram_url" value="">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-form-label">Linkedin URL</label>
                        <input class="form-control" type="text" name="linkedin_url" value="">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="col-form-label">Business address</label>
                        <textarea rows="6" cols="5" class="form-control" placeholder="Address" name="business_address"
                          style="height:100px;"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="col-form-label">Description</label>
                        <textarea rows="6" cols="5" class="form-control" placeholder="Description"
                          name="business_description" style="height:100px;"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Logo/Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                      </div>
                    </div>
                    <div id="loader" style="display: none;" class="spinner-border text-primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                </div>

                <div class="submit-section">
                  <button class="btn btn-primary submit-btn">Submit</button>
                  <br>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
    $('.yearpicker').datepicker({
      dateFormat: 'yy',
      changeYear: true,
      showButtonPanel: true,
      yearRange: '1900:' + new Date().getFullYear(),
      onClose: function (dateText, inst) {
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(year, 0, 1));
      },
      beforeShow: function (input, inst) {
        if ((datestr = $(this).val()).length > 0) {
          year = datestr.substring(datestr.length - 4, datestr.length);
          $(this).datepicker('option', 'defaultDate', new Date(year, 0, 1));
          $(this).datepicker('setDate', new Date(year, 0, 1));
        }
      }
    });


    $('.ajax_category').each(function () {
      $(this).select2({
        dropdownParent: $(this).parent(),
        placeholder: '--- Search Category ---',
        allowClear: true,
        ajax: {
          url: "{{route('ajaxSearchCategory')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              "_token": "{{ csrf_token() }}",
              searchTerm: params.term,
            };
          },
          processResults: function (data) {
            console.log(data);
            return {
              results: data,
            };
          },
          cache: true
        }
      });
    });

    $('.ajax_category').on('select2:select', function (e) {
      var data = e.params.data;
      $('.ajax_subcategory').each(function () {
        $(this).select2({
          dropdownParent: $(this).parent(),
          placeholder: '--- Search Subcategory ---',
          allowClear: true,
          ajax: {
            url: "{{route('getSubcategory')}}",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                "_token": "{{ csrf_token() }}",
                searchTerm: params.term,
                cat_id: data.id
              };
            },
            processResults: function (data) {
              console.log(data);
              return {
                results: data,
              };
            },
            cache: true
          }
        });
      });
    });

    $('#add_business').submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      $('#loader').show(); // Show the loader

      $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          $('#add_business')[0].reset();
          $('#image').val('');
          toastr.success(response.success);;
          $('#loader').hide();
        },
        error: function (xhr) {
          $('#loader').hide(); // Hide the loader
          if (xhr.status === 422) { // Validation error
            let errors = xhr.responseJSON.errors;
            Object.keys(errors).forEach(function (key) {
              errors[key].forEach(function (message) {
                console.log(key); console.log(message);
                toastr.error(message); // Display each validation error
              });
            });
          } else {
            // For non-validation errors
            toastr.error('An error occurred. Please try again.');
          }
        }
      });
    });




  }); //end document.ready

</script>

@endsection