<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
        //     if ($request->is('api/*')) {
        //         return response()->json([
        //             'status' => 'error',
        //             'errors' => [
        //                 'global' => 'Unauthorized'
        //             ],
        //             'data' => []
        //         ], 401);
        //     }
        // });

        // $this->renderable(function (AccessDeniedHttpException $e, $request) {
        //     if ($request->is('api/*')) {
        //         return response()->json([
        //             'status' => 'error',
        //             'errors' => [
        //                 'global' => 'Tidak diizinkan mengakses resource'
        //             ],
        //             'data' => []
        //         ], 403);
        //     }
        // });

        // $this->renderable(function (HttpException $e, $request) {
        //     if ($request->is('api/*')) {
        //         if ($e->getStatusCode() == 422) {
        //             $response = [
        //                 'status' => 'error',
        //                 'errors' => $e->getMessage(),
        //                 'data' => []
        //             ];
        //         }
        //         return response()->json($response, $e->getStatusCode());
        //     }
        // });
    }

    
}
