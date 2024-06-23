<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\BadRequestException;
use App\Error\CustomApiException;
use Cake\TestSuite\TestCase;
use Exception;

/**
 * BadRequestExceptionTest class
 */
class BadRequestExceptionTest extends TestCase
{
    /**
     * BadRequestException のデフォルトのコンストラクターをテスト
     *
     * @return void
     */
    public function testDefaultConstructor(): void
    {
        $exception = new BadRequestException();

        $this->assertSame('Bad Request', $exception->getErrorMessage());
        $this->assertSame(400, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージを使用して BadRequestException をテスト
     *
     * @return void
     */
    public function testCustomMessage(): void
    {
        $customMessage = 'Invalid input data';
        $exception = new BadRequestException($customMessage);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(400, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * カスタムメッセージと詳細を使用して BadRequestException をテスト
     *
     * @return void
     */
    public function testCustomMessageAndDetails(): void
    {
        $customMessage = 'Missing required fields';
        $customDetails = ['fields' => ['name', 'email']];
        $exception = new BadRequestException($customMessage, $customDetails);

        $this->assertSame($customMessage, $exception->getErrorMessage());
        $this->assertSame(400, $exception->getErrorCode());
        $this->assertSame($customDetails, $exception->getErrorDetails());
    }

    /**
     * BadRequestException が正しい親クラスを拡張するかどうかをテスト
     *
     * @return void
     */
    public function testExceptionInheritance(): void
    {
        $exception = new BadRequestException();

        $this->assertInstanceOf(Exception::class, $exception);
        $this->assertInstanceOf(CustomApiException::class, $exception);
    }

    /**
     * BadRequestException のエラー コードが常に 400 であるかどうかをテスト
     *
     * @return void
     */
    public function testCodeIsAlways400(): void
    {
        $exception1 = new BadRequestException();
        $exception2 = new BadRequestException('Custom message');
        $exception3 = new BadRequestException('Another message', ['detail' => 'value']);

        $this->assertSame(400, $exception1->getErrorCode());
        $this->assertSame(400, $exception2->getErrorCode());
        $this->assertSame(400, $exception3->getErrorCode());
    }
}
