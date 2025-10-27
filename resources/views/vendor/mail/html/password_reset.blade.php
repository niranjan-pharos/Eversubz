@extends('email_layout_forgot_password')

@section('content')
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 20px 0px 20px; background: white;">
                <p>You are receiving this email because we received a password reset request for your account.</p>
                
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                    <tr>
                        <td align="center">
                            <a href="{{ $url }}" 
                               style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                                Reset Password
                            </a>
                        </td>
                    </tr>
                </table>

                @if(isset($expiration))
                    <p>This password reset link will expire on 
                       {{ $expiration->toDayDateTimeString() }} 
                       ({{ $expiration->diffForHumans(now(), true) }} from now).
                    </p>
                @else
                    <p>This password reset link will expire in 
                       {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutes.
                    </p>
                @endif

                <p>If you did not request a password reset, no further action is required.</p>
            </td>
        </tr>
    </table>
@endsection
