<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Gateway
    |--------------------------------------------------------------------------
    |
    | This value determines which of the following gateway to use.
    | You can switch to a different gateway at runtime.
    |
    */

    'default' => env('DEFAULT_SMS_GATEWAY'),

    /*
    |--------------------------------------------------------------------------
    | List of Gateways
    |--------------------------------------------------------------------------
    |
    | These are the list of gateways to use for this package.
    | You can change the name. Then you'll have to change
    | it in the map array too.
    |
    */

    'gateways' => [

        'bongatech' => [
            'user_id' => env('BONGATECH_USER_ID'),
            'password' => env('BONGATECH_PASSWORD'),
            'sender_id' => env('BONGATECH_SENDER_ID'),
            'call_back_url' => env('BONGATECH_CALL_BACK_URL')
        ],

        'micromobile' => [
            'service_id' => env('MICROMOBILE_SERVICE_ID'),
            'username' => env('MICROMOBILE_USERNAME'),
            'password' => env('MICROMOBILE_PASSWORD'),
            'call_back_url' => env('MICROMOBILE_CALL_BACK_URL'),
            'base_url' => env('MICROMOBILE_BASE_URL'),
        ],

        'africastalking' => [
            'username' => env('AFRICASTALKING_USERNAME'),
            'api_key' => env('AFRICASTALKING_API_KEY'),
            'from' => env('AFRICASTALKING_FROM')
        ],

        'infosky' => [
            'acc_no' => env('INFOSKY_ACC_NO'),
            'api_key' => env('INFOSKY_API_KEY'),
            'sender_id' => env('INFOSKY_SENDER_ID'),
            'call_back_url' => env('INFOSKY_CALL_BACK_URL')
        ],

        'infobip' => [
            'username' => env('INFOBIP_USERNAME'),
            'password' => env('INFOBIP_PASSWORD'),
            'from' => env('INFOBIP_FROM'),
            'call_back_url' => env('INFOBIP_CALL_BACK_URL')
        ],

        'tilil' => [
            'username' => env('TILIL_USERNAME'),
            'password' => env('TILIL_PASSWORD'),
            'short_code' => env('TILIL_SHORTCODE'),
            'call_back_url' => env('TILIL_CALL_BACK_URL')
        ],

        'aptus' => [
            'username' => env('APTUS_USERNAME'),
            'password' => env('APTUS_PASSWORD'),
            'senderid' => env('APTUS_SENDERID')
        ],
        'synq' => [
            'user' => env('SYNQ_USER'),
            'password' => env('SYNQ_PASSWORD'),
            'source' => env('SYNQ_SOURCE')
        ],
        'smskenya' => [
            'api_key' => env('SMS_KENYA_API_KEY')
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Gateways above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use for
    | here with the same name. You will have to implement
    | CraftedSystems\LaravelSMS\Contracts\SMSContract in your gateway.
    |
    */

    'map' => [
        'bongatech' => \CraftedSystems\LaravelSMS\Gateways\Bongatech::class,
        'micromobile' => \CraftedSystems\LaravelSMS\Gateways\MicroMobile::class,
        'africastalking' => \CraftedSystems\LaravelSMS\Gateways\AfricasTalking::class,
        'infosky' => \CraftedSystems\LaravelSMS\Gateways\InfoSky::class,
        'infobip' => \CraftedSystems\LaravelSMS\Gateways\InfoBip::class,
        'tilil' => \CraftedSystems\LaravelSMS\Gateways\Tilil::class,
        'aptus' => \CraftedSystems\LaravelSMS\Gateways\Aptus::class,
        'synq' => \CraftedSystems\LaravelSMS\Gateways\Synq::class,
        'smskenya' => \CraftedSystems\LaravelSMS\Gateways\SMSKenya::class,
    ]
];
