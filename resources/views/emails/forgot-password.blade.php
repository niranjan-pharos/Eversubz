{{-- resources/views/emails/forgot-password.blade.php --}}
@extends('email_layout')

@section('content')
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px;">
                <h1>Verify Your Email Address</h1>
                <p>Thanks for signing up! Please verify your email address by clicking the button below:</p>

                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                    <tr>
                        <td align="center">
                            {{-- Use the passed $actionUrl variable --}}
                            <a href="{{ $actionUrl }}" style="background-color:#007bff;color:#fff;padding:10px 20px;text-decoration:none;border-radius:5px;display:inline-block;">
                                Verify Email Address
                            </a>
                        </td>
                    </tr>
                </table>

                <p>This link will expire on {{ $expiration->toDateTimeString() }}
                    ({{ $expiration->diffForHumans() }} from now).
                </p>

                <p>If you did not create an account, no further action is required.</p>

                <p>Best regards,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
@endsection
