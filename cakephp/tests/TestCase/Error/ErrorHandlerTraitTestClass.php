<?php
declare(strict_types=1);

namespace App\Test\TestCase\Error;

use App\Error\CustomErrorInterface;
use App\Error\ErrorHandlerTrait;
use Throwable;

class ErrorHandlerTraitTestClass
{
    use ErrorHandlerTrait;

    public function publicHandleException(Throwable $exception): CustomErrorInterface
    {
        return $this->handleException($exception);
    }
}
