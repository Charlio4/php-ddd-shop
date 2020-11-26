<?php

declare(strict_types=1);

namespace Api\Domain\Service\EntityFinder;

use Api\Domain\Entity\Cart;
use Ramsey\Uuid\UuidInterface;

interface CartFinderInterface
{
    /**
     * @param UuidInterface $customerUuid
     * @param UuidInterface $productUuid
     * @return Cart|null
     */
    public function getCartByCustomerAndProduct(UuidInterface $customerUuid, UuidInterface $productUuid): ?Cart;


    /**
     * @param UuidInterface $customerUuid
     * @return iterable
     */
    public function getCartsByCustomer(UuidInterface $customerUuid): iterable;


    /**
     * @param UuidInterface $customerUuid
     * @return Cart|null
     */
    public function getCartByCustomer(UuidInterface $customerUuid): ?Cart;


    /**
     * @param UuidInterface $customerUuid
     * @return iterable
     */
    public function getCartsByCustomerAndStatusInProgress(UuidInterface $customerUuid): iterable;
}
