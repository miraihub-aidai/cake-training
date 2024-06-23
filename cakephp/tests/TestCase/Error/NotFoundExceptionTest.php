<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\NotFoundException;
use Cake\TestSuite\TestCase;
use Exception;

class NotFoundExceptionTest extends TestCase
{
    public function testDefaultConstructor(): void
    {
        $exception = new NotFoundException();

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame('Not Found', $exception->getErrorMessage());
        $this->assertSame(404, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessage(): void
    {
        $customMessage = 'Resource not found';
        $exception = new NotFoundException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(404, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'User not found';
        $customDetails = ['userId' => 123, 'resource' => 'users'];
        $exception = new NotFoundException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(404, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    public function testGetErrorCode(): void
    {
        $exception = new NotFoundException();

        $this->assertSame(404, $exception->getErrorCode());
    }

    public function testGetErrorMessage(): void
    {
        $customMessage = 'Custom not found message';
        $exception = new NotFoundException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
    }

    public function testGetErrorDetails(): void
    {
        $customDetails = ['resource' => 'product', 'id' => 456];
        $exception = new NotFoundException('Product not found', $customDetails);

        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    public function testExceptionInheritance(): void
    {
        $exception = new NotFoundException();

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
    }
}
