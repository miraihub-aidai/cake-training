<?php
declare(strict_types=1);

namespace App\Domain\Api;

/**
 * CustomerInterface
 *
 * This interface defines the contract for customer-related API operations.
 */
interface CustomerInterface
{
    /**
     * Get customer information
     *
     * This method should retrieve customer data from the API.
     *
     * @return mixed The customer data. The exact return type should be specified in the implementing class.
     * @throws \Exception If there's an error retrieving the customer data.
     */
    public function get();
}