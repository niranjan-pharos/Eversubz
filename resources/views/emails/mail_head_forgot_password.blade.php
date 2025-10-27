<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Eversabz</title>
    <!-- For development, pass document through inliner -->
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Open+Sans');
        * {
            margin: 0;
            padding: 0;
            font-size: 100%;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            line-height: 1.65;
            color: #333333;
        }
        img {
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }
        body, .body-wrap {
            width: 97% !important;
            margin: 0 auto;
            height: 100%;
            background: #EFEFEF;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
        }
        a {
            color: #050505;
            font-weight: 700;
            text-decoration: none;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-left {
            text-align: left;
        }
        .button a {
            display: inline-block;
            color: #FFFFFF;
            background: #050505;
            border: 2px solid #050505;
            padding: 9px 20px 10px;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: normal;
        }
        .highlight {
            font-size: 22px;
            font-weight: bold;
        }
        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 20px;
            line-height: 1.25;
        }
        h1 {
            font-size: 32px;
        }
        h2 {
            font-size: 28px;
        }
        h3 {
            font-size: 24px;
        }
        h4 {
            font-size: 20px;
        }
        h5 {
            font-size: 16px;
        }
        p, ul, ol {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 20px;
        }
        p.footnote {
            font-size: 10px;
            margin-top: 5px;
        }
        .container {
            display: block !important;
            clear: both !important;
            margin: 20px auto 0 !important;
            max-width: 580px !important;
        }
        .container table {
            width: 100% !important;
            border-collapse: collapse;
        }
        .container .preheader {
            font-size: 12px;
            padding: 5px 5px 5px 5px;
            color: #ADADAD;
            text-align: center;
        }
        .container .masthead {
            padding: 80px 0;
            background: #2A333B;
            color: white;
            background-image: url("{{ $sitelink ?? url('') }}/uploads/logo.png");
            background-repeat: no-repeat;
            background-position: center 15px;
            border-radius: 10px 10px 0 0;
        }
        .container .masthead h1 {
            margin: 0 auto !important;
            max-width: 90%;
        }
        .container .content {
            background: white;
            padding: 20px 20px 0 20px;
        }
        .container .content.footer {
            background: none;
            padding-top: 0;
        }
        .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 12px;
        }
        .container .content.footer a {
            color: #888;
            text-decoration: none;
            font-weight: bold;
        }
        .trbtn {
            height: 30px;
            background: #D61616;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            font-size: 17px;
            height: 30px;
            padding: 8px 18px;
            margin-bottom: 20px;
            background: #0071c1;
    padding: 10px;
    color: #fff;
    border-radius: 5px;
        }
        .trbtn:hover {
            background: #050505;
        }
        .email-logo{width: 100px;}
    </style>
</head>
<body style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
<table class="body-wrap"
       style="width:97% !important;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;">
    <tr>
        <td class="container"
            style="display:block !important;clear:both !important;margin-top:20px !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:625px !important;">
            <!-- Message start -->
            <table style="width:100% !important;border-collapse:collapse;">
            <tr>
                    <td class="masthead"
                        style="text-align: center; padding-top: 80px; padding-bottom: 40px; 
                               background-color: #0071c1; color: white; border-radius: 10px 10px 0 0;">
                        
                        <!-- White Card for Logo -->
                        <div style="display: inline-block; background: #fff; border-radius: 12px; margin-bottom: 20px;
                                    padding: 15px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
                            <a href="#" style="display: inline-block;">
                                <img class="email-logo" src="{{ asset('assets/images/logo.png') }}" 
                                     alt="logo" 
                                     style="width: 120px; height: auto; display: block;">
                            </a>
                        </div>

                        <!-- Heading -->
                        <h1 style="line-height: 1.25; font-size: 32px; margin-top: 20px; color: #fff;
                                   margin-bottom: 0; max-width: 90%; margin-left: auto; margin-right: auto;">
                            Reset Your Password
                        </h1>
                    </td>
                </tr> 