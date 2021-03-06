<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Request\ApiParamsRules\Cart;

use Api\Domain\Common\Param;
use Api\Domain\Specification\Request\RequestSpecificationInterface;
use Exception;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class DeleteCartSpecification implements RequestSpecificationInterface
{
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        try {
            $customerUuid = $request->getAttribute(Param::UUID);

            Uuid::fromString($customerUuid);

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
