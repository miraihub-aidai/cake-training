<?php
declare(strict_types=1);

namespace App\Error;

/**
 * ForbiddenException
 *
 * This exception is thrown when the client does not have the necessary permissions
 * to access the requested resource. It represents an HTTP 403 Forbidden error.
 */
class ForbiddenException extends CustomApiException
{
    /**
     * Constructor
     *
     * @param string $message The error message. Defaults to 'Forbidden'.
     * @param array $details Additional details about the error. Defaults to an empty array.
     */
    public function __construct(string $message = 'Forbidden', array $details = [])
    {
        parent::__construct($message, 403, $details);
    }
}