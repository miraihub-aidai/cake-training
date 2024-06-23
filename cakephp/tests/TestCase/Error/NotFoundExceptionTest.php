<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\NotFoundException;
use Cake\TestSuite\TestCase;
use Exception;

/**
 * NotFoundExceptionTest クラス
 *
 * このクラスは NotFoundException クラスの機能をテスト
 */
class NotFoundExceptionTest extends TestCase
{
    /**
     * デフォルトコンストラクタのテスト
     *
     * @return void
     */
    public function testDefaultConstructor(): void
    {
        $exception = new NotFoundException();

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame('Not Found', $exception->getErrorMessage());
        $this->assertSame(404, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージを使用した場合のテスト
     *
     * @return void
     */
    public function testCustomMessage(): void
    {
        $customMessage = 'Resource not found';
        $exception = new NotFoundException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(404, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージと詳細情報を使用した場合のテスト
     *
     * @return void
     */
    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'User not found';
        $customDetails = ['userId' => 123, 'resource' => 'users'];
        $exception = new NotFoundException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(404, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    /**
     * エラーコードの取得をテスト
     *
     * @return void
     */
    public function testGetErrorCode(): void
    {
        $exception = new NotFoundException();

        $this->assertSame(404, $exception->getErrorCode());
    }

    /**
     * エラーメッセージの取得をテスト
     *
     * @return void
     */
    public function testGetErrorMessage(): void
    {
        $customMessage = 'Custom not found message';
        $exception = new NotFoundException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
    }

    /**
     * エラー詳細の取得をテスト
     *
     * @return void
     */
    public function testGetErrorDetails(): void
    {
        $customDetails = ['resource' => 'product', 'id' => 456];
        $exception = new NotFoundException('Product not found', $customDetails);

        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    /**
     * 例外の継承関係をテスト
     *
     * NotFoundExceptionが適切なクラスを継承していることを確認
     *
     * @return void
     */
    public function testExceptionInheritance(): void
    {
        $exception = new NotFoundException();

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
    }
}
