<?php

declare(strict_types=1);

namespace Api\Domain\ReadModel\Specification;

interface SpecificationInterface
{
    public function getConditions();

    public function getParameters(): array;

    public function getTypes(): array;

    public function andX(self $specification): self;

    public function orX(self $specification): self;
}
