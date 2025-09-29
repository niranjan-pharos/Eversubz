@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
  .dash-avatar a img{width:175px;border-radius:50%;border:3px solid #fff;height:175px}
</style>
<section class="setting-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="account-card alert fade show">
               <div class="account-title">
                  <h3>Edit NGO Info</h3>
               </div>

               <form id="ngoInfoForm" class="setting-form">
    @csrf
    @method('patch')
    <div class="row">


        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label">Establishment</label><input type="text" class="form-control"
                    placeholder="Establishment Date" id="establishment" name="establishment"
                    value="{{ $ngoInfo?->establishment }}">
            </div>
        </div>


        <div class="col-lg-6">
            <div class="form-group"><label class="form-label">ABN</label>
                <input type="text" class="form-control" placeholder="ABN" id="abn" name="abn"
                    value="{{ $ngoInfo?->abn }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group"><label class="form-label">Acnc</label>
                <input type="text" class="form-control" placeholder="ACNC" id="acnc" name="acnc"
                    value="{{ $ngoInfo?->acnc }}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group"><label class="form-label">GST</label>
                <input type="text" class="form-control" placeholder="GST" id="gst" name="gst"
                    value="{{ $ngoInfo?->gst }}">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group"><label class="form-label">Size</label>
                <select class="select form-control" id="size" name="size">
                    <option value="small" {{ $ngoInfo?->size =='small' ? 'selected': '' }}>Small</option>
                    <option value="medium" {{ $ngoInfo?->size =='medium' ? 'selected': '' }}>Medium</option>
                    <option value="large" {{ $ngoInfo?->size =='large' ? 'selected': '' }}>Large</option>
                </select>
            </div>
        </div>

        <div class="col-lg-12"><button class="btn btn-inline"><i class="fas fa-user-check"></i><span>update
                    NGO Info</span></button></div>
    </div>
</form>
            </div>
         </div>
      </div>
   </div>
</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function(){$('#establishment').datepicker({ format: "yyyy", viewMode: "years", minViewMode: "years", autoclose: true, endDate: new Date().getFullYear().toString() });$('#ngoInfoForm').on('submit',function(e){e.preventDefault();var formData=new FormData(this);formData.append('_method','PATCH');$.ajax({url:"{{ route('updateNgoInfo') }}",type:"POST",data:formData,contentType:!1,processData:!1,success:function(response){toastr.success(response.message);
if(response.establishment){$("#establishment").text(response.establishment)}
if(response.abn){$("#abn").text(response.abn)}
if(response.acnc){$("#acnc").text(response.acnc)}
if(response.size){$("#size").text(response.size)}
if(response.gst){$("#gst").text(response.gst)}},error:function(xhr){var message=xhr.responseJSON.message||'An error occurred. Please try again.';toastr.error(message);if(xhr.responseJSON.errors){$.each(xhr.responseJSON.errors,function(key,error){toastr.error(error[0])})}}})})})
</script>
@endsection