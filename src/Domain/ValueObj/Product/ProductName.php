<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Product;

use Api\Domain\ValueObj\Base\VarcharTrait;
use Throwable;

final class ProductName
{
    const MAX_LENGTH = 100;

    use VarcharTrait;

    /**
     * @param string $name
     * @throws Throwable
     * @return static
     */
    public static function fromStr(string $name): self
    {
        return self::fromString($name);
    }
}
