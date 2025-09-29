
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Payment</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('paymentForm');
            var nonce = "{{ $nonce }}";  

            if (nonce) {
                form.submit();
            } else {
                console.error('Payment nonce is missing.');
            }
        });
    </script>
</head>
<body>
    <p>Redirecting to the payment process...</p>

    <form id="paymentForm" action="{{ route('process.payment') }}" method="POST">
        @csrf
        <input type="hidden" name="pending_order_id" value="{{ $pendingOrderId }}">
        <input type="hidden" name="nonce" value="{{ $nonce }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <!-- Add any other necessary hidden fields like nonce, cartItems, etc. -->
    </form>
</body>
</html>
