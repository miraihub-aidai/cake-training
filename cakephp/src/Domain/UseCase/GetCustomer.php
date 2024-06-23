<?php
declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Api\CustomerInterface;

/**
 * GetCustomer UseCase
 *
 * This class represents the use case for retrieving customers.
 */
class GetCustomer
{
    /**
     * @var \App\Domain\Api\CustomerInterface The customer service
     */
    private CustomerInterface $customerService;

    /**
     * Constructor
     *
     * @param \App\Domain\Api\CustomerInterface $customerService The customer service implementation
     */
    public function __construct(CustomerInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Invoke the use case
     *
     * Retrieves customers using the customer service.
     *
     * @return array<int, array<string, mixed>> An array of customer data
     */
    public function __invoke(): array
    {
        return $this->customerService->get();
    }
}
