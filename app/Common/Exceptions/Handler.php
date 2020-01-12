<?php

namespace App\Common\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if (!$request->ajax() || !$request->wantsJson()) {
            if (config('app.debug')) {
                return parent::render($request, $exception);
            }else{
                return response()->view('errors.404', [], 404);   
            }
        }else{

            $exception = $this->prepareException($exception);

            if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
                return $exception->getResponse();
            }
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return $this->unauthenticated($request, $exception);
            }
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return $this->convertValidationExceptionToResponse($exception, $request);
            }

            $response = [];
            $response['status'] = false;
            $response['code'] = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() ?: 500 : 500;
            $response['message'] = method_exists($exception, 'getMessage') ? $exception->getMessage() ?: 'error' : 'error';

            if (config('app.debug')) {
                $response['trace'] = $exception->getTrace();
                $response['line'] = $exception->getCode();
            }

            return response()->json($response, $response['code']);
        }
    }
}
