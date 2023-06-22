<?php

namespace App\Http\Helpers;

use App\Enums\HttpStatus;
use Exception;

class ApiResponse
{
    /**
     * success
     *
     * @param  string $message Response message
     * @param  mixed $data Response data
     * @return Response
     */
    public static function success(string $message, $data = null)
    {
        return response()->api(
            HttpStatus::SUCCESS_CODE,
            $message,
            $data
        );
    }

    /**
     * created
     *
     * @param  string $message Response message
     * @param  mixed $data Response data
     * @return Response
     */
    public static function created(string $message, $data = null)
    {
        return response()->api(
            HttpStatus::CREATED_CODE,
            $message,
            $data
        );
    }

    /**
     * handleException
     *
     * @param  Exception $e Catched Exception
     * @return Response
     */
    public static function handleException(Exception $exception)
    {
        $message = '';
        $dbErrorCode = $exception?->errorInfo[1] ?? null;

        $message = match (true) {
            $dbErrorCode === 1062 => __('exceptions.db.duplicate'),
            default => $exception->getMessage()
        };

        return response()->api(
            $exception->getCode(),
            $message,
            [
                'dev_message' => $exception->getMessage() . ', line ' . $exception->getLine(),
                'trace' => $exception->getTrace(),
            ],
        );
    }
}
