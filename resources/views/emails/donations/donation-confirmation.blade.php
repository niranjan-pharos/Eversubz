@php
    use Carbon\Carbon;
@endphp

<table class="body-wrap" style="width:97% !important;margin:0 auto;height:100%;background-color:#f9f9f9;">
    <tr>
        <td class="container" style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
            <table style="width:100% !important; border-collapse:collapse;">
                <tr>
                    <td class="masthead" style="">
                        <img class="email-logo" src="https://eversabz.com/assets/images/logo.png" alt="logo" style="width: 250px; border-radius: 10px; padding: 5px;margin: auto;display: flex;">
                    </td>
                </tr>
                <tr>
                    <td class="content" style="padding-bottom: 30px;background-color:white;">
                        <h2 style="margin: 0 0 0.5rem 0; line-height: 1.25; color: #000000; text-align: center; font-size: 1rem; font-weight: 500;margin: 35px 65px 0px;">
                            Hello, {{ $donation->name }}! <br />Thank you for your generous donation.
                        </h2>
                        <div style="background: #f9f9f9;margin: 35px;padding: 20px;">
                            <p style="color: #000000;text-align: center;font-size: 23px;"><strong style="font-weight: 500;">Donation Summary</strong></p>

                            <p style="text-align: center;margin: 0px;">
                                <strong style="font-weight: 500;">Donation Number:</strong> {{ $donation->donation_number }}
                            </p>

                            <p style="text-align: center;margin: 0px;">
                                <strong style="font-weight: 500;">Amount Donated:</strong> ${{ number_format($donation->amount, 2) }}
                            </p>

                            <p style="text-align: center;margin: 0px;">
                                <strong style="font-weight: 500;">Tip:</strong> ${{ number_format($donation->tip, 2) }}
                            </p>

                            <p style="text-align: center;margin: 0px;">
                                <strong style="font-weight: 500;">Transaction Fee:</strong> ${{ number_format($donation->transaction_fee, 2) }}
                            </p>

                            <p style="text-align: center;margin: 0px;">
                                <strong style="font-weight: 500;">Total Amount:</strong> ${{ number_format($donation->total_amount, 2) }}
                            </p>

                            <p style="text-align: center;margin: 20px 0;">
                                <strong style="font-weight: 500;">Date:</strong> {{ Carbon::parse($donation->created_at)->format('F j, Y') }}
                            </p>

                            <hr style="margin: 20px;color: #ddd;border: 1px solid;">

                            <p style="color: #000000; font-size: 14px;margin: 5px 5px 15px 20px;">
                                <strong style="font-weight: 500;">Message:</strong> {{ $donation->message ?? 'No message provided.' }}
                            </p>

                            @if($donation->anonymous)
                                <p style="color: #000000; font-size: 14px;margin: 5px 5px 15px 20px;">
                                    <strong style="font-weight: 500;">This donation was made anonymously.</strong>
                                </p>
                            @endif
                        </div>

                        <div style="background: #f9f9f9;margin: 35px;padding: 20px 25px 20px;">
                            <p style="color: #000000; text-align: center; font-size: 14px;">Thank you again for your generous support! Your contribution helps us achieve our mission.</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="content" style="background-color:white; padding:20px;">
                        <p style="font-size:14px;">If you have any questions, feel free to reply to this email and we will get back to you.</p>
                        <p style="font-size:14px;">Thanks again for choosing us!</p>
                        <p style="font-size:14px;">Thanks, <br />Eversabz</p>
                        <p style="font-size:14px;">For any support: <a href="{{ url('contactus') }}" style="color:#050505; text-decoration:none;">Contact Us</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
