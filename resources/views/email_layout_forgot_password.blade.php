<!DOCTYPE html>
<html>
<head>
    @include('emails.mail_head_forgot_password')
</head>
<body>
    @yield('content')
    @include('emails.mail_foot')
</body>
</html>