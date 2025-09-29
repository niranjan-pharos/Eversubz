@extends('frontend.template.master')

@section('content')
@push('style')
<style>
    .payment-failed-part{padding: 80px 0px;    background: #F9FAFB;}
    .payment-failed-content h2 {
        font-size: 28px;
        margin-bottom: 20px;
    }
    .payment-failed-content p, .payment-failed-content ul {
        font-size: 18px;
        line-height: 1.6;
    }
    .payment-failed-content ul {
        list-style: disc;
        margin-left: 20px;
    }
    .payment-failed-part .btn {
        background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 10px;
}
    .payment-failed-image img {
        max-width: 100%;
        border-radius: 10px;box-shadow: 0px 0px 3px;
    }

    
    .payment-failed-part .col-lg-12{display: flex; justify-content: center;    margin-top: 20px;}
@media only screen and (max-width: 767px){
    .payment-failed-content{margin-top: 40px;}
    .payment-failed-part {
    padding: 80px 0px 120px;
    }
}
</style>
@endpush
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Payment Failed!</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Failed!</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="payment-failed-part">
    <div class="container">
        <div class="row">

              <div class="col-lg-4">
                <div class="payment-failed-image">
                    <img loading="eager" src="{{asset('storage/assets/images/payment-failed.webp')}}" alt="Payment Failed" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="payment-failed-content">
                    <h2>Your Payment Failed!</h2>
                    <p>Unfortunately, we were unable to process your transaction. Please review the details below and try again.</p>
                    <p><strong>Error Details:</strong></p>
                    <ul>
                        <li>If your payment was declined, ensure your payment method has sufficient funds and is valid.</li>
                        <li>Check the information provided during checkout.</li>
                        <li>Contact your bank or payment provider for assistance.</li>
                    </ul>
                    <p>If you have any immediate questions or need help, feel free to <a href="/contact-us">contact us</a>. We’re here to assist!</p>
                  
                </div>
            </div>
            <div class="col-lg-12">
            <a href="/checkout" class="btn btn-primary mt-3">Retry Payment</a>
            </div>
            
        </div>
    </div>
</section>




@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Success');
        @endif
    });
</script>
@endpush
@endsection
