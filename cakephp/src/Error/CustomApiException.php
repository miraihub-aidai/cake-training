<?php
declare(strict_types=1);

namespace App\Error;

use Exception;

abstract class CustomApiException extends Exception implements CustomErrorInterface
{
    protected array $details;

    public function __construct(string $message, int $code, array $details = [])
    {
        parent::__construct($message, $code);
        $this->details = $details;
    }

    public function getErrorCode(): int
    {
        return $this->getCode();
    }

    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    public function getErrorDetails(): ?array
    {
        return $this->details;
    }
}