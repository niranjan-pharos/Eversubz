<!DOCTYPE html>
<html>
<head>
    @include('emails.mail_head')
</head>
<body>
    @yield('content')
    @include('emails.mail_foot')
</body>
</html>