<?php

declare(strict_types=1);

namespace Api\Domain\Service\EntityFinder;

use Api\Domain\Entity\Product;
use Api\Domain\ReadModel\ProductRepositoryInterface;
use Api\Domain\ReadModel\Specification\Factory\ProductSpecificationFactoryInterface;
use Ramsey\Uuid\UuidInterface;

final class ProductFinder implements ProductFinderInterface
{
    private ProductSpecificationFactoryInterface $productSpecificationFactory;

    private ProductRepositoryInterface $productRepository;


    public function __construct(
        ProductSpecificationFactoryInterface $productSpecificationFactory,
        ProductRepositoryInterface $productRepository
    ) {
        $this->productSpecificationFactory = $productSpecificationFactory;
        $this->productRepository           = $productRepository;
    }


    public function getProductByUuid(UuidInterface $uuid): ?Product
    {
        $specification = $this->productSpecificationFactory->createForFindWithUuid($uuid);

        return $this->productRepository->getOneOrNull($specification);
    }
}
