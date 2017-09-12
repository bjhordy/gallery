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

    'facebook' => [
        'client_id' => env('FACEBOOK_KEY'),
        'client_secret' => env('FACEBOOK_SECRET'),
        'redirect' => Config('app.url') . '/login/facebook/callback',
    ],

    'twitter' => [
        'client_id' => env('TWITTER_KEY'),
        'client_secret' => env('TWITTER_SECRET'),
        'redirect' => Config('app.url') . '/twitter/callback'
    ],

    'google' => [
        'client_id' => env('GOOGLE_KEY'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect' => Config('app.url') . '/google/callback'
    ],

    'github' => [
        'client_id' => env('GITHUB_KEY'),
        'client_secret' => env('GITHUB_SECRET'),
        'redirect' => Config('app.url') . '/login/github/callback',
    ],

    'bitbucket' => [
        'client_id' => env('BITBUCKET_KEY'),
        'client_secret' => env('BITBUCKET_SECRET'),
        'redirect' => Config('app.url') . '/login/bitbucket/callback',
    ],

];
