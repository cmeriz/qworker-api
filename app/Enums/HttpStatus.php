<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class HttpStatus extends Enum
{
    const SUCCESS_LABEL = 'success';
    const REDIRECTION_LABEL = 'redirection';
    const FAIL_LABEL = 'fail';
    const ERROR_LABEL = 'error';
    const SUCCESS_CODE = 200;
    const CREATED_CODE = 201;
    const BAD_REQUEST_CODE = 400;
    const UNAUTHORIZED_CODE = 401;
    const FORBIDDEN_CODE = 403;
    const NOT_FOUND_CODE = 404;

    public static function getStatusLabel($code)
    {
        return match (true) {
            $code >= 200 && $code < 300 => HttpStatus::SUCCESS_LABEL,
            $code >= 300 && $code < 400 => HttpStatus::REDIRECTION_LABEL,
            $code >= 400 && $code < 500 => HttpStatus::FAIL_LABEL,
            default => HttpStatus::ERROR_LABEL
        };
    }

    public static function getValidatedStatus($status): int
    {
        if (!is_int($status) || $status < 200 || $status >= 600) {
            return 500;
        }
        return (int)$status;
    }
}
