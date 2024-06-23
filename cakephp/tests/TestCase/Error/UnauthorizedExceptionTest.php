<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\UnauthorizedException;
use Cake\TestSuite\TestCase;
use Exception;

class UnauthorizedExceptionTest extends TestCase
{
    public function testDefaultConstructor(): void
    {
        $exception = new UnauthorizedException();

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame('Unauthorized', $exception->getErrorMessage());
        $this->assertSame(401, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessage(): void
    {
        $customMessage = 'Authentication required';
        $exception = new UnauthorizedException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(401, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'Invalid credentials';
        $customDetails = ['reason' => 'expired_token', 'expired_at' => '2023-06-23T12:00:00Z'];
        $exception = new UnauthorizedException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(401, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    public function testGetErrorCode(): void
    {
        $exception = new UnauthorizedException();

        $this->assertSame(401, $exception->getErrorCode());
    }

    public function testGetErrorMessage(): void
    {
        $customMessage = 'Custom unauthorized message';
        $exception = new UnauthorizedException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
    }

    public function testGetErrorDetails(): void
    {
        $customDetails = ['required_scopes' => ['read', 'write'], 'provided_scopes' => ['read']];
        $exception = new UnauthorizedException('Insufficient scopes', $customDetails);

        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    public function testExceptionInheritance(): void
    {
        $exception = new UnauthorizedException();

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
    }

    public function testEmptyDetails(): void
    {
        $exception = new UnauthorizedException('Unauthorized', []);

        $this->assertSame([], $exception->getErrorDetails());
    }

    public function testLongErrorMessage(): void
    {
        $longMessage = str_repeat('a', 1000);
        $exception = new UnauthorizedException($longMessage);

        $this->assertSame($longMessage, $exception->getErrorMessage());
        $this->assertSame($longMessage, $exception->getErrorMessage());
    }
}
