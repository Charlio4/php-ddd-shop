<?php

declare(strict_types=1);

namespace Api\Application\Commands\Seller\Create;

use Api\Domain\Entity\Seller;

final class CreateSellerHandler
{
    public function __construct()
    {
    }

    public function __invoke(CreateSellerCommand $command): string
    {
        $seller = Seller::create(
            $command->getUuid(),
            $command->getName()
        );

        $seller->addSeller();

        return $seller->getUuid()->toString();
    }
}
