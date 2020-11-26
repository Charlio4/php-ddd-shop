<?php

declare(strict_types=1);

use Api\UI\Http\Controller\Cart\AddProductController;
use Api\UI\Http\Controller\Cart\BuyCartController;
use Api\UI\Http\Controller\Cart\DeleteCartController;
use Api\UI\Http\Controller\Cart\GetTotalCartController;
use Api\UI\Http\Controller\Cart\RemoveProductFromCartController;
use Api\UI\Http\Controller\Product\CreateProductController;
use Api\UI\Http\Controller\Product\DeleteProductController;
use Api\UI\Http\Controller\Seller\CreateSellerController;
use Api\UI\Http\Controller\Seller\DeleteSellerController;
use Psr\Container\ContainerInterface;

// Seller
$container['CreateSellerController'] = function (ContainerInterface $c): CreateSellerController {
    return new CreateSellerController(
        $c['CommandBus'],
        $c['CreateSellerSpecification']
    );
};

$container['DeleteSellerController'] = function (ContainerInterface $c): DeleteSellerController {
    return new DeleteSellerController(
        $c['CommandBus'],
        $c['DeleteSellerSpecification']
    );
};

// Product
$container['CreateProductController'] = function (ContainerInterface $c): CreateProductController {
    return new CreateProductController(
        $c['CommandBus'],
        $c['CreateProductSpecification']
    );
};

$container['DeleteProductController'] = function (ContainerInterface $c): DeleteProductController {
    return new DeleteProductController(
        $c['CommandBus'],
        $c['DeleteProductSpecification']
    );
};

// Cart
$container['AddProductController'] = function (ContainerInterface $c): AddProductController {
    return new AddProductController(
        $c['CommandBus'],
        $c['AddProductSpecification']
    );
};

$container['RemoveProductFromCartController'] = function (ContainerInterface $c): RemoveProductFromCartController {
    return new RemoveProductFromCartController(
        $c['CommandBus'],
        $c['RemoveProductFromCartSpecification']
    );
};

$container['GetTotalCartController'] = function (ContainerInterface $c): GetTotalCartController {
    return new GetTotalCartController(
        $c['CommandBus'],
        $c['GetTotalCartSpecification']
    );
};

$container['DeleteCartController'] = function (ContainerInterface $c): DeleteCartController {
    return new DeleteCartController(
        $c['CommandBus'],
        $c['DeleteCartSpecification']
    );
};

$container['BuyCartController'] = function (ContainerInterface $c): BuyCartController {
    return new BuyCartController(
        $c['CommandBus'],
        $c['BuyCartSpecification']
    );
};
