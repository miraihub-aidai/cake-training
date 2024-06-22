<?php
declare(strict_types=1);

namespace App\ServiceProvider;

use App\Domain\Api\CustomerInterface;
use App\Service\CustomerService;
use Cake\Core\ContainerInterface;
use Cake\Core\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    protected $provides = [
        CustomerInterface::class,
	];

    public function services(ContainerInterface $container): void
    {
        $container->add(CustomerInterface::class, CustomerService::class);
    }
}
