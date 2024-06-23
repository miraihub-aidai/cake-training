<?php
declare(strict_types=1);

namespace App\Error;

class UnauthorizedException extends CustomApiException
{
    public function __construct(string $message = 'Unauthorized', array $details = [])
    {
        parent::__construct($message, 401, $details);
    }
}