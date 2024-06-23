<?php
declare(strict_types=1);

namespace App\Error;

class ForbiddenException extends CustomApiException
{
    public function __construct(string $message = 'Forbidden', array $details = [])
    {
        parent::__construct($message, 403, $details);
    }
}