<?php

declare(strict_types=1);

namespace Api\Application\Commands\Product\Delete;

use Api\Domain\Exceptions\ProductException;
use Api\Domain\Service\EntityFinder\ProductFinderInterface;

final class DeleteProductHandler
{
    private ProductFinderInterface $productFinder;

    public function __construct(ProductFinderInterface $productFinder)
    {
        $this->productFinder = $productFinder;
    }


    public function __invoke(DeleteProductCommand $command): bool
    {
        $product = $this->productFinder->getProductByUuid($command->getUuid());

        if (!$product) {
            throw new ProductException('Product not found', 404);
        }

        $product->deleteProduct();

        return true;
    }
}
