<?php
declare(strict_types=1);

namespace App\Error;

use Exception;

/**
 * CustomApiException
 *
 * This abstract class serves as a base for all custom API exceptions.
 * It implements the CustomErrorInterface and extends the built-in Exception class.
 */
abstract class CustomApiException extends Exception implements CustomErrorInterface
{
    /**
     * @var array Additional details about the error
     */
    protected array $details;

    /**
     * Constructor
     *
     * @param string $message The error message
     * @param int $code The HTTP status code
     * @param array $details Additional details about the error. Defaults to an empty array.
     */
    public function __construct(string $message, int $code, array $details = [])
    {
        parent::__construct($message, $code);
        $this->details = $details;
    }

    /**
     * Get the error code
     *
     * @return int The HTTP status code
     */
    public function getErrorCode(): int
    {
        return $this->getCode();
    }

    /**
     * Get the error message
     *
     * @return string The error message
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Get the error details
     *
     * @return array|null The additional error details
     */
    public function getErrorDetails(): ?array
    {
        return $this->details;
    }
}