<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\ApiError;
use App\Error\CustomErrorInterface;
use Cake\TestSuite\TestCase;

class ApiErrorTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $code = 404;
        $message = 'Not Found';
        $details = ['resource' => 'user', 'id' => 123];

        $apiError = new ApiError($code, $message, $details);

        $this->assertSame($code, $apiError->getErrorCode());
        $this->assertSame($message, $apiError->getErrorMessage());
        $this->assertSame($details, $apiError->getErrorDetails());
    }

    public function testConstructorWithoutDetails(): void
    {
        $code = 400;
        $message = 'Bad Request';

        $apiError = new ApiError($code, $message);

        $this->assertSame($code, $apiError->getErrorCode());
        $this->assertSame($message, $apiError->getErrorMessage());
        $this->assertNull($apiError->getErrorDetails());
    }

    public function testImplementsCustomErrorInterface(): void
    {
        $apiError = new ApiError(500, 'Internal Server Error');

        $this->assertInstanceOf(CustomErrorInterface::class, $apiError);
    }

    public function testConstructorWithEmptyDetails(): void
    {
        $code = 403;
        $message = 'Forbidden';
        $details = [];

        $apiError = new ApiError($code, $message, $details);

        $this->assertSame($code, $apiError->getErrorCode());
        $this->assertSame($message, $apiError->getErrorMessage());
        $this->assertSame($details, $apiError->getErrorDetails());
    }

    public function testConstructorWithNullDetails(): void
    {
        $code = 401;
        $message = 'Unauthorized';

        $apiError = new ApiError($code, $message, null);

        $this->assertSame($code, $apiError->getErrorCode());
        $this->assertSame($message, $apiError->getErrorMessage());
        $this->assertNull($apiError->getErrorDetails());
    }
}
