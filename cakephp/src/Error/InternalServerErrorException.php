<?php
declare(strict_types=1);

namespace App\Error;

class InternalServerErrorException extends CustomApiException
{
    public function __construct(string $message = 'Internal Server Error', array $details = [])
    {
        parent::__construct($message, 500, $details);
    }
}