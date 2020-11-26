<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Customer;

use Api\Domain\ValueObj\Base\VarcharTrait;
use Throwable;

class CustomerLastname
{
    const MAX_LENGTH = 100;

    use VarcharTrait;


    /**
     * @param string $lastname
     * @throws Throwable
     * @return static
     */
    public static function fromStr(string $lastname): self
    {
        return self::fromString($lastname);
    }
}
