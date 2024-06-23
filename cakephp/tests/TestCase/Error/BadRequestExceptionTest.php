<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\BadRequestException;
use App\Error\CustomApiException;
use Cake\TestSuite\TestCase;
use Exception;

class BadRequestExceptionTest extends TestCase
{
    public function testDefaultConstructor(): void
    {
        $exception = new BadRequestException();

        $this->assertSame('Bad Request', $exception->getErrorMessage());
        $this->assertSame(400, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessage(): void
    {
        $customMessage = 'Invalid input data';
        $exception = new BadRequestException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(400, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'Missing required fields';
        $customDetails = ['fields' => ['name', 'email']];
        $exception = new BadRequestException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(400, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    public function testExceptionInheritance(): void
    {
        $exception = new BadRequestException();

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
    }

    public function testCodeIsAlways400(): void
    {
        $exception1 = new BadRequestException();
        $exception2 = new BadRequestException('Custom message');
        $exception3 = new BadRequestException('Another message', ['detail' => 'value']);

        $this->assertSame(400, $exception1->getErrorCode());
        $this->assertSame(400, $exception2->getErrorCode());
        $this->assertSame(400, $exception3->getErrorCode());
    }
}
