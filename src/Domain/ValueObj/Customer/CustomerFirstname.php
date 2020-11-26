<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Customer;

use Api\Domain\ValueObj\Base\VarcharTrait;
use Throwable;

class CustomerFirstname
{
    const MAX_LENGTH = 100;

    use VarcharTrait;


    /**
     * @param string $firstname
     * @throws Throwable
     * @return static
     */
    public static function fromStr(string $firstname): self
    {
        return self::fromString($firstname);
    }
}
