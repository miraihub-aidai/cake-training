<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\ForbiddenException;
use Cake\TestSuite\TestCase;

class ForbiddenExceptionTest extends TestCase
{
    public function testDefaultConstructor(): void
    {
        $exception = new ForbiddenException();

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame('Forbidden', $exception->getErrorMessage());
        $this->assertSame(403, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessage(): void
    {
        $customMessage = 'Access denied';
        $exception = new ForbiddenException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(403, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'Insufficient permissions';
        $customDetails = ['required_role' => 'admin', 'user_role' => 'user'];
        $exception = new ForbiddenException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(403, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    public function testGetErrorCode(): void
    {
        $exception = new ForbiddenException();

        $this->assertSame(403, $exception->getErrorCode());
    }

    public function testGetErrorMessage(): void
    {
        $customMessage = 'Custom forbidden message';
        $exception = new ForbiddenException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
    }

    public function testGetErrorDetails(): void
    {
        $customDetails = ['reason' => 'Insufficient permissions', 'resource' => 'admin_panel'];
        $exception = new ForbiddenException('Forbidden', $customDetails);

        $this->assertSame($customDetails, $exception->getErrorDetails());
    }
}
