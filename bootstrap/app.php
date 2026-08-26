<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(
    basePath: dirname(__DIR__)
)
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        /*
         * Middleware aplikasi.
         *
         * Middleware tambahan dapat didaftarkan di sini
         * jika dibutuhkan.
         */

        // Contoh jika nanti membuat middleware role:
        // $middleware->alias([
        //     'role' => \App\Http\Middleware\RoleMiddleware::class,
        // ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        /*
         * Penanganan exception khusus aplikasi
         * dapat ditambahkan di sini.
         */
    })

    ->create();