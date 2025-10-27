@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Donation Confirmation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #333;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 40px 0;
        }

        .email-container {
            max-width: 640px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        /* Header */
        .email-header {
            background: #2d69b3; /* Blue header */
            text-align: center;
            padding: 40px 20px;
            position: relative;
        }

        .logo-card {
            background: #ffffff;
            display: inline-block;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        .logo-card img {
            width: 180px;
            display: block;
        }

        .email-content {
            padding: 35px 40px;
        }

        h2 {
            color: #111827;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 25px;
        }

        /* Donation summary table */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 30px;
            background: #f9fafb;
            border-radius: 8px;
            overflow: hidden;
        }

        .summary-table th,
        .summary-table td {
            padding: 12px 18px;
            font-size: 15px;
        }

        .summary-table th {
            text-align: left;
            background: #eef2ff;
            color: #1e3a8a;
            font-weight: 600;
        }

        .summary-table td {
            border-bottom: 1px dashed #d1d5db; /* dashed bottom border */
        }

        .summary-table td:last-child {
            text-align: right;
            color: #111827;
            font-weight: 500;
        }

        .message-box {
            background: #f9fafb;
            padding: 15px 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 10px;
            font-size: 14px;
        }

        .footer-note {
            background-color: #eef2ff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            color: #1e3a8a;
            font-size: 14px;
            font-weight: 500;
        }

        .footer {
            text-align: center;
            padding: 25px;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
            color: #6b7280;
        }

        .footer a {
            color: #0056b3;
            text-decoration: none;
            font-weight: 600;
        }

        @media only screen and (max-width: 600px) {
            .email-content {
                padding: 20px;
            }

            h2 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">

            <!-- HEADER -->
            <div class="email-header">
                <div class="logo-card">
                    <img src="https://eversabz.com/assets/images/logo.png" alt="Eversabz Logo">
                </div>
            </div>

            <!-- CONTENT -->
            <div class="email-content">
                <h2>Hello {{ $donation->name }},<br>Thank You for Your Generous Donation!</h2>

                <table class="summary-table">
                    <tr>
                        <th>Donation Number</th>
                        <td>{{ $donation->donation_number }}</td>
                    </tr>
                    <tr>
                        <th>Amount Donated</th>
                        <td>${{ number_format($donation->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Tip</th>
                        <td>${{ number_format($donation->tip, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Transaction Fee</th>
                        <td>${{ number_format($donation->transaction_fee, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>${{ number_format($donation->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ Carbon::parse($donation->created_at)->format('F j, Y') }}</td>
                    </tr>
                </table>

                <div class="message-box">
                    <strong>Message:</strong> {{ $donation->message ?? 'No message provided.' }}
                </div>

                @if($donation->anonymous)
                    <div class="message-box" style="margin-top:10px;">
                        <strong>This donation was made anonymously.</strong>
                    </div>
                @endif

                <div class="footer-note" style="margin-top:30px;">
                    Thank you again for your generosity 🌿<br>
                    Your contribution helps us make a positive impact every day.
                </div>
            </div>

            <!-- FOOTER -->
            <div class="footer">
                <p>If you have any questions, just reply to this email — we’d love to help.</p>
                <p>Warm regards,<br><strong>Eversabz Team</strong></p>
                <p>Need assistance? <a href="{{ url('contactus') }}">Contact Us</a></p>
            </div>

        </div>
    </div>
</body>
</html>
