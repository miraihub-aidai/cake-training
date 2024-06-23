<?php
declare(strict_types=1);

namespace App\Error;

class GenericApiException extends CustomApiException
{
    public function __construct(string $message, int $code, array $details = [])
    {
        parent::__construct($message, $code, $details);
    }
}