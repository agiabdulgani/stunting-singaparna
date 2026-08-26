<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | Konfigurasi kredensial untuk layanan pihak ketiga seperti
    | Postmark, Resend, Amazon SES, Slack, dan layanan lainnya.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Postmark
    |--------------------------------------------------------------------------
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Resend
    |--------------------------------------------------------------------------
    */

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Amazon SES
    |--------------------------------------------------------------------------
    */

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Amazon S3
    |--------------------------------------------------------------------------
    */

    's3' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'bucket' => env('AWS_BUCKET'),
        'url' => env('AWS_URL'),
        'endpoint' => env('AWS_ENDPOINT'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Slack
    |--------------------------------------------------------------------------
    */

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Google
    |--------------------------------------------------------------------------
    |
    | Tambahkan jika nantinya aplikasi menggunakan Google OAuth.
    |
    */

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

];