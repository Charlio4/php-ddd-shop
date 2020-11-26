<?php

declare(strict_types=1);

namespace Api\Domain\Service\EntityFinder;

use Api\Domain\Entity\Seller;
use Api\Domain\ReadModel\SellerRepositoryInterface;
use Api\Domain\ReadModel\Specification\Factory\SellerSpecificationFactoryInterface;
use Ramsey\Uuid\UuidInterface;

class SellerFinder implements SellerFinderInterface
{
    private SellerSpecificationFactoryInterface $sellerSpecificationFactory;

    private SellerRepositoryInterface $sellerRepository;


    public function __construct(
        SellerSpecificationFactoryInterface $sellerSpecificationFactory,
        SellerRepositoryInterface $sellerRepository
    ) {
        $this->sellerSpecificationFactory = $sellerSpecificationFactory;
        $this->sellerRepository           = $sellerRepository;
    }


    /**
     * {@inheritdoc}
     */
    public function getSellerByUuid(UuidInterface $uuid): ?Seller
    {
        $specification = $this->sellerSpecificationFactory->createForFindWithUuid($uuid);

        return $this->sellerRepository->getOneOrNull($specification);
    }
}
