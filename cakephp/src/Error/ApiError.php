<?php
declare(strict_types=1);

namespace App\Error;

/**
 * ApiError
 *
 * This class represents an API error and implements the CustomErrorInterface.
 */
class ApiError implements CustomErrorInterface
{
    /**
     * @var int The error code
     */
    private int $code;

    /**
     * @var string The error message
     */
    private string $message;

    /**
     * @var array<string, mixed>|null Additional error details
     */
    private ?array $details;

    /**
     * Constructor
     *
     * @param int $code The error code
     * @param string $message The error message
     * @param array<string, mixed>|null $details Additional error details (optional)
     */
    public function __construct(int $code, string $message, ?array $details = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->details = $details;
    }

    /**
     * Get the error code
     *
     * @return int The error code
     */
    public function getErrorCode(): int
    {
        return $this->code;
    }

    /**
     * Get the error message
     *
     * @return string The error message
     */
    public function getErrorMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the error details
     *
     * @return array<string, mixed>|null The error details, or null if not set
     */
    public function getErrorDetails(): ?array
    {
        return $this->details;
    }
}
