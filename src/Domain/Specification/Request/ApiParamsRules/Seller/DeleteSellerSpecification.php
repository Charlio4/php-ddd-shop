<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Request\ApiParamsRules\Seller;

use Api\Domain\Common\Param;
use Api\Domain\Specification\Request\RequestSpecificationInterface;
use Exception;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class DeleteSellerSpecification implements RequestSpecificationInterface
{
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        try {
            $uuid = $request->getAttribute(Param::UUID);

            Uuid::fromString($uuid);

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
