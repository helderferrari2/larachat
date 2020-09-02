<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use BadMethodCallException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //Handle All Json Requests
        if (request()->wantsJson()) {
            // return $this->handleException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    public function handleException($request, Throwable $exception)
    {
        //AuthorizationException
        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse($exception->getMessage(), [], 401);
        }

        //TokenExpiredException
        if ($exception instanceof TokenExpiredException) {
            return $this->errorResponse('unauthenticated', [], 401);
        }

        //UnauthorizedHttpException
        if ($exception instanceof UnauthorizedHttpException) {
            return $this->errorResponse('unauthenticated', [], 401);
        }

        //ModelNotFoundException
        if ($exception instanceof ModelNotFoundException) {
            return $this->errorResponse($exception->getMessage(), [], 404);
        }

        //BadMethodCallException
        if ($exception instanceof BadMethodCallException) {
            return $this->errorResponse($exception->getMessage(), [], 404);
        }

        //InvalidArgumentException, validator Laravel
        if ($exception instanceof InvalidArgumentException) {
            return $this->errorResponse('The given data was invalid.', json_decode($exception->getMessage(), true), 422);
        }

        //NotFoundHttpException
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse($exception->getMessage(), [], 404);
        }

        //MethodNotAllowedHttpException
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('Method not allowed', [], 405);
        }

        //Generic Method
        if ($exception instanceof UnauthorizedHttpException) {
            return $this->errorResponse($exception->getMessage(), [], 400);
        }

        //Query Error
        if ($exception instanceof QueryException) {
            return $this->errorResponse('Error on persist data', [], 500);
        }

        //Custom Exception
        if ($exception instanceof CustomException) {
            return $this->errorResponse($exception->getMessage(), [], $exception->getCode());
        }

        return $this->errorResponse('Whoops, looks like something went wrong.', 500);
    }
}
