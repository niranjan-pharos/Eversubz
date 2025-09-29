@extends('frontend.template.master')

@section('content')
<section class="single-banner">
    <div class="container">
        <div class="row">
            <h1>Payment Cancelled</h1>
            <p>Your payment was not completed. If this was an error, you can try again.</p>
            <form method="POST" action="{{ route('retry.payment') }}">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order_id }}">
                <button type="submit">Retry Payment</button>
            </form>

        </div>
    </div>
</section>

