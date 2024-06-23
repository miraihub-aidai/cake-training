<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\InternalServerErrorException;
use Cake\TestSuite\TestCase;
use Exception;

/**
 * InternalServerErrorExceptionTest クラス
 *
 * InternalServerErrorException クラスのテストを行うためのテストケースクラス
 */
class InternalServerErrorExceptionTest extends TestCase
{
    /**
     * デフォルトコンストラクタのテスト
     *
     * @return void
     */
    public function testDefaultConstructor(): void
    {
        $exception = new InternalServerErrorException();

        $this->assertSame('Internal Server Error', $exception->getErrorMessage());
        $this->assertSame(500, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージを使用した場合のテスト
     *
     * @return void
     */
    public function testCustomMessage(): void
    {
        $customMessage = 'Custom Internal Server Error';
        $exception = new InternalServerErrorException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(500, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージと詳細情報を使用した場合のテスト
     *
     * @return void
     */
    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'Custom Internal Server Error';
        $customDetails = ['error_code' => 'ERR001', 'timestamp' => '2023-06-23T12:34:56Z'];
        $exception = new InternalServerErrorException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(500, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    /**
     * 例外の継承関係をテスト
     *
     * InternalServerErrorException が適切なクラスを継承しているかを確認します
     *
     * @return void
     */
    public function testExceptionInheritance(): void
    {
        $exception = new InternalServerErrorException();

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
    }
}
