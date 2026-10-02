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
    // 'campay' => [
    //     'base_url'    => env('CAMPAY_BASE_URL'),
    //     'token'       => env('CAMPAY_TOKEN'),
    //     'webhook_key' => env('CAMPAY_WEBHOOK_KEY'),
    // ],
    'fapshi' => [
        'base_url' => env('FAPSHI_BASE_URL'),
        'api_user' => env('FAPSHI_API_USER'),
        'api_key'  => env('FAPSHI_API_KEY'),
    ],
    'whatsapp_group_link' => env('WHATSAPP_GROUP_LINK'),
    'access_amount' => env('ACCESS_AMOUNT', 1050), // 1050 par défaut si la variable est absente

    'whatsapp_group_link' => env('WHATSAPP_GROUP_LINK'),

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
