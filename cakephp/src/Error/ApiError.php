<?php
namespace App\Error;

class ApiError implements CustomErrorInterface
{
    private int $code;
    private string $message;
    private ?array $details;

    public function __construct(int $code, string $message, ?array $details = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->details = $details;
    }

    public function getErrorCode(): int
    {
        return $this->code;
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }

    public function getErrorDetails(): ?array
    {
        return $this->details;
    }
}