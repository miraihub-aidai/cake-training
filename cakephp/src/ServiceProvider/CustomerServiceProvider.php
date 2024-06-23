<?php
declare(strict_types=1);

namespace App\ServiceProvider;

use App\Domain\Api\CustomerInterface;
use App\Service\CustomerService;
use App\Domain\UseCase\GetCustomer;
use App\Error\ErrorResolver;
use Cake\Core\ContainerInterface;
use Cake\Core\ServiceProvider;

/**
 * CustomerServiceProvider
 * 
 * This service provider is responsible for registering customer-related services
 * and their dependencies in the application's dependency injection container.
 */
class CustomerServiceProvider extends ServiceProvider
{
    /**
     * @var array List of service interfaces and classes provided by this provider
     */
    protected array $provides = [
        CustomerInterface::class,
        GetCustomer::class,
        ErrorResolver::class,
    ];

    /**
     * Register services in the provided container
     *
     * This method configures the dependency injection for customer-related services.
     *
     * @param ContainerInterface $container The DI container to configure
     * @return void
     */
    public function services(ContainerInterface $container): void
    {
        // Register ErrorResolver
        $container->add(ErrorResolver::class);

        // Register CustomerService as an implementation of CustomerInterface
        $container->add(CustomerInterface::class, CustomerService::class)
            ->addArgument(ErrorResolver::class);

        // Register GetCustomer use case
        $container->add(GetCustomer::class)
            ->addArgument(CustomerInterface::class);
    }
}