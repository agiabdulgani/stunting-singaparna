<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Silakan tambahkan middleware kustom atau alias di sini jika diperlukan
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Silakan tambahkan penanganan exception khusus di sini
    })->create();