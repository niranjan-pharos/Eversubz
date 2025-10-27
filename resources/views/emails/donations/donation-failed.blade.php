@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donation Payment Failed</title>

<style>
    /* Email-safe styles */
    body {
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .container {
        max-width: 625px;
        margin: 20px auto;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .header {
        background-color: #007BFF;
        text-align: center;
        padding: 20px;
    }

    .header .logo-box {
        background: #fff;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 10px;
    }

    .header img {
        width: 200px;
        display: block;
        margin: auto;
    }

    .content {
        padding: 30px;
        color: #000;
    }

    h2 {
        font-size: 28px;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    p {
        color: #555;
        font-size: 14px;
        line-height: 1.5;
        margin: 5px 0;
    }

    .details {
        margin-top: 30px;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        background: #f9f9f9;
    }

    .details h3 {
        text-align: center;
        color: #000;
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .details table {
        width: 100%;
        font-size: 14px;
        color: #000;
    }

    .details td {
        padding: 6px 0;
    }

    .details td:last-child {
        text-align: right;
    }

    .details tr.dashed-border td {
        border-bottom: 1px dashed #ccc;
        padding-bottom: 8px;
    }

    .message {
        margin-top: 20px;
        color: #000;
        font-size: 14px;
    }

    .failed {
        color: red;
        font-weight: 600;
    }

    .footer {
        background: #ffffff;
        padding: 20px;
        font-size: 14px;
        color: #000;
    }

    .footer a {
        color: #007BFF;
        text-decoration: none;
    }

    .support-box {
        background: #f1f1f1;
        padding: 15px;
        margin-top: 30px;
        border-radius: 6px;
    }

    .support-box p {
        text-align: center;
        margin: 0;
        color: #333;
    }
</style>
</head>

<body>
<table class="body-wrap" style="width:97%;margin:0 auto;">
    <tr>
        <td>
            <table class="container">
                {{-- HEADER --}}
                <tr>
                    <td class="header">
                        <div class="logo-box">
                            <img src="https://eversabz.com/assets/images/logo.png" alt="Eversabz Logo">
                        </div>
                    </td>
                </tr>

                {{-- CONTENT --}}
                <tr>
                    <td class="content">
                        <h2>Hello, {{ $donation->name }}</h2>
                        <p style="text-align:center;">
                            We're sorry to inform you that your donation attempt was <span class="failed">unsuccessful</span>.
                        </p>

                        {{-- DETAILS SECTION --}}
                        <div class="details">
                            <h3>Donation Details</h3>
                            <table>
                                <tr class="dashed-border">
                                    <td><strong>Donation Number:</strong></td>
                                    <td>{{ $donation->donation_number }}</td>
                                </tr>
                                <tr class="dashed-border">
                                    <td><strong>Amount Donated:</strong></td>
                                    <td>${{ number_format($donation->amount, 2) }}</td>
                                </tr>
                                <tr class="dashed-border">
                                    <td><strong>Tip:</strong></td>
                                    <td>${{ number_format($donation->tip, 2) }}</td>
                                </tr>
                                <tr class="dashed-border">
                                    <td><strong>Transaction Fee:</strong></td>
                                    <td>${{ number_format($donation->transaction_fee, 2) }}</td>
                                </tr>
                                <tr class="dashed-border">
                                    <td><strong>Total Amount:</strong></td>
                                    <td>${{ number_format($donation->total_amount, 2) }}</td>
                                </tr>
                                <tr class="dashed-border">
                                    <td><strong>Date:</strong></td>
                                    <td>{{ Carbon::parse($donation->created_at)->format('F j, Y') }}</td>
                                </tr>
                            </table>

                            <div class="message">
                                <p><strong>Message:</strong> {{ $donation->message ?? 'No message provided.' }}</p>
                                <p><strong>Payment Status:</strong> <span class="failed">Failed</span></p>
                            </div>
                        </div>

                        <p style="text-align:center; margin-top:25px;">
                            We're sorry for the inconvenience. Please try again or contact support if you need assistance.
                        </p>

                        <div class="support-box">
                            <p>If you need further assistance, please contact our support team.</p>
                        </div>
                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td class="footer">
                        <p>If you have any questions, feel free to reply to this email and we’ll get back to you.</p>
                        <p>Thanks again for choosing us!</p>
                        <p>Regards,<br><strong>Eversabz Team</strong></p>
                        <p>For support: <a href="{{ url('contactus') }}">Contact Us</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
