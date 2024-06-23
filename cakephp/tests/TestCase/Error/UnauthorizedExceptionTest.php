<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\UnauthorizedException;
use Cake\TestSuite\TestCase;
use Exception;

/**
 * UnauthorizedExceptionTest クラス
 *
 * UnauthorizedException クラスのテストケースを含むクラス
 */
class UnauthorizedExceptionTest extends TestCase
{
    /**
     * デフォルトコンストラクタのテスト
     *
     * @return void
     */
    public function testDefaultConstructor(): void
    {
        $exception = new UnauthorizedException();

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame('Unauthorized', $exception->getErrorMessage());
        $this->assertSame(401, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージのテスト
     *
     * @return void
     */
    public function testCustomMessage(): void
    {
        $customMessage = 'Authentication required';
        $exception = new UnauthorizedException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(401, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージと詳細情報のテスト
     *
     * @return void
     */
    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'Invalid credentials';
        $customDetails = ['reason' => 'expired_token', 'expired_at' => '2023-06-23T12:00:00Z'];
        $exception = new UnauthorizedException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(401, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    /**
     * エラーコードの取得テスト
     *
     * @return void
     */
    public function testGetErrorCode(): void
    {
        $exception = new UnauthorizedException();

        $this->assertSame(401, $exception->getErrorCode());
    }

    /**
     * エラーメッセージの取得テスト
     *
     * @return void
     */
    public function testGetErrorMessage(): void
    {
        $customMessage = 'Custom unauthorized message';
        $exception = new UnauthorizedException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
    }

    /**
     * エラー詳細の取得テスト
     *
     * @return void
     */
    public function testGetErrorDetails(): void
    {
        $customDetails = ['required_scopes' => ['read', 'write'], 'provided_scopes' => ['read']];
        $exception = new UnauthorizedException('Insufficient scopes', $customDetails);

        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    /**
     * 例外の継承関係のテスト
     *
     * @return void
     */
    public function testExceptionInheritance(): void
    {
        $exception = new UnauthorizedException();

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
    }

    /**
     * 空の詳細情報のテスト
     *
     * @return void
     */
    public function testEmptyDetails(): void
    {
        $exception = new UnauthorizedException('Unauthorized', []);

        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * 長いエラーメッセージのテスト
     *
     * このテストでは、1000文字の長いメッセージが正しく処理されることを確認
     *
     * @return void
     */
    public function testLongErrorMessage(): void
    {
        $longMessage = str_repeat('a', 1000);
        $exception = new UnauthorizedException($longMessage);

        $this->assertSame($longMessage, $exception->getErrorMessage());
        $this->assertSame($longMessage, $exception->getErrorMessage());
    }
}
