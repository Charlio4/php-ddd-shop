<?php

declare(strict_types=1);

namespace unit\Api\Application\Commands\Product\Create;

use Api\Application\Commands\Product\Create\CreateProductCommand;
use Api\Application\Commands\Product\Create\CreateProductHandler;
use Api\Domain\Entity\Seller;
use Api\Domain\Exceptions\SellerException;
use Api\Domain\Service\EntityFinder\SellerFinderInterface;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Throwable;

class CreateProductHandlerTest extends TestCase
{
    /** @var SellerFinderInterface|LegacyMockInterface|MockInterface */
    private $sellerFinder;

    /** @var Seller|LegacyMockInterface|MockInterface */
    private $seller;


    protected function setUp(): void
    {
        $this->sellerFinder = Mockery::mock(SellerFinderInterface::class);
        $this->seller       = Mockery::mock(Seller::class);

        parent::setUp(); // TODO: Change the autogenerated stub
    }


    /**
     * @test
     * @dataProvider productProvider
     * @param string $uuid
     * @param string $name
     * @param string $price
     * @throws Throwable
     */
    public function should_create_product(
        string $uuid,
        string $name,
        string $price
    ) {
        $this->sellerFinder
            ->shouldReceive('getSellerByUuid')
            ->once()
            ->andReturn($this->seller);

        $command = new CreateProductCommand($uuid, $name, $price);
        $handler = new CreateProductHandler($this->sellerFinder);

        $result = $handler($command);

        self::assertIsString($result);
    }

    /**
     * @test
     * @dataProvider productProvider
     * @param string $uuid
     * @param string $name
     * @param string $price
     * @throws Throwable
     */
    public function should_throw_exception_when_seller_not_found(
        string $uuid,
        string $name,
        string $price
    ) {
        $this->expectException(SellerException::class);

        $this->sellerFinder
            ->shouldReceive('getSellerByUuid')
            ->once()
            ->andReturnNull();

        $command = new CreateProductCommand($uuid, $name, $price);
        $handler = new CreateProductHandler($this->sellerFinder);

        $handler($command);
    }

    public function productProvider()
    {
        return [
            [
                Uuid::uuid4()->toString(),
                'Product test',
                '10.95',
            ],
        ];
    }
}
