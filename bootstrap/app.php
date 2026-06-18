<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'No estas autorizado porque no estas autenticado',
                ], 401);
            }
        });

        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            if ($request->is('api/*')) {
                $model = $e->getModel();
                $messages = [
                    App\Models\Empleado::class => 'El empleado no existe en la base de datos',
                    App\Models\Cargo::class => 'El cargo no existe en la base de datos',
                    App\Models\FuncionesCargo::class => 'La funcion de cargo no existe en la base de datos',
                ];

                return response()->json([
                    'success' => false,
                    'message' => $messages[$model] ?? 'El recurso no existe en la base de datos',
                ], 404);
            }
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            $previous = $e->getPrevious();

            if ($request->is('api/*') && $previous instanceof ModelNotFoundException) {
                $model = $previous->getModel();
                $messages = [
                    App\Models\Empleado::class => 'El empleado no existe en la base de datos',
                    App\Models\Cargo::class => 'El cargo no existe en la base de datos',
                    App\Models\FuncionesCargo::class => 'La funcion de cargo no existe en la base de datos',
                ];

                return response()->json([
                    'success' => false,
                    'message' => $messages[$model] ?? 'El recurso no existe en la base de datos',
                ], 404);
            }
        });

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
