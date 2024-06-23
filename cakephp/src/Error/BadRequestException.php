<?php
declare(strict_types=1);

namespace App\Error;

/**
 * BadRequestException
 *
 * This exception is thrown when the client sends an invalid request.
 * It represents an HTTP 400 Bad Request error.
 */
class BadRequestException extends CustomApiException
{
    /**
     * Constructor
     *
     * @param string $message The error message. Defaults to 'Bad Request'.
     * @param array<string, mixed> $details Additional details about the error. Defaults to an empty array.
     */
    public function __construct(string $message = 'Bad Request', array $details = [])
    {
        parent::__construct($message, 400, $details);
    }
}
