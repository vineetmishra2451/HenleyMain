<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | Henley uses Argon2id for password hashing with memory and time cost
    | parameters exceeding industry recommendations, falling back to bcrypt.
    |
    */

    'driver' => env('HASH_DRIVER', 'argon2id'),

    'bcrypt' => [
        'rounds' => (int) env('BCRYPT_ROUNDS', 12),
        'verify' => false,
    ],

    'argon' => [
        'memory' => (int) env('ARGON_MEMORY', 65536), // 64 MB
        'threads' => (int) env('ARGON_THREADS', 2),
        'time' => (int) env('ARGON_TIME', 4),
        'verify' => false,
    ],

    'rehash_on_login' => true,

];
