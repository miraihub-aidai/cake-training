<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\ForbiddenException;
use Cake\TestSuite\TestCase;

/**
 * ForbiddenExceptionTest クラス
 *
 * このテストクラスは ForbiddenException の機能を検証する
 * それぞれのテストは、例外が適切に初期化され、期待される属性を持つかを確認
 */
class ForbiddenExceptionTest extends TestCase
{
    /**
     * デフォルトコンストラクタのテスト
     *
     * ForbiddenException がデフォルト値で正しく初期化されるかを確認
     *
     * @return void
     */
    public function testDefaultConstructor(): void
    {
        $exception = new ForbiddenException();

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame('Forbidden', $exception->getErrorMessage());
        $this->assertSame(403, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージでの例外のテスト
     *
     * カスタムメッセージを持つ ForbiddenException が正しく機能するかを検証
     *
     * @return void
     */
    public function testCustomMessage(): void
    {
        $customMessage = 'Access denied';
        $exception = new ForbiddenException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(403, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージと詳細情報を持つ例外のテスト
     *
     * メッセージと詳細情報をカスタマイズした ForbiddenException の挙動を確認
     *
     * @return void
     */
    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'Insufficient permissions';
        $customDetails = ['required_role' => 'admin', 'user_role' => 'user'];
        $exception = new ForbiddenException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(403, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    /**
     * エラーコードの取得テスト
     *
     * ForbiddenException が適切なエラーコードを返すかを検証
     *
     * @return void
     */
    public function testGetErrorCode(): void
    {
        $exception = new ForbiddenException();

        $this->assertSame(403, $exception->getErrorCode());
    }

    /**
     * エラーメッセージの取得テスト
     *
     * カスタムメッセージを持つ ForbiddenException が正しいメッセージを返すかを確認
     *
     * @return void
     */
    public function testGetErrorMessage(): void
    {
        $customMessage = 'Custom forbidden message';
        $exception = new ForbiddenException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
    }

    /**
     * エラー詳細情報の取得テスト
     *
     * 詳細情報を持つ ForbiddenException がそれを正しく返すかを検証
     *
     * @return void
     */
    public function testGetErrorDetails(): void
    {
        $customDetails = ['reason' => 'Insufficient permissions', 'resource' => 'admin_panel'];
        $exception = new ForbiddenException('Forbidden', $customDetails);

        $this->assertSame($customDetails, $exception->getErrorDetails());
    }
}
