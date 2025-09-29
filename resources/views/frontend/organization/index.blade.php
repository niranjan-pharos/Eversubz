@extends('frontend.template.master')
@section('title',  "business info")

@section('content')
@include('frontend.template.usermenu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css"
    rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>


{{--
<script src="http://13.211.54.157/admin_assets/js/select2.full.js"></script> --}}
<style>
.note-toolbar{background:hsla(0,0%,50.2%,.11);display:block}.ui-datepicker-month{display:none}.ui-datepicker-calendar{display:none}.ui-datepicker{width:200px;height:auto}.row1{column-gap:10px;padding:0 8px 0 17px}.col-form-label{font-weight:700}.row1 .form-group{width:48%}textarea.form-control{height:115px!important}.form-group{margin-bottom:10px}.row1 .form-group1{width:97%}form .btn{padding:10px 30px}.select2-container--default .select2-selection--multiple{border:1px solid #dcdcdc;min-height:40px!important}.select2-container--default .select2-selection--single{height:40px}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#444;line-height:40px}.account-card{height:auto}.account-card1{padding:10px 0}.form-control{border:1px solid #00000040!important}.form-control:focus{border-color:#00b6f552!important}.form-control:focus{color:#000!important}.form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #000;height:40px!important;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;box-shadow:none ! IMPORTANT}.form-control:focus{outline:none;box-shadow:none;color:#fff;background:#fff;border-color:var(--primary)}.accordion{font-size:20px;font-weight:700;padding:0 40px 25px}.accordion::before{position:absolute;content:"";top:50px;left:5%;width:50px;height:2px;background:var(--primary)}.panel{padding:20px 40px;background-color:#fff;display:none;overflow:hidden}.info{background-color:#e7e7e796;padding:10px;font-size:14px;font-weight:500;margin-bottom:.5rem}@media (max-width:767px){.row1 .form-group{width:100%}.select2-container{box-sizing:border-box;width:100% ! IMPORTANT;display:inline-block;margin:0;position:relative;vertical-align:middle}.accordion::before{position:absolute;content:"";top:50px;left:14%;width:50px;height:2px;background:var(--primary)}}
</style>

<section class="profile-part">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Organization Info</h3>
                    </div>


                    <form id="ngoInfoForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="text-left info">Personal Info</h5>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Ngo Name :<sup class="text-danger">*</sup></label>
                                    <input class="form-control" type="text" required name="ngo_name" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Category :<sup class="text-danger">*</sup></label>
                                    <select class="form-control required select2 ajax_category" name="cat_id"
                                        id="business_category">
                                        <option value="" selected></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Email :<sup class="text-danger">*</sup></label>
                                    <input class="form-control" type="text" required name="contact_email" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Establishment Year :</label>
                                    <input class="form-control yearpicker" type="text" name="establishment" value="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group form-group1">
                                    <label class="col-form-label">Languages :</label>
                                    <select class="form-control add_multi_language select2" id="languages"
                                        multiple="multiple" name="languages[]">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5 class="text-left info">Ngo Info</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="abn">ABN:</label>
                                    <input class="form-control" type="text" id="abn" name="abn" value="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="acnc">ACNC:</label>
                                    <input class="form-control" type="text" id="acnc" name="acnc" value="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="gst">GST:</label>
                                    <input class="form-control" type="text" id="gst" name="gst" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label">NGO Size :</label>
                                    <select class="select form-control" name="size">
                                        <option value="0">Select Size</option>
                                        <option value="large">Large</option>
                                        <option value="medium">Medium</option>
                                        <option value="small">Small</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5 class="text-left info">Contact Info</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group form-group1">
                                    <label class="col-form-label">Ngo address :</label>
                                    <input type="text" name="ngo_address" placeholder="Address" class="form-control"
                                        value="" id="address-input">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Ngo City :<sup class="text-danger">*</sup></label>
                                    <input type="text" name="ngo_city" placeholder="City" value="" class="form-control"
                                        id="city-input">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Ngo State :</label>
                                    <input type="text" name="ngo_state" placeholder="State" class="form-control"
                                        value="" id="state-input">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Ngo Country :</label>
                                    <input type="text" name="ngo_country" placeholder="Country" class="form-control"
                                        value="" id="country-input">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Contact phone :</label>
                                    <input class="form-control" type="text" name="contact_phone" id="contact_phone"
                                        value="" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Website URL :</label>
                                    <input class="form-control" type="url" name="website_url" value="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5 class="text-left info">Social Media Info</h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">Facebook URL :</label>
                                    <input class="form-control" type="text" name="facebook_url" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">Twitter URL :</label>
                                    <input class="form-control" type="text" name="twitter_url" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">Instagram URL :</label>
                                    <input class="form-control" type="text" name="instagram_url" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">Linkedin URL :</label>
                                    <input class="form-control" type="text" name="linkedin_url" value="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5 class="text-left info">Others Info</h5>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group form-group1">
                                    <label class="col-form-label" for="logo">Organization Logo:</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="form-group form-group1">
                                    <label class="col-form-label" for="other_images">Other Images:</label>
                                    <input class="form-control" type="file" id="other_images" name="other_images[]"
                                        multiple>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group form-group1">
                                    <label class="col-form-label">Description :</label>
                                    
                                        <textarea rows="6" cols="5" class="form-control" placeholder="Description"
                                        name="ngo_description" id="ngo_description"
                                        ></textarea>
                                    <span id="description_chars"></span>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="submitForm" class="btn btn-inline">Submit</button>
                        <div id="loader" class="spinner-border text-primary" role="status" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js">
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
    async defer></script>

<script>
$(document).ready(function(){$('#ngo_description').summernote({height:150})});$(document).ready(function(){$(".accordion").on("click",function(){$(this).toggleClass("active");$(this).next().slideToggle(200)})});function initialize(){var cityInput=document.getElementById('city-input');var stateInput=document.getElementById('state-input');var countryInput=document.getElementById('country-input');var options={componentRestrictions:{country:'AU'},types:['(cities)']};var autocomplete=new google.maps.places.Autocomplete(cityInput,options);autocomplete.addListener('place_changed',function(){var place=autocomplete.getPlace();console.log(place);var city=place.name;var state='';var country='';for(var i=0;i<place.address_components.length;i++){var component=place.address_components[i];if(component.types.includes('administrative_area_level_1')){state=component.long_name}else if(component.types.includes('country')){country=component.long_name}}
cityInput.value=city;stateInput.value=state;countryInput.value=country})}
</script>

@endsection