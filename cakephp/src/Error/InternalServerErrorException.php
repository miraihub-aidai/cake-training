<?php
declare(strict_types=1);

namespace App\Error;

/**
 * InternalServerErrorException
 *
 * This exception is thrown when an unexpected error occurs on the server side.
 * It represents an HTTP 500 Internal Server Error.
 */
class InternalServerErrorException extends CustomApiException
{
    /**
     * Constructor
     *
     * @param string $message The error message. Defaults to 'Internal Server Error'.
     * @param array $details Additional details about the error. Defaults to an empty array.
     */
    public function __construct(string $message = 'Internal Server Error', array $details = [])
    {
        parent::__construct($message, 500, $details);
    }
}