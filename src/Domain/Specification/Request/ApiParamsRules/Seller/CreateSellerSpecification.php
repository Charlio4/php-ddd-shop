<?php

declare(strict_types=1);

namespace Api\Domain\Specification\Request\ApiParamsRules\Seller;

use Api\Domain\Common\Param;
use Api\Domain\Specification\Request\RequestSpecificationInterface;
use Api\Domain\ValueObj\Seller\SellerName;
use Exception;
use Psr\Http\Message\RequestInterface;

final class CreateSellerSpecification implements RequestSpecificationInterface
{
    public function isSatisfiedBy(RequestInterface $request): bool
    {
        try {
            $name = $request->getParsedBodyParam(Param::SELLER_NAME);

            SellerName::checkAssertion($name);

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
