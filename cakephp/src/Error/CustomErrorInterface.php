<?php
declare(strict_types=1);

namespace App\Error;

/**
 * CustomErrorInterface
 *
 * This interface defines the contract for custom error objects in the application.
 * It provides methods to retrieve error information such as code, message, and details.
 */
interface CustomErrorInterface
{
    /**
     * Get the error code
     *
     * @return int The error code, typically an HTTP status code
     */
    public function getErrorCode(): int;

    /**
     * Get the error message
     *
     * @return string The human-readable error message
     */
    public function getErrorMessage(): string;

    /**
     * Get the error details
     *
     * @return array|null Additional details about the error, or null if no details are available
     */
    public function getErrorDetails(): ?array;
}