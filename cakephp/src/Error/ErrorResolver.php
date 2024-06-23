<?php
declare(strict_types=1);

namespace App\Error;

use ExampleLibraryCustomer\ApiException;

class ErrorResolver
{
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