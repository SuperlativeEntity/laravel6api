<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */

    'private_key'                   => env('PASSPORT_PRIVATE_KEY'),
    'public_key'                    => env('PASSPORT_PUBLIC_KEY'),
    'token_expiry'                  => env('PASSPORT_TOKENS_EXPIRE_IN_X_DAYS',15),
    'refresh_token_expiry'          => env('PASSPORT_REFRESH_TOKENS_EXPIRE_IN_X_DAYS',30),
    'personal_access_token_expiry'  => env('PASSPORT_PERSONAL_ACCESS_TOKENS_EXPIRE_IN_X_MONTHS',6),
];
