<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomErrorInterface;
use App\Error\ErrorHandlerTrait;
use Throwable;

/**
 * ErrorHandlerTraitTestClass クラス
 *
 * このクラスは ErrorHandlerTrait を使用して例外を処理するための実装例
 * ErrorHandlerTrait のメソッドをテスト用に公開するラッパー機能を提供
 */
class ErrorHandlerTraitTestClass
{
    use ErrorHandlerTrait;

    /**
     * 例外を処理して適切なエラーオブジェクトを返却
     *
     * @param Throwable $exception 処理する例外
     * @return CustomErrorInterface エラー処理後のオブジェクト
     */
    public function publicHandleException(Throwable $exception): CustomErrorInterface
    {
        return $this->handleException($exception);
    }
}
