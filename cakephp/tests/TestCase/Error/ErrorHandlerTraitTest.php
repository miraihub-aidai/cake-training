<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\ApiError;
use App\Error\CustomErrorInterface;
use App\Error\GenericError;
use Cake\TestSuite\TestCase;
use ExampleLibraryCustomer\ApiException;
use Exception;

class ErrorHandlerTraitTest extends TestCase
{
    private ErrorHandlerTraitTestClass $errorHandler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->errorHandler = new ErrorHandlerTraitTestClass();
    }

    public function testHandleApiException(): void
    {
        $responseBody = ['error' => 'Bad Request'];
        $apiException = new ApiException('API Error', 400, [], $responseBody);

        $result = $this->errorHandler->publicHandleException($apiException);

        $this->assertInstanceOf(ApiError::class, $result);
        $this->assertInstanceOf(CustomErrorInterface::class, $result);
        $this->assertSame(400, $result->getErrorCode());
        $this->assertSame('API Error', $result->getErrorMessage());
        $this->assertSame($responseBody, $result->getErrorDetails());
    }

    public function testHandleGenericException(): void
    {
        $exception = new Exception('Unexpected Error', 0);

        $result = $this->errorHandler->publicHandleException($exception);

        $this->assertInstanceOf(GenericError::class, $result);
        $this->assertInstanceOf(CustomErrorInterface::class, $result);
        $this->assertSame(500, $result->getErrorCode());
        $this->assertSame('An unexpected error occurred', $result->getErrorMessage());
        $this->assertSame(['details' => 'Unexpected Error'], $result->getErrorDetails());
    }

    public function testHandleExceptionWithCustomCode(): void
    {
        $exception = new Exception('Custom Error', 503);

        $result = $this->errorHandler->publicHandleException($exception);

        $this->assertInstanceOf(GenericError::class, $result);
        $this->assertSame(500, $result->getErrorCode());
        $this->assertSame('An unexpected error occurred', $result->getErrorMessage());
        $this->assertSame(['details' => 'Custom Error'], $result->getErrorDetails());
    }
}
