<?php
declare(strict_types=1);

namespace App\Service;

use App\Domain\Api\CustomerInterface;

class CustomerService implements CustomerInterface
{
    public function execute()
    {
        return "Hello World";
    }
}