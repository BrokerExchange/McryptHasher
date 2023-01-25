<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | passwords are hashed using the Mcrypt algorithm.
    |
    */

    'key' => env('MCRYPT_KEY',env('APP_KEY')),
];
