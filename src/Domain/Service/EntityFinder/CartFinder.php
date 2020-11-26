<?php

declare(strict_types=1);

namespace Api\Domain\Service\EntityFinder;

use Api\Domain\Entity\Cart;
use Api\Domain\ReadModel\CartRepositoryInterface;
use Api\Domain\ReadModel\Specification\Factory\CartSpecificationFactoryInterface;
use Ramsey\Uuid\UuidInterface;

final class CartFinder implements CartFinderInterface
{
    private CartSpecificationFactoryInterface $cartSpecFactory;

    private CartRepositoryInterface $cartRepository;


    public function __construct(
        CartSpecificationFactoryInterface $cartSpecificationFactory,
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartSpecFactory = $cartSpecificationFactory;
        $this->cartRepository  = $cartRepository;
    }


    public function getCartByCustomerAndProduct(UuidInterface $customerUuid, UuidInterface $productUuid): ?Cart
    {
        $specification = $this->cartSpecFactory->createForFindWithCustomerAndProduct(
            $customerUuid,
            $productUuid
        );

        return $this->cartRepository->getOneOrNull($specification);
    }


    /**
     * {@inheritdoc}
     */
    public function getCartsByCustomer(UuidInterface $customerUuid): iterable
    {
        $specification = $this->cartSpecFactory->createForFindWithCustomer(
            $customerUuid
        );

        return $this->cartRepository->findCarts($specification);
    }


    /**
     * {@inheritdoc}
     */
    public function getCartByCustomer(UuidInterface $customerUuid): ?Cart
    {
        $specification = $this->cartSpecFactory->createForFindWithCustomer(
            $customerUuid
        );

        return $this->cartRepository->getOneOrNull($specification);
    }


    /**
     * {@inheritdoc}
     */
    public function getCartsByCustomerAndStatusInProgress(UuidInterface $customerUuid): iterable
    {
        $specification = $this->cartSpecFactory->createForFindWithCustomerAndStatusInProgress(
            $customerUuid
        );

        return $this->cartRepository->findCarts($specification);
    }
}
