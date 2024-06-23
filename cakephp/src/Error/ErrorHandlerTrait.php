<?php
namespace App\Error;

use Throwable;

/**
 * ErrorHandlerTrait
 *
 * This trait provides a common method for handling exceptions and converting them
 * into CustomErrorInterface objects.
 */
trait ErrorHandlerTrait
{
    /**
     * Handle an exception and convert it to a CustomErrorInterface object
     *
     * This method takes a Throwable object and converts it into an appropriate
     * CustomErrorInterface implementation based on the exception type.
     *
     * @param Throwable $exception The exception to handle
     * @return CustomErrorInterface The resulting error object
     */
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