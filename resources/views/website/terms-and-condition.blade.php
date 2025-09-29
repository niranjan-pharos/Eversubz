@extends('frontend.template.master')
@section('title', 'Terms of use')
@section('description', 'Terms of use eversabz account.')
@section('content')
<link rel="stylesheet" href="assets/css/custom/about.css">

<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Terms of Use</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Terms of Use</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section> 


<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content">
                    <h4>1. Acceptance of Terms </h4>

                    <p>By accessing or using the Eversabz website, you agree to be bound by these Terms & Conditions. If
                        you do not agree with any part of these terms, please refrain from using our services.</p>

                    <h4>2. User Accounts </h4>


                    <ol>
                        <li>You are responsible for maintaining the confidentiality of your account credentials. </li>
                        <li>You must provide accurate and complete information during registration.</li>
                        <li>You agree not to share your account with others or use someone else’s account.</li>
                    </ol>


                    <h4>3. Content and Usage</h4>

                    <ol>
                        <li>Eversabz provides a platform for buying and selling various products and services.</li>
                        <li>Users must comply with all applicable laws and regulations.</li>
                        <li>You may not use Eversabz for illegal, harmful, or fraudulent purposes</li>
                    </ol>


                    <h4>4. Privacy
                    </h4>

                    <ol>
                        <li>Our Privacy Policy outlines how we collect, use, and protect your personal information.</li>
                        <li>By using Eversabz, you consent to the practices described in our Privacy Policy.</li>
                    </ol>


                    <h4>5. Intellectual Property</h4>

                    <ol>
                        <li>Eversabz’s content, trademarks, and logos are protected by intellectual property laws.</li>
                        <li>Users may not reproduce, modify, or distribute our content without permission.</li>
                    </ol>


                    <h4>6. Disclaimers</h4>

                    <ol>
                        <li>Eversabz does not endorse or guarantee the accuracy of listings or user-generated content.
                        </li>
                        <li>We are not liable for any transactions or interactions between users.</li>
                    </ol>


                    <h4>7. Limitation of Liability</h4>

                    <ol>
                        <li>Eversabz shall not be liable for any direct, indirect, or consequential damages.</li>
                        <li>Users agree to indemnify and hold Eversabz harmless from any claims.</li>
                    </ol>


                    <h4>8. Governing Law</h4>

                    <ol>
                        <li>These Terms & Conditions are governed by the laws of the jurisdiction where Eversabz
                            operates.
                        </li>
                    </ol>
                    <h4>9. Account Deletetion</h4>

                    <ol>
                        <li>To request account deletion, <a href="{{ route('account.delete') }}">click here</a>. Please note that deleting your account will permanently erase all your data, and it cannot be restored later.</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
</section>


<style>
  .about-content h4{margin:20px 0 10px;text-decoration:underline}.about-content{margin-bottom:30px;padding:40px; text-align: justify;}.about-content ol{list-style-type:auto;margin-left:15px}.about-content ol li{line-height:normal;font-size:18px}.about-content p{font-size:18px;line-height:normal}@media (max-width:767px){.about-content{padding:0;margin-bottom: 120px;}.about-content h4{font-size:19px}.about-content p{font-size:16px}}
</style>
@endsection