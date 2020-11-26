<?php

declare(strict_types=1);

namespace Api\Application\Commands\Product\Create;

use Api\Domain\Entity\Product;
use Api\Domain\Exceptions\SellerException;
use Api\Domain\Service\EntityFinder\SellerFinderInterface;

final class CreateProductHandler
{
    private SellerFinderInterface $sellerFinder;


    public function __construct(SellerFinderInterface $sellerFinder)
    {
        $this->sellerFinder = $sellerFinder;
    }


    public function __invoke(CreateProductCommand $command): string
    {
        $seller = $this->sellerFinder->getSellerByUuid($command->getSellerUuid());

        if (!$seller) {
            throw new SellerException('Seller not found', 404);
        }

        $product = Product::create(
            $command->getUuid(),
            $command->getSellerUuid(),
            $command->getName(),
            $command->getPrice(),
            $seller
        );

        $product->createProduct();

        return $product->getUuid()->toString();
    }
}
