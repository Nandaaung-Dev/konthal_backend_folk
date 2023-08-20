<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (Exception $exception, $request) {
            if ($request->is('api/*')) {
                if ($exception instanceof ModelNotFoundException) {
                    $modelName = strtolower(class_basename($exception->getModel()));
                    $message = "Cannot find {$modelName}";
                    return response()->json([
                        'status' => 2,
                        'message' => $message,
                    ], Response::HTTP_OK);
                }
                if ($exception instanceof NotFoundHttpException) {
                    return response()->json(['status' => 2, 'message' => 'Incorect route'], Response::HTTP_OK);
                }
                if ($exception instanceof AuthorizationException) {
                    return response()->json(['status' => 3, 'message' => $exception->getMessage()], Response::HTTP_OK);
                }
                if ($exception instanceof UnauthorizedException) {
                    return response()->json(['status' => 2, 'message' => $exception->getMessage()], Response::HTTP_OK);
                }
            }
        });
    }
}
