<?php

declare(strict_types=1);

namespace Api\Domain\ReadModel\Specification\Factory;

use Api\Domain\ReadModel\Specification\SpecificationInterface;
use Ramsey\Uuid\UuidInterface;

interface CartSpecificationFactoryInterface
{
    /**
     * @param UuidInterface $customerUuid
     * @param UuidInterface $productUuid
     * @return SpecificationInterface
     */
    public function createForFindWithCustomerAndProduct(
        UuidInterface $customerUuid,
        UuidInterface $productUuid
    ): SpecificationInterface;


    /**
     * @param UuidInterface $customerUuid
     * @return SpecificationInterface
     */
    public function createForFindWithCustomer(UuidInterface $customerUuid): SpecificationInterface;


    /**
     * @param UuidInterface $customerUuid
     * @return SpecificationInterface
     */
    public function createForFindWithCustomerAndStatusInProgress(UuidInterface $customerUuid): SpecificationInterface;
}
