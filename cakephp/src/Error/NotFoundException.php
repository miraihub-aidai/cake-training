<?php
declare(strict_types=1);

namespace App\Error;

class NotFoundException extends CustomApiException
{
    public function __construct(string $message = 'Not Found', array $details = [])
    {
        parent::__construct($message, 404, $details);
    }
}