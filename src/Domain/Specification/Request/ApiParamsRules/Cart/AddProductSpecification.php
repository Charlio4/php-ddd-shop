<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Request\ApiParamsRules\Cart;

use Api\Domain\Common\Param;
use Api\Domain\Specification\Request\RequestSpecificationInterface;
use Api\Domain\ValueObj\Product\ProductQuantity;
use Exception;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class AddProductSpecification implements RequestSpecificationInterface
{
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        try {
            $customerUuid = $request->getParsedBodyParam(Param::CUSTOMER_UUID);
            $productUuid  = $request->getParsedBodyParam(Param::PRODUCT_UUID);
            $quantity     = $request->getParsedBodyParam(Param::PRODUCT_QUANTITY);

            Uuid::fromString($customerUuid);
            Uuid::fromString($productUuid);
            ProductQuantity::fromInt((int) $quantity);

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
