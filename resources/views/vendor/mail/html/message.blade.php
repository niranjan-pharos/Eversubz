@extends('email_layout')

@section('content')
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 20px 0px 20px; background: white;">
                <h1>Verify Your Email Address</h1>
                <p>Thanks for signing up! Before getting started, please verify your email address by clicking the button below:</p>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                    <tr>
                        <td align="center">
                            <a href="{{ $url }}" style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                                Verify Email Address
                            </a>
                        </td>
                    </tr>
                </table>
                @if(isset($expiration))
                    <p>This link will expire on {{ $expiration->toDayDateTimeString() }} ({{ $expiration->diffForHumans(now(), true) }} from now).</p>
                @else
                    <p>This link will expire in {{ config('auth.verification.expire', 60) }} minutes.</p>
                @endif
                <p>If you did not create an account, no further action is required.</p>
            </td>
        </tr>
    </table>
@endsection
