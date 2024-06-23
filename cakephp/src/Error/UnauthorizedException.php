<?php
declare(strict_types=1);

namespace App\Error;

/**
 * UnauthorizedException
 *
 * This exception is thrown when the client is not authenticated.
 * It represents an HTTP 401 Unauthorized error.
 */
class UnauthorizedException extends CustomApiException
{
    /**
     * Constructor
     *
     * @param string $message The error message. Defaults to 'Unauthorized'.
     * @param array $details Additional details about the error. Defaults to an empty array.
     */
    public function __construct(string $message = 'Unauthorized', array $details = [])
    {
        parent::__construct($message, 401, $details);
    }
}