<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Set up your API key, you can find your key accessing your
    | dashboard at https://dashboard.pagar.me
    */

    'api_key' => env('PAGARME_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | Set up your encryption key, you can find your key accessing your
    | dashboard at https://dashboard.pagar.me
    */

    'encryption_key' => env('PAGARME_ENCRYPTION_KEY', ''),

];
