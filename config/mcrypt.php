<?php

return [
    'key' => env('HASH_KEY',base64_decode(env('APP_KEY'))),
];