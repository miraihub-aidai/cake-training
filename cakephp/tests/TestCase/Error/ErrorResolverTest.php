<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\BadRequestException;
use App\Error\ErrorResolver;
use App\Error\ForbiddenException;
use App\Error\GenericApiException;
use App\Error\InternalServerErrorException;
use App\Error\NotFoundException;
use App\Error\UnauthorizedException;
use Cake\TestSuite\TestCase;
use ExampleLibraryCustomer\ApiException;
use Exception;

class ErrorResolverTest extends TestCase
{
    private ErrorResolver $errorResolver;

    protected function setUp(): void
    {
        parent::setUp();
        $this->errorResolver = new ErrorResolver();
    }

    public function testResolveApiExceptionBadRequest(): void
    {
        $apiException = new ApiException('Bad Request', 400, [], ['error' => 'Invalid input']);
        $result = $this->errorResolver->resolveError($apiException);

        $this->assertInstanceOf(BadRequestException::class, $result);
        $this->assertSame('Bad Request', $result->getErrorMessage());
        $this->assertSame(['responseBody' => ['error' => 'Invalid input']], $result->getErrorDetails());
    }

    public function testResolveApiExceptionUnauthorized(): void
    {
        $apiException = new ApiException('Unauthorized', 401);
        $result = $this->errorResolver->resolveError($apiException);

        $this->assertInstanceOf(UnauthorizedException::class, $result);
        $this->assertSame('Unauthorized', $result->getErrorMessage());
    }

    public function testResolveApiExceptionForbidden(): void
    {
        $apiException = new ApiException('Forbidden', 403);
        $result = $this->errorResolver->resolveError($apiException);

        $this->assertInstanceOf(ForbiddenException::class, $result);
        $this->assertSame('Forbidden', $result->getErrorMessage());
    }

    public function testResolveApiExceptionNotFound(): void
    {
        $apiException = new ApiException('Not Found', 404);
        $result = $this->errorResolver->resolveError($apiException);

        $this->assertInstanceOf(NotFoundException::class, $result);
        $this->assertSame('Not Found', $result->getErrorMessage());
    }

    public function testResolveApiExceptionInternalServerError(): void
    {
        $apiException = new ApiException('Internal Server Error', 500);
        $result = $this->errorResolver->resolveError($apiException);

        $this->assertInstanceOf(InternalServerErrorException::class, $result);
        $this->assertSame('Internal Server Error', $result->getErrorMessage());
    }

    public function testResolveApiExceptionOtherStatusCode(): void
    {
        $apiException = new ApiException('Service Unavailable', 503);
        $result = $this->errorResolver->resolveError($apiException);

        $this->assertInstanceOf(GenericApiException::class, $result);
        $this->assertSame('Service Unavailable', $result->getErrorMessage());
        $this->assertSame(503, $result->getErrorCode());
    }

    public function testResolveNonApiException(): void
    {
        $exception = new Exception('Unexpected Error');
        $result = $this->errorResolver->resolveError($exception);

        $this->assertInstanceOf(InternalServerErrorException::class, $result);
        $this->assertSame('An unexpected error occurred', $result->getErrorMessage());
        $this->assertSame(['originalMessage' => 'Unexpected Error'], $result->getErrorDetails());
    }
}
