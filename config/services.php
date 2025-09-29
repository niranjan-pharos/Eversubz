<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'square' => [
        'application_id' => env('SQUARE_APPLICATION_ID'),
        'location_id' => env('SQUARE_LOCATION_ID'),
        'access_token' => env('SQUARE_ACCESS_TOKEN'),
        'environment' => env('SQUARE_ENVIRONMENT', 'sandbox'),
    ],
    'commbank' => [
        'merchant_id' => env('COMMBANK_MERCHANT_ID'),
        'form_url'    => env('COMMBANK_FORM_URL'), 
        'api_url'      => env('COMMBANK_API_URL'),
        'api_password'    => env('COMMBANK_API_PASSWORD'), 
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
