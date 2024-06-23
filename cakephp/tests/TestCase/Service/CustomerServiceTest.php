<?php
declare(strict_types=1);

namespace Tests\TestCase\Service;

use App\Error\ErrorResolver;
use App\Service\CustomerService;
use DateTime;
use ExampleLibraryCustomer\Api\DefaultApi;
use ExampleLibraryCustomer\Model\Customer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class CustomerServiceTest extends TestCase
{
    private CustomerService $customerService;
    private DefaultApi|MockObject $mockApiInstance;
    private ErrorResolver|MockObject $mockErrorResolver;

    protected function setUp(): void
    {
        $this->mockApiInstance = $this->createMock(DefaultApi::class);
        $this->mockErrorResolver = $this->createMock(ErrorResolver::class);

        $this->customerService = new CustomerService($this->mockErrorResolver);
        $this->setPrivateProperty($this->customerService, 'apiInstance', $this->mockApiInstance);
    }

    public function testGetCustomersSuccess(): void
    {
        $customer1 = $this->createCustomerMock(1, 'John Doe', 'john@example.com', '1234567890', new DateTime('2023-01-01T00:00:00Z'));
        $customer2 = $this->createCustomerMock(2, 'Jane Smith', 'jane@example.com', '0987654321', null);

        $this->mockApiInstance->method('customerGet')->willReturn([$customer1, $customer2]);

        $result = $this->customerService->get();

        $this->assertCount(2, $result);
        $this->assertEquals([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'createdAt' => '2023-01-01T00:00:00Z',
        ], $result[0]);
        $this->assertEquals([
            'id' => 2,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '0987654321',
            'createdAt' => null,
        ], $result[1]);
    }

    // public function testGetCustomersApiException(): void
    // {
    //     $exception = new Exception('API Error');

    //     $this->mockApiInstance->method('customerGet')->willThrowException($exception);

    //     // CustomApiExceptionをモックする
    //     $customApiException = $this->createMock(CustomApiException::class);
    //     $customApiException->method('getErrorMessage')->willReturn('Custom API Error');
    //     $customApiException->method('getErrorCode')->willReturn(500);

    //     $this->mockErrorResolver->method('resolveError')
    //         ->with($exception)
    //         ->willReturn($customApiException);

    //     $this->expectException(CustomApiException::class);
    //     $this->expectExceptionMessage('Custom API Error');
    //     $this->expectExceptionCode(500);

    //     $this->customerService->get();
    // }

    private function setPrivateProperty($object, string $propertyName, $value): void
    {
        $reflection = new ReflectionClass(get_class($object));
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }

    private function createCustomerMock(int $id, string $name, string $email, string $phone, ?DateTime $createdAt): Customer|MockObject
    {
        $customer = $this->createMock(Customer::class);
        $customer->method('getId')->willReturn($id);
        $customer->method('getName')->willReturn($name);
        $customer->method('getEmail')->willReturn($email);
        $customer->method('getPhone')->willReturn($phone);
        $customer->method('getCreatedAt')->willReturn($createdAt);

        return $customer;
    }
}
