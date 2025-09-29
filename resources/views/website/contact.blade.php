@extends('frontend.template.master')

@section('content')

<link rel="stylesheet" href="assets/css/custom/contact.css">
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>contact us</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">contact</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-part">
    <div class="container"> 
        <div class="row">
            <div class="col-lg-4 d-none">
                <div class="contact-info"><i class="fas fa-envelope"></i>
                    <h3>Send Mail</h3>
                    <p>contact@example.com <span>info@example.com</span></p>
                </div>
            </div>
            <div class="col-lg-12">
            <form class="contact-form" id="contactForm" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-12">
        <h2 style="font-size:28px; text-align:center;">Get in touch</h2>
        <p style="text-align:center; max-width:700px; margin:10px auto 20px; color:#555; font-size:16px;">
        Have questions or need assistance? Fill out the form below and our team will get back to you as soon as possible.
    </p>
            <hr>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name*" name="name" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email*" name="email" required>
            </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Phone Number*" name="phone" id="phone" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Your City*" name="address" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Subject*" name="subject" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <textarea class="form-control" placeholder="Your Message*" name="message" required></textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-btn">
                <button class="btn btn-inline" type="submit"><i class="fas fa-paper-plane"></i><span>send message</span></button>
            </div>
        </div>
    </div>
</form>

            </div>
        </div>

        <div class="row mt-5 mb-5 d-none">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">Basic</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">Saftey</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                        aria-controls="v-pills-messages" aria-selected="false">Policies</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="card tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-home">
                            <a data-toggle="collapse" href="#v-collapse-home" aria-expanded="true" aria-controls="v-collapse-home">
                                How I create account?
                            </a>
                        </div>
                        <div id="v-collapse-home" class="collapse show" role="tabpanel" aria-labelledby="v-collapse-heading-home" data-parent="#v-pills-home">
                            <div class="card-body">
                                
                            <ol>
                              <li> Simply click on icon located at the top right of every Eversabz page</li>
                              <li> Click on sign up button</li>
                              <li>Fill up the for and select which type your account is and submit</li>
                              <li>If you are business account or organisation account then submit business info or organisation info after login and wait admin approval </li>
                            </ol>
                            </div>
                        </div>

                        <div class="card-header" role="tab" id="v-collapse-heading-home1">
                            <a data-toggle="collapse" href="#v-collapse-home1" aria-expanded="false" aria-controls="v-collapse-home1">
                               How I post ad?
                            </a>
                        </div>
                        <div id="v-collapse-home1" class="collapse" role="tabpanel" aria-labelledby="v-collapse-heading-home1" data-parent="#v-pills-home">
                            <div class="card-body">
                            <ol>
                              <li>CLick on plus icon located at the top right of every Eversabz page</li>
                              <li>If you are not login to your account then logged in to aour account</li>
                              <li>Then go to create post page </li>
                              <li>Fill the form and submit your ad. Wait for admin approval</li>
                            </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-profile">
                            <a data-toggle="collapse" href="#v-collapse-profile" aria-expanded="true" aria-controls="v-collapse-profile">
                                Culpa dolor voluptate
                            </a>
                        </div>
                        <div id="v-collapse-profile" class="collapse show" role="tabpanel" aria-labelledby="v-collapse-heading-profile" data-parent="#v-pills-profile">
                            <div class="card-body">
                                <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint minim consectetur qui.</p>
                            </div>
                        </div>

                        <div class="card-header" role="tab" id="v-collapse-heading-profile1">
                            <a data-toggle="collapse" href="#v-collapse-profile1" aria-expanded="false" aria-controls="v-collapse-profile1">
                                Culpa dolor voluptate
                            </a>
                        </div>
                        <div id="v-collapse-profile1" class="collapse" role="tabpanel" aria-labelledby="v-collapse-heading-profile1" data-parent="#v-pills-profile">
                            <div class="card-body">
                                <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint minim consectetur qui.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-messages">
                            <a data-toggle="collapse" href="#v-collapse-messages" aria-expanded="true" aria-controls="v-collapse-messages">
                                Fugiat id quis dolor
                            </a>
                        </div>
                        <div id="v-collapse-messages" class="collapse show" role="tabpanel" aria-labelledby="v-collapse-heading-messages" data-parent="#v-pills-messages">
                            <div class="card-body">
                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                            </div>
                        </div>

                        <div class="card-header" role="tab" id="v-collapse-heading-messages1">
                            <a data-toggle="collapse" href="#v-collapse-messages1" aria-expanded="false" aria-controls="v-collapse-messages1">
                                Fugiat id quis dolor
                            </a>
                        </div>
                        <div id="v-collapse-messages1" class="collapse" role="tabpanel" aria-labelledby="v-collapse-heading-messages1" data-parent="#v-pills-messages">
                            <div class="card-body">
                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .footer-widget li{list-style: none;}
  textarea.form-control{height:145px;padding:15px 20px}#v-pills-tab{background:#fff;padding:20px}#v-pills-tab .nav-link{width:100%;text-align:center}.tab-pane{display:none;padding:10px 50px}.contact-part{padding:100px 0 50px;background:var(--chalk)}ol,ul{list-style:auto}.card-header{margin-bottom:0;margin-top:20px}@media (max-width:575px){.contact-part{        padding-bottom: 120px;}.tab-pane{padding:10px 15px}}
</style>
<script>
    $(document).ready(function () {
        $('#contactForm').on('submit', function (e) {
            e.preventDefault();

            toastr.clear();

            let phone = $('#phone').val();
            let phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phone)) {
                toastr.error('Phone number must be exactly 10 digits.');
                return;
            }

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('contact-us.submit') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    toastr.success(response.success || 'Message sent successfully!');
                    $('#contactForm')[0].reset();
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Something went wrong. Please try again.');
                    }
                }
            });
        });
    });
</script>
@endsection
