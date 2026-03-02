<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        //
    })

    ->withExceptions(function (Exceptions $exceptions) {

        /**
         * ✅ 1. VALIDATION ERROR (VERY IMPORTANT)
         * Fix: 422 must not become 500
         */
        $exceptions->render(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'code' => 422,
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ], 422);
            }
        });

        /**
         * ✅ 2. MODEL NOT FOUND
         */
        $exceptions->render(function (ModelNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                $model = class_basename($e->getModel());

                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => "{$model} not found",
                ], 404);
            }
        });

        /**
         * ✅ 3. AUTHORIZATION ERROR
         */
        $exceptions->render(function (AuthorizationException $e, $request) {
            if ($request->is('api/*')) {

                // 🔥 keep original message (important for tests)
                $message = $e->getMessage() ?: 'This action is unauthorized.';

                return response()->json([
                    'status' => 'error',
                    'code' => 403,
                    'message' => $message,
                ], 403);
            }
        });

        /**
         * ✅ 4. NOT FOUND (ROUTE / MODEL WRAPPED)
         */
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {

                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    $model = class_basename($e->getPrevious()->getModel());

                    return response()->json([
                        'status' => 'error',
                        'code' => 404,
                        'message' => "{$model} not found",
                    ], 404);
                }

                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'API route not found',
                ], 404);
            }
        });

        /**
         * ✅ 5. GENERAL ERROR
         */
        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {

                return response()->json([
                    'status' => 'error',
                    'code' => 500,
                    'message' => config('app.debug')
                        ? $e->getMessage()
                        : 'Something went wrong',
                ], 500);
            }
        });

    })

    ->create();