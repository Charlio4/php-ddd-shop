<?php

declare(strict_types=1);

use Api\Domain\ReadModel\Specification\Factory\CartSpecificationFactoryInterface;
use Api\Domain\ReadModel\Specification\Factory\ProductSpecificationFactoryInterface;
use Api\Domain\ReadModel\Specification\Factory\SellerSpecificationFactoryInterface;
use Api\Domain\Specification\Request\ApiParamsRules\Cart\AddProductSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Cart\BuyCartSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Cart\DeleteCartSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Cart\GetTotalCartSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Cart\RemoveProductFromCartSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Product\CreateProductSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Product\DeleteProductSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Seller\CreateSellerSpecification;
use Api\Domain\Specification\Request\ApiParamsRules\Seller\DeleteSellerSpecification;
use Api\Domain\Specification\Request\RequestSpecificationInterface;
use Api\Infrastructure\Specification\Factory\ORM\OrmCartSpecificationFactory;
use Api\Infrastructure\Specification\Factory\ORM\OrmProductSpecificationFactory;
use Api\Infrastructure\Specification\Factory\ORM\OrmSellerSpecificationFactory;
use Psr\Container\ContainerInterface;

// Request Specification
// Seller
$container['CreateSellerSpecification'] = function (): RequestSpecificationInterface {
    return new CreateSellerSpecification();
};

$container['DeleteSellerSpecification'] = function (): RequestSpecificationInterface {
    return new DeleteSellerSpecification();
};

// Product
$container['CreateProductSpecification'] = function (): RequestSpecificationInterface {
    return new CreateProductSpecification();
};

$container['DeleteProductSpecification'] = function (): RequestSpecificationInterface {
    return new DeleteProductSpecification();
};

// Cart
$container['AddProductSpecification'] = function (): RequestSpecificationInterface {
    return new AddProductSpecification();
};

$container['RemoveProductFromCartSpecification'] = function (): RequestSpecificationInterface {
    return new RemoveProductFromCartSpecification();
};

$container['GetTotalCartSpecification'] = function (): RequestSpecificationInterface {
    return new GetTotalCartSpecification();
};

$container['DeleteCartSpecification'] = function (): RequestSpecificationInterface {
    return new DeleteCartSpecification();
};

$container['BuyCartSpecification'] = function (): RequestSpecificationInterface {
    return new BuyCartSpecification();
};

// ORM Specification factories
$container['SellerSpecificationFactory'] = function (ContainerInterface $c): SellerSpecificationFactoryInterface {
    return new OrmSellerSpecificationFactory(
        $c['EntityManager']
    );
};

$container['ProductSpecificationFactory'] = function (ContainerInterface $c): ProductSpecificationFactoryInterface {
    return new OrmProductSpecificationFactory(
        $c['EntityManager']
    );
};

$container['CartSpecificationFactory'] = function (ContainerInterface $c): CartSpecificationFactoryInterface {
    return new OrmCartSpecificationFactory(
        $c['EntityManager']
    );
};
