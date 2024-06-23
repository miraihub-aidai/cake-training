<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\ApiError;
use App\Error\CustomErrorInterface;
use Cake\TestSuite\TestCase;

/**
 * ApiErrorTest class
 */
class ApiErrorTest extends TestCase
{
    /**
     * ApiError のコンストラクターとゲッターをテスト
     */
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

    /**
     * 詳細を指定せずにコンストラクターをテスト
     */
    public function testConstructorWithoutDetails(): void
    {
        $code = 400;
        $message = 'Bad Request';

        $apiError = new ApiError($code, $message);

        $this->assertSame($code, $apiError->getErrorCode());
        $this->assertSame($message, $apiError->getErrorMessage());
        $this->assertNull($apiError->getErrorDetails());
    }

    /**
     * ApiError が CustomErrorInterface を実装しているかどうかをテスト
     */
    public function testImplementsCustomErrorInterface(): void
    {
        $apiError = new ApiError(500, 'Internal Server Error');

        $this->assertInstanceOf(CustomErrorInterface::class, $apiError);
    }

    /**
     * 空の詳細を使用してコンストラクターをテスト
     */
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

    /**
     * 詳細が null のコンストラクターをテスト
     */
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
