<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\ApiError;
use App\Error\CustomErrorInterface;
use App\Error\GenericError;
use Cake\TestSuite\TestCase;
use ExampleLibraryCustomer\ApiException;
use Exception;

/**
 * ErrorHandlerTraitTest クラス
 *
 * このクラスは ErrorHandlerTrait の振る舞いをテストするためのものです。
 */
class ErrorHandlerTraitTest extends TestCase
{
    /**
     * @var ErrorHandlerTraitTestClass エラーハンドラーのテスト用クラスのインスタンス
     */
    private ErrorHandlerTraitTestClass $errorHandler;

    /**
     * テストの設定を行います。
     * ErrorHandlerTraitTestClass のインスタンスを初期化します。
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->errorHandler = new ErrorHandlerTraitTestClass();
    }

    /**
     * ApiException を処理するテスト。
     *
     * APIエラーを処理して適切な ApiError インスタンスが生成されるかを検証します。
     *
     * @return void
     */
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

    /**
     * 一般的な例外を処理するテスト。
     *
     * 予期せぬ例外が GenericError として適切に処理されるかを確認します。
     *
     * @return void
     */
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

    /**
     * カスタムコードを持つ例外を処理するテスト。
     *
     * カスタムエラーコードを持つ例外が適切に GenericError として処理されるかを検証します。
     *
     * @return void
     */
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
