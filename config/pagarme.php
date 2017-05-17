<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Keys
    |--------------------------------------------------------------------------
    |
    | Here you may set up your authentication keys from Pagar.me, you can find
    | your keys accessing the dashboard at the link below.
    |
    | See: https://dashboard.pagar.me/#/myaccount/apikeys
    */

    'keys' => [
        'api' => env('PAGARME_API_KEY', ''),
        'encryption' => env('PAGARME_ENCRYPTION_KEY', ''),
    ],

];
