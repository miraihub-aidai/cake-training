<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\CustomErrorInterface;
use Cake\TestSuite\TestCase;
use Exception;

/**
 * CustomApiExceptionTest クラス
 *
 * ConcreteCustomApiException の機能をテスト
 * CustomApiException を拡張し、CustomErrorInterface を実装
 * テストケースは、例外メッセージ、コード、および追加の詳細の処理を検証
 */
class CustomApiExceptionTest extends TestCase
{
    /**
     * 例外のコンストラクターとゲッターをテスト
     *
     * コンストラクターが内部状態を正しく設定していることを検証
     *
     * @return void
     */
    public function testConstructorAndGetters(): void
    {
        $message = 'Test error message';
        $code = 500;
        $details = ['key' => 'value'];

        $exception = new ConcreteCustomApiException($message, $code, $details);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($code, $exception->getCode());
        $this->assertSame($details, $exception->getErrorDetails());
    }

    /**
     * エラーコードゲッターをテストします。
     *
     * 正しいエラーコードが例外から返されることを検証
     *
     * @return void
     */
    public function testErrorCodeGetter(): void
    {
        $exception = new ConcreteCustomApiException('Test', 404);

        $this->assertSame(404, $exception->getErrorCode());
    }

    /**
     * エラーメッセージのゲッターをテスト
     *
     * エラーメッセージが例外から正しく取得されることを検証
     *
     * @return void
     */
    public function testErrorMessageGetter(): void
    {
        $message = 'Custom error message';
        $exception = new ConcreteCustomApiException($message, 400);

        $this->assertSame($message, $exception->getErrorMessage());
    }

    /**
     * デフォルトのエラー詳細をテスト
     *
     * 何も指定されていない場合、デフォルトのエラー詳細が空の配列であることを確認
     *
     * @return void
     */
    public function testDefaultDetails(): void
    {
        $exception = new ConcreteCustomApiException('Test', 500);

        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * 例外の継承をテスト
     *
     * ConcreteCustomApiException が必要な例外クラスのインスタンスであることを確認
     *
     * @return void
     */
    public function testExceptionInheritance(): void
    {
        $exception = new ConcreteCustomApiException('Test', 500);

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertInstanceOf(CustomErrorInterface::class, $exception);
    }

    /**
     * カスタム詳細へのアクセスをテスト
     *
     * 例外に渡されたカスタム詳細が正しく保存され、取得可能であることを確認
     *
     * @return void
     */
    public function testCustomDetailsAccess(): void
    {
        $details = ['error' => 'Not found', 'id' => 123];
        $exception = new ConcreteCustomApiException('Test', 404, $details);

        $this->assertSame($details, $exception->getErrorDetails());
    }
}
