<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;
use App\Error\GenericApiException;
use Cake\TestSuite\TestCase;

/**
 * GenericApiExceptionTest クラス
 *
 * このテストクラスは GenericApiException の挙動を検証
 * 様々なシナリオで例外が正しく機能するかをテスト
 */
class GenericApiExceptionTest extends TestCase
{
    /**
     * メッセージとエラーコードを指定して例外を生成するテスト
     *
     * GenericApiException が指定されたメッセージとコードで正しく初期化されるか確認
     *
     * @return void
     */
    public function testConstructorWithMessageAndCode(): void
    {
        $message = 'Generic API Error';
        $code = 418; // I'm a teapot
        $exception = new GenericApiException($message, $code);

        $this->assertInstanceOf(CustomApiException::class, $exception);
        $this->assertSame($message, $exception->getErrorMessage());
        $this->assertSame($code, $exception->getErrorCode());
        $this->assertSame([], $exception->getErrorDetails());
    }

    /**
     * メッセージ、エラーコード、詳細情報を指定して例外を生成するテスト
     *
     * GenericApiException が詳細情報を含む形で適切に初期化されることを確認
     *
     * @return void
     */
    public function testConstructorWithMessageCodeAndDetails(): void
    {
        $message = 'Specific API Error';
        $code = 422; // Unprocessable Entity
        $details = ['field' => 'email', 'error' => 'Invalid format'];
        $exception = new GenericApiException($message, $code, $details);

        $this->assertSame($message, $exception->getErrorMessage());
        $this->assertSame($code, $exception->getErrorCode());
        $this->assertSame($details, $exception->getErrorDetails());
    }

    /**
     * エラーコードの取得テスト
     *
     * GenericApiException が正しいエラーコードを返すか検証
     *
     * @return void
     */
    public function testGetErrorCode(): void
    {
        $code = 429; // Too Many Requests
        $exception = new GenericApiException('Rate limit exceeded', $code);

        $this->assertSame($code, $exception->getErrorCode());
    }

    /**
     * エラーメッセージの取得テスト
     *
     * カスタムメッセージを持つ GenericApiException が正しいメッセージを返すか確認
     *
     * @return void
     */
    public function testGetErrorMessage(): void
    {
        $message = 'Custom error message';
        $exception = new GenericApiException($message, 400);

        $this->assertSame($message, $exception->getErrorMessage());
    }

    /**
     * エラー詳細情報の取得テスト
     *
     * 詳細情報を持つ GenericApiException がそれを正しく返すか検証
     *
     * @return void
     */
    public function testGetErrorDetails(): void
    {
        $details = ['reason' => 'Maintenance', 'retry_after' => '3600'];
        $exception = new GenericApiException('Service Unavailable', 503, $details);

        $this->assertSame($details, $exception->getErrorDetails());
    }

    /**
     * 様々なエラーコードでの例外生成テスト
     *
     * 複数の異なるエラーコードを持つ GenericApiException を生成し、
     * それぞれが正しいエラーコードを持つかを確認
     *
     * @return void
     */
    public function testDifferentErrorCodes(): void
    {
        $codes = [400, 401, 403, 404, 405, 406, 409, 415, 422, 429, 500, 501, 503];

        foreach ($codes as $code) {
            $exception = new GenericApiException("Error {$code}", $code);
            $this->assertSame($code, $exception->getErrorCode());
        }
    }
}
