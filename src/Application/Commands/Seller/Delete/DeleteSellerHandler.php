<?php

declare(strict_types=1);

namespace Api\Application\Commands\Seller\Delete;

use Api\Domain\Exceptions\SellerException;
use Api\Domain\Service\EntityFinder\SellerFinderInterface;

final class DeleteSellerHandler
{
    private SellerFinderInterface $sellerFinder;


    public function __construct(SellerFinderInterface $sellerFinder)
    {
        $this->sellerFinder = $sellerFinder;
    }


    public function __invoke(DeleteSellerCommand $command): bool
    {
        $seller = $this->sellerFinder->getSellerByUuid($command->getUuid());

        if (!$seller) {
            throw new SellerException('Seller not found', 404);
        }

        $seller->deleteSeller();

        return true;
    }
}
