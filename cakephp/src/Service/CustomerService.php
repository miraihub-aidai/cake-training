<?php
declare(strict_types=1);

namespace App\Service;

use App\Domain\Api\CustomerInterface;
use App\Error\ErrorResolver;
use ExampleLibraryCustomer\Api\DefaultApi;
use ExampleLibraryCustomer\Configuration;
use GuzzleHttp\Client;

/**
 * CustomerService
 * 
 * This service implements the CustomerInterface and handles customer-related operations.
 */
class CustomerService implements CustomerInterface
{
    /**
     * @var DefaultApi The API instance for customer operations
     */
    private DefaultApi $apiInstance;

    /**
     * @var ErrorResolver The error resolver for handling exceptions
     */
    private ErrorResolver $errorResolver;

    /**
     * Constructor
     *
     * @param ErrorResolver $errorResolver The error resolver instance
     */
    public function __construct(ErrorResolver $errorResolver)
    {
        $config = new Configuration();
        $config->setHost('http://host.docker.internal:8081');

        $clientConfig = [
            'base_uri' => $config->getHost(),
            'connect_timeout' => 10,
            'timeout' => 30,
        ];
        $client = new Client($clientConfig);

        $this->apiInstance = new DefaultApi($client, $config);
        $this->errorResolver = $errorResolver;
    }

    /**
     * Get customers
     *
     * Retrieves a list of customers from the API and formats the data.
     *
     * @return array An array of formatted customer data
     * @throws \App\Error\CustomApiException When an error occurs during the API call
     */
    public function get(): array
    {
        try {
            $customers = $this->apiInstance->customerGet();
            
            return array_map(function (\ExampleLibraryCustomer\Model\Customer $customer) {
                $createdAt = $customer->getCreatedAt();
                $createdAtFormatted = $createdAt instanceof \DateTime ? $createdAt->format('Y-m-d\TH:i:s\Z') : null;
                
                return [
                    'id' => $customer->getId(),
                    'name' => $customer->getName(),
                    'email' => $customer->getEmail(),
                    'phone' => $customer->getPhone(),
                    'createdAt' => $createdAtFormatted,
                ];
            }, $customers);
        } catch (\Throwable $e) {
            throw $this->errorResolver->resolveError($e);
        }
    }
}