<?php
declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Api\CustomerInterface;

class GetCustomer
{
    private CustomerInterface $customerService;

    public function __construct(CustomerInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function __invoke(): array
    {
        return $this->customerService->get();
    }
}