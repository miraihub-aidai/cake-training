<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomApiException;

/**
 * ConcreteCustomApiException class
 *
 * 追加の変更を加えていない CustomApiException の実装
 * APIエラーをテストまたは処理するために使用
 */
class ConcreteCustomApiException extends CustomApiException
{
    // この具体的な実装は空でOK
}
