<?php
declare(strict_types=1);

namespace App\Error;

/**
 * GenericApiException
 *
 * This exception is used for API errors that don't fall into more specific categories.
 * It allows for custom error codes and messages to be set.
 */
class GenericApiException extends CustomApiException
{
    /**
     * Constructor
     *
     * @param string $message The error message
     * @param int $code The HTTP status code associated with this error
     * @param array $details Additional details about the error. Defaults to an empty array.
     */
    public function __construct(string $message, int $code, array $details = [])
    {
        parent::__construct($message, $code, $details);
    }
}