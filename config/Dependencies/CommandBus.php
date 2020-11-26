<?php

declare(strict_types=1);

use Api\Application\Commands\Cart\Add\AddProductHandler;
use Api\Application\Commands\Cart\Buy\BuyCartHandler;
use Api\Application\Commands\Cart\Delete\DeleteCartHandler;
use Api\Application\Commands\Cart\GetTotal\GetTotalCartHandler;
use Api\Application\Commands\Cart\RemoveFromCart\RemoveProductFromCartHandler;
use Api\Application\Commands\Customer\CreateCustomerHandler;
use Api\Application\Commands\Product\Create\CreateProductHandler;
use Api\Application\Commands\Product\Delete\DeleteProductHandler;
use Api\Application\Commands\Seller\Create\CreateSellerHandler;
use Api\Application\Commands\Seller\Delete\DeleteSellerHandler;
use Api\Infrastructure\CommandBus\PfHandlerLocator;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Plugins\LockingMiddleware;
use Psr\Container\ContainerInterface;

$container['CommandBus'] = function (ContainerInterface $c): CommandBus {
    return new CommandBus(
        [
            new LockingMiddleware(),
            new CommandHandlerMiddleware(
                new ClassNameExtractor(),
                new PfHandlerLocator($c),
                new InvokeInflector()
            ),
        ]
    );
};

// Seller
$container['CreateSellerHandler'] = function (ContainerInterface $c): CreateSellerHandler {
    return new CreateSellerHandler();
};

$container['DeleteSellerHandler'] = function (ContainerInterface $c): DeleteSellerHandler {
    return new DeleteSellerHandler(
        $c['SellerFinder']
    );
};

// Product
$container['CreateProductHandler'] = function (ContainerInterface $c): CreateProductHandler {
    return new CreateProductHandler(
        $c['SellerFinder']
    );
};

$container['DeleteProductHandler'] = function (ContainerInterface $c): DeleteProductHandler {
    return new DeleteProductHandler(
        $c['ProductFinder']
    );
};

// Customer
$container['CreateCustomerHandler'] = function (ContainerInterface $c): CreateCustomerHandler {
    return new CreateCustomerHandler(
        $c['WriteModel']
    );
};

// Cart
$container['AddProductHandler'] = function (ContainerInterface $c): AddProductHandler {
    return new AddProductHandler(
        $c['WriteModel'],
        $c['ProductFinder'],
        $c['CartFinder']
    );
};

$container['RemoveProductFromCartHandler'] = function (ContainerInterface $c): RemoveProductFromCartHandler {
    return new RemoveProductFromCartHandler(
        $c['WriteModel'],
        $c['ProductFinder'],
        $c['CartFinder']
    );
};

$container['GetTotalCartHandler'] = function (ContainerInterface $c): GetTotalCartHandler {
    return new GetTotalCartHandler(
        $c['CartFinder']
    );
};

$container['DeleteCartHandler'] = function (ContainerInterface $c): DeleteCartHandler {
    return new DeleteCartHandler(
        $c['WriteModel'],
        $c['CartFinder']
    );
};

$container['BuyCartHandler'] = function (ContainerInterface $c): BuyCartHandler {
    return new BuyCartHandler(
        $c['CartFinder']
    );
};
