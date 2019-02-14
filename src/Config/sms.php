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

    'default' => env('DEFAULT_SMS_GATEWAY', 'africastalking'),

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

        'africastalking' => [
            'username' => env('AFRICASTALKING_USERNAME'),
            'api_key' => env('AFRICASTALKING_API_KEY'),
            'from' => env('AFRICASTALKING_FROM')
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Gateways above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use
    | here with the same name. You will have to implement
    | CraftedSystems\LaravelSMS\Contracts\SMSContract in your gateway.
    |
    */

    'map' => [
        'africastalking' => \CraftedSystems\LaravelSMS\Gateways\AfricasTalking::class,
    ]
];
