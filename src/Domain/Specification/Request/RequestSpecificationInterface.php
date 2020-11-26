<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Request;

use Psr\Http\Message\RequestInterface;

interface RequestSpecificationInterface
{
    public function isSatisfiedBy(RequestInterface $request): bool;
}
