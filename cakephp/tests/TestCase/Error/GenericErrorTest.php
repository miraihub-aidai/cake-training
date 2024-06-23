<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomErrorInterface;
use App\Error\GenericError;
use Cake\TestSuite\TestCase;

class GenericErrorTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $code = 500;
        $message = 'Internal Server Error';
        $details = ['file' => 'example.php', 'line' => 42];

        $error = new GenericError($code, $message, $details);

        $this->assertInstanceOf(CustomErrorInterface::class, $error);
        $this->assertSame($code, $error->getErrorCode());
        $this->assertSame($message, $error->getErrorMessage());
        $this->assertSame($details, $error->getErrorDetails());
    }

    public function testConstructorWithoutDetails(): void
    {
        $code = 404;
        $message = 'Not Found';

        $error = new GenericError($code, $message);

        $this->assertSame($code, $error->getErrorCode());
        $this->assertSame($message, $error->getErrorMessage());
        $this->assertNull($error->getErrorDetails());
    }

    public function testConstructorWithNullDetails(): void
    {
        $code = 400;
        $message = 'Bad Request';

        $error = new GenericError($code, $message, null);

        $this->assertSame($code, $error->getErrorCode());
        $this->assertSame($message, $error->getErrorMessage());
        $this->assertNull($error->getErrorDetails());
    }

    public function testConstructorWithEmptyDetails(): void
    {
        $code = 403;
        $message = 'Forbidden';
        $details = [];

        $error = new GenericError($code, $message, $details);

        $this->assertSame($code, $error->getErrorCode());
        $this->assertSame($message, $error->getErrorMessage());
        $this->assertSame($details, $error->getErrorDetails());
    }

    public function testDifferentErrorCodes(): void
    {
        $codes = [400, 401, 403, 404, 405, 406, 409, 415, 422, 429, 500, 501, 503];

        foreach ($codes as $code) {
            $error = new GenericError($code, "Error {$code}");
            $this->assertSame($code, $error->getErrorCode());
        }
    }

    public function testLongErrorMessage(): void
    {
        $longMessage = str_repeat('a', 1000);
        $error = new GenericError(500, $longMessage);

        $this->assertSame($longMessage, $error->getErrorMessage());
    }

    public function testComplexErrorDetails(): void
    {
        $complexDetails = [
            'errors' => [
                ['field' => 'email', 'message' => 'Invalid format'],
                ['field' => 'password', 'message' => 'Too short'],
            ],
            'requestId' => 'abc123',
            'timestamp' => time(),
        ];

        $error = new GenericError(422, 'Validation Error', $complexDetails);

        $this->assertSame($complexDetails, $error->getErrorDetails());
    }
}
