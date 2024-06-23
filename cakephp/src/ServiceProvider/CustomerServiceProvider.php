<?php
declare(strict_types=1);

namespace App\ServiceProvider;

use App\Domain\Api\CustomerInterface;
use App\Service\CustomerService;
use App\Domain\UseCase\GetCustomer;
use App\Error\ErrorResolver;
use Cake\Core\ContainerInterface;
use Cake\Core\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    protected array $provides = [
        CustomerInterface::class,
        GetCustomer::class,
        ErrorResolver::class,
    ];

    public function services(ContainerInterface $container): void
    {
        $container->add(ErrorResolver::class);
        $container->add(CustomerInterface::class, CustomerService::class)
            ->addArgument(ErrorResolver::class);
        $container->add(GetCustomer::class)
            ->addArgument(CustomerInterface::class);
    }
}