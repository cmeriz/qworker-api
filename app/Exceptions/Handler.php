<?php

namespace App\Exceptions;

use App\Enums\HttpStatus;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->api(
                    HttpStatus::UNAUTHORIZED_CODE,
                    'No estás autenticado',
                    [
                        'dev_message' => $e->getMessage() . ' (line ' . $e->getLine() . ')',
                        'trace' => $e->getTrace(),
                    ]
                );
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->api(
                    HttpStatus::BAD_REQUEST_CODE,
                    'El recurso que has solicitado no se ha encontrado',
                    [
                        'dev_message' => $e->getMessage(),
                        'trace' => $e->getTrace(),
                    ]
                );
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->api(
                    $e->getCode(),
                    'Algunos campos son inválidos',
                    [
                        'dev_message' => $e->getMessage() . ' (line ' . $e->getLine() . ')',
                        'errors' => $e->errors(),
                        'trace' => $e->getTrace(),
                    ]
                );
            }
        });

        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return response()->api(
                    $e->getCode(),
                    'Ha habido un error',
                    [
                        'dev_message' => $e->getMessage() . ' (line ' . $e->getLine() . ')',
                        'trace' => $e->getTrace(),
                    ]
                );
            }
        });
    }
}
