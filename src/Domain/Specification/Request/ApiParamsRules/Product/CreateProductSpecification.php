<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Request\ApiParamsRules\Product;

use Api\Domain\Common\Param;
use Api\Domain\Specification\Request\RequestSpecificationInterface;
use Api\Domain\ValueObj\Product\ProductName;
use Api\Domain\ValueObj\Product\ProductPrice;
use Exception;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class CreateProductSpecification implements RequestSpecificationInterface
{
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        try {
            $name       = $request->getParsedBodyParam(Param::PRODUCT_NAME);
            $sellerUuid = $request->getParsedBodyParam(Param::PRODUCT_SELLER_UUID);
            $price      = $request->getParsedBodyParam(Param::PRODUCT_PRICE);

            ProductName::fromStr($name);
            Uuid::fromString($sellerUuid);
            ProductPrice::fromNumber((float) $price);

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
