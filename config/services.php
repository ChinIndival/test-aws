<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'facebook' => [
     'client_id' => '437726293844147',
     'client_secret' => '189f67ccd73a012789568e16f99cc54c',
     'redirect' => 'https://homestead.test/callback/facebook',
   ],

   'twilio' => [
     'sid' => env('TWILIO_ACCOUNT_SID'),
     'token' => env('TWILIO_ACCOUNT_TOKEN'),
     'key' => env('TWILIO_API_KEY'),
     'secret' => env('TWILIO_API_SECRET')
  ]

];
