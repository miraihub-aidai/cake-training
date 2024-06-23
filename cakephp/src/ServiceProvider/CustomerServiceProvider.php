<?php
declare(strict_types=1);

namespace App\ServiceProvider;

use App\Domain\Api\CustomerInterface;
use App\Service\CustomerService;
use App\Domain\UseCase\GetCustomer;
use Cake\Core\ContainerInterface;
use Cake\Core\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    protected array $provides = [
        CustomerInterface::class,
        GetCustomer::class,
    ];

    public function services(ContainerInterface $container): void
    {
        $container->add(CustomerInterface::class, CustomerService::class);
        $container->add(GetCustomer::class)
            ->addArgument(CustomerInterface::class);
    }
}