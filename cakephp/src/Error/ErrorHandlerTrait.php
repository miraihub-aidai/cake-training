<?php
namespace App\Error;

use Throwable;

trait ErrorHandlerTrait
{
    protected function handleException(Throwable $exception): CustomErrorInterface
    {
        if ($exception instanceof \ExampleLibraryCustomer\ApiException) {
            return new ApiError(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getResponseBody()
            );
        }

        return new GenericError(
            500,
            'An unexpected error occurred',
            ['details' => $exception->getMessage()]
        );
    }
}