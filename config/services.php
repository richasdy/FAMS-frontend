<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'btp_asset' => [
        'url_api'      => env('BTPASSET_URL_API','http://128.199.115.183:8002/api/'),
        'url_web'      => env('BTPASSET_URL_WEB','http://128.199.115.183:8002/'),
        'app_key'      => '',
        'client_id'    => env('BTPASSET_CLIENT_ID',4),
        'client_secret'=> env('BTPASSET_CLIENT_SECRET','krrUUmbDtyxGVew2d1qaoAVaBPEZH2tguhRIN06o'),
    ],
];
