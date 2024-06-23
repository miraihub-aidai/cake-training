<?php
declare(strict_types=1);

namespace App\Error;

/**
 * NotFoundException
 *
 * This exception is thrown when the requested resource is not found.
 * It represents an HTTP 404 Not Found error.
 */
class NotFoundException extends CustomApiException
{
    /**
     * Constructor
     *
     * @param string $message The error message. Defaults to 'Not Found'.
     * @param array<string, mixed> $details Additional details about the error. Defaults to an empty array.
     */
    public function __construct(string $message = 'Not Found', array $details = [])
    {
        parent::__construct($message, 404, $details);
    }
}
