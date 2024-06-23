<?php
declare(strict_types=1);

namespace App\Error;

class BadRequestException extends CustomApiException
{
    public function __construct(string $message = 'Bad Request', array $details = [])
    {
        parent::__construct($message, 400, $details);
    }
}