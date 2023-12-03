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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '339296822545-qun0k9gtp3mbq3e70d9ib82mh7j0c3lk.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],
    'github' => [
        'client_id' => 'Iv1.facd4d85531bae65',
        'client_secret' => '4308c4f49585df5f01942e09d26f4f222a142b17',
        'redirect' => 'http://localhost:8000/auth/github/callback',
    ]

];
