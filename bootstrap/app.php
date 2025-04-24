<?php

use App\Exceptions\Api\ApiExceptionHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Ton traitement ici directement
        // Ou laisse Laravel gérer si tu ne fais rien de spécial
        if ($exceptions instanceof ApiExceptionHandler) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    })->create();
