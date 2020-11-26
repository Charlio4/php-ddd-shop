<?php

declare(strict_types=1);

use Api\Domain\Events\Cart\CartWasBuyed;
use Api\Domain\Events\Cart\ProductFromCartWasDeleted;
use Api\Domain\Events\Cart\ProductFromCartWasUpdated;
use Api\Domain\Events\DomainEventManagerSubscriber as DomainEvent;
use Api\Domain\Events\Product\ProductWasCreated;
use Api\Domain\Events\Product\ProductWasDeleted;
use Api\Domain\Events\Seller\SellerWasCreated;
use Api\Domain\Events\Seller\SellerWasDeleted;

$manager = DomainEvent::instance()
                      ->addSubscribers(
                          SellerWasCreated::class,
                          [
                              $container['Persist'],
                          ]
                      )
                      ->addSubscribers(
                          SellerWasDeleted::class,
                          [
                              $container['Delete'],
                          ]
                      )
                      ->addSubscribers(
                          ProductWasCreated::class,
                          [
                              $container['Persist'],
                          ]
                      )
                      ->addSubscribers(
                          ProductWasDeleted::class,
                          [
                              $container['Delete'],
                          ]
                      )
                      ->addSubscribers(
                          ProductFromCartWasUpdated::class,
                          [
                              $container['Persist'],
                          ]
                      )
                      ->addSubscribers(
                          ProductFromCartWasDeleted::class,
                          [
                              $container['Delete'],
                          ]
                      )
                      ->addSubscribers(
                          CartWasBuyed::class,
                          [
                              $container['Persist'],
                          ]
                      );
