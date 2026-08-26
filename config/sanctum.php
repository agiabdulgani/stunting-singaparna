<?php

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Laravel\Sanctum\Http\Middleware\AuthenticateSession;
use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Domain yang dianggap sebagai frontend SPA dan dapat menggunakan
    | autentikasi berbasis cookie Sanctum.
    |
    */

    'stateful' => explode(',', env(
        'SANCTUM_STATEFUL_DOMAINS',
        implode(',', array_filter([
            'localhost',
            'localhost:3000',
            'localhost:8000',
            '127.0.0.1',
            '127.0.0.1:8000',
            '127.0.0.1:3000',
            '::1',
            Sanctum::currentApplicationUrlWithPort(),
        ]))
    )),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | Guard yang digunakan Sanctum ketika melakukan autentikasi.
    |
    */

    'guard' => [
        'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | null = token tidak memiliki batas waktu dari konfigurasi ini.
    | Token tetap dapat dihapus melalui logout/revoke.
    |
    */

    'expiration' => env('SANCTUM_EXPIRATION', null),

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    |
    | Prefix tambahan untuk token Sanctum.
    |
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware yang digunakan Sanctum untuk autentikasi SPA.
    |
    */

    'middleware' => [

        'authenticate_session' => AuthenticateSession::class,

        'encrypt_cookies' => EncryptCookies::class,

        'validate_csrf_token' => ValidateCsrfToken::class,

    ],

];