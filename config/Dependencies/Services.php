<?php

declare(strict_types=1);

use Api\Domain\Service\EntityFinder\CartFinder;
use Api\Domain\Service\EntityFinder\CartFinderInterface;
use Api\Domain\Service\EntityFinder\ProductFinder;
use Api\Domain\Service\EntityFinder\ProductFinderInterface;
use Api\Domain\Service\EntityFinder\SellerFinder;
use Api\Domain\Service\EntityFinder\SellerFinderInterface;
use Psr\Container\ContainerInterface;

$container['SellerFinder'] = function (ContainerInterface $c): SellerFinderInterface {
    return new SellerFinder(
        $c['SellerSpecificationFactory'],
        $c['SellerRepository']
    );
};

$container['ProductFinder'] = function (ContainerInterface $c): ProductFinderInterface {
    return new ProductFinder(
        $c['ProductSpecificationFactory'],
        $c['ProductRepository']
    );
};

$container['CartFinder'] = function (ContainerInterface $c): CartFinderInterface {
    return new CartFinder(
        $c['CartSpecificationFactory'],
        $c['CartRepository']
    );
};
