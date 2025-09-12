<?php

// use App\Http\Middleware\setKonfigs;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api([
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
        ]);

        $middleware->web([
            // LocaleMiddleware::class, // disable, we use single language which is Indonesian
            // setKonfigs::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            '*.test',
            'http://localhost/*',
            'http://127.0.0.1/*',
        ]);

        $middleware->alias([
            // 'role'                  => RoleMiddleware::class,
            // 'permission'            => PermissionMiddleware::class,
            // 'role_or_permission'    => RoleOrPermissionMiddleware::class,
            // 'set.konfigs'           => setKonfigs::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle exceptions here // jika user tidak terotentikasi, maka arahkan dengan message `no_session`
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, \Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            return redirect()->guest(route('login'))->with('no_session', 'Silakan masuk ke sistem');
        });
    })->create();
