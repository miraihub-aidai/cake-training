<?php
declare(strict_types=1);

namespace App\Error;

interface CustomErrorInterface
{
    public function getErrorCode(): int;
    public function getErrorMessage(): string;
    public function getErrorDetails(): ?array;
}