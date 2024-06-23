<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\CustomErrorInterface;
use Cake\TestSuite\TestCase;
use Exception;

class CustomApiExceptionTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $message = 'Test error message';
        $code = 500;
        $details = ['key' => 'value'];

        $exception = new ConcreteCustomApiException($message, $code, $details);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($code, $exception->getCode());
        $this->assertSame($details, $exception->getErrorDetails());
    }

    public function testErrorCodeGetter(): void
    {
        $exception = new ConcreteCustomApiException('Test', 404);

        $this->assertSame(404, $exception->getErrorCode());
    }

    public function testErrorMessageGetter(): void
    {
        $message = 'Custom error message';
        $exception = new ConcreteCustomApiException($message, 400);

        $this->assertSame($message, $exception->getErrorMessage());
    }

    public function testDefaultDetails(): void
    {
        $exception = new ConcreteCustomApiException('Test', 500);

        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testExceptionInheritance(): void
    {
        $exception = new ConcreteCustomApiException('Test', 500);

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertInstanceOf(CustomErrorInterface::class, $exception);
    }

    public function testCustomDetailsAccess(): void
    {
        $details = ['error' => 'Not found', 'id' => 123];
        $exception = new ConcreteCustomApiException('Test', 404, $details);

        $this->assertSame($details, $exception->getErrorDetails());
    }
}
