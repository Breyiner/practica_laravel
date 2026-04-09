<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiExceptionHandler
{
    public static function handle(Throwable $e)
    {

        if ($e instanceof ValidationException) {
            $flattenedErrors = collect($e->errors())
                ->flatten()
                ->values()
                ->all();

            return response()->json(['Datos inválidos' => $flattenedErrors], 422);
        }

        return response()->json(
            ['Error interno del servidor' => config('app.debug') ? [$e->getMessage()] : []],
            500,  
        );
    }
}