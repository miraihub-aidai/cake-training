<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\GenericApiException;
use Cake\TestSuite\TestCase;

class GenericApiExceptionTest extends TestCase
{
    public function testConstructorWithMessageAndCode(): void
    {
        $message = 'Generic API Error';
        $code = 418; // I'm a teapot
        $exception = new GenericApiException($message, $code);

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame($message, $exception->getErrorMessage());
        $this->assertSame($code, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testConstructorWithMessageCodeAndDetails(): void
    {
        $message = 'Specific API Error';
        $code = 422; // Unprocessable Entity
        $details = ['field' => 'email', 'error' => 'Invalid format'];
        $exception = new GenericApiException($message, $code, $details);

        $this->assertSame($message, $exception->getErrorMessage());
        $this->assertSame($code, $exception->getErrorCode());
        $this->assertSame($details, $exception->getErrorDetails());
    }

    public function testGetErrorCode(): void
    {
        $code = 429; // Too Many Requests
        $exception = new GenericApiException('Rate limit exceeded', $code);

        $this->assertSame($code, $exception->getErrorCode());
    }

    public function testGetErrorMessage(): void
    {
        $message = 'Custom error message';
        $exception = new GenericApiException($message, 400);

        $this->assertSame($message, $exception->getErrorMessage());
    }

    public function testGetErrorDetails(): void
    {
        $details = ['reason' => 'Maintenance', 'retry_after' => '3600'];
        $exception = new GenericApiException('Service Unavailable', 503, $details);

        $this->assertSame($details, $exception->getErrorDetails());
    }

    public function testDifferentErrorCodes(): void
    {
        $codes = [400, 401, 403, 404, 405, 406, 409, 415, 422, 429, 500, 501, 503];

        foreach ($codes as $code) {
            $exception = new GenericApiException("Error {$code}", $code);
            $this->assertSame($code, $exception->getErrorCode());
            $this->assertSame($code, $exception->getErrorCode());
        }
    }
}
