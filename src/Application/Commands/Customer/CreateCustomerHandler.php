<?php

declare(strict_types=1);

namespace Api\Application\Commands\Customer;

use Api\Domain\Common\WriteModelInterface;
use Api\Domain\Entity\Customer;

final class CreateCustomerHandler
{
    private WriteModelInterface $writeModel;


    public function __construct(WriteModelInterface $writeModel)
    {
        $this->writeModel = $writeModel;
    }

    public function __invoke(CreateCustomerCommand $command): string
    {
        $customer = Customer::create(
            $command->getUuid(),
            $command->getFirstname(),
            $command->getLastname()
        );

        $this->writeModel->save($customer);

        return $customer->getUuid()->toString();
    }
}
