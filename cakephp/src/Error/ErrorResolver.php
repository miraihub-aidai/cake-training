<?php
declare(strict_types=1);

namespace App\Error;

use ExampleLibraryCustomer\ApiException;

/**
 * ErrorResolver
 *
 * This class is responsible for resolving thrown exceptions into appropriate custom error types.
 */
class ErrorResolver
{
    /**
     * Resolve a thrown exception into a custom error type
     *
     * This method takes a Throwable and converts it into an appropriate CustomErrorInterface instance
     * based on the exception type and properties.
     *
     * @param \Throwable $e The exception to resolve
     * @return CustomErrorInterface The resolved custom error
     */
    public function resolveError(\Throwable $e): CustomErrorInterface
    {
        if ($e instanceof ApiException) {
            $statusCode = $e->getCode();
            $message = $e->getMessage();
            $details = ['responseBody' => $e->getResponseBody()];

            switch ($statusCode) {
                case 400:
                    return new BadRequestException($message, $details);
                case 401:
                    return new UnauthorizedException($message, $details);
                case 403:
                    return new ForbiddenException($message, $details);
                case 404:
                    return new NotFoundException($message, $details);
                case 500:
                    return new InternalServerErrorException($message, $details);
                default:
                    return new GenericApiException($message, $statusCode, $details);
            }
        }

        return new InternalServerErrorException(
            'An unexpected error occurred',
            ['originalMessage' => $e->getMessage()]
        );
    }
}