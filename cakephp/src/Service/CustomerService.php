<?php
declare(strict_types=1);

namespace App\Service;

use App\Domain\Api\CustomerInterface;
use ExampleLibraryCustomer\Api\DefaultApi;
use ExampleLibraryCustomer\Configuration;
use ExampleLibraryCustomer\ApiException;
use GuzzleHttp\Client;

class CustomerService implements CustomerInterface
{
    private DefaultApi $apiInstance;

    public function __construct()
    {
        $config = new Configuration();
        $config->setHost('http://host.docker.internal:8081'); // APIのベースURLを設定

        $clientConfig = [
            'base_uri' => $config->getHost(),
            'connect_timeout' => 10,
            'timeout' => 30,
        ];
        $client = new Client($clientConfig);

        $this->apiInstance = new DefaultApi($client, $config);
    }

    public function get(): array
    {
        try {
            $customers = $this->apiInstance->customerGet();
            
            return array_map(function (\ExampleLibraryCustomer\Model\Customer $customer) {
                $createdAt = $customer->getCreatedAt();
                if ($createdAt instanceof \DateTime) {
                    $createdAtFormatted = $createdAt->format('Y-m-d\TH:i:s\Z');
                } else {
                    $createdAtFormatted = null;
                }
                
                return [
                    'id' => $customer->getId(),
                    'name' => $customer->getName(),
                    'email' => $customer->getEmail(),
                    'phone' => $customer->getPhone(),
                    'createdAt' => $createdAtFormatted,
                ];
            }, $customers);
        } catch (ApiException $e) {
            throw new \RuntimeException('API Exception: ' . $e->getMessage(), 0, $e);
        }
    }
}