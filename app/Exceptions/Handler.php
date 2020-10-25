<?php

namespace App\Exceptions;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        $this->reportable(function (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is Invalid'], 400);
        });
        $this->reportable(function (TokenExpiredException $e) {
            return response()->json(['error' => 'Token is Expired'], 400);
        });
        $this->reportable(function (JWTException $e) {
            return response()->json(['error' => 'There is problem with your token'], 400);
        });
    }
    
}
