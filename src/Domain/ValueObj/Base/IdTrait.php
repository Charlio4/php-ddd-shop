<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Base;

use Assert\Assertion;
use Throwable;

trait IdTrait
{
    private int $numId;


    /**
     * @param int $numId
     * @throws Throwable
     * @return static
     */
    protected static function fromInteger(int $numId): self
    {
        self::checkAssertion($numId);

        $instance        = new static();
        $instance->numId = $numId;

        return $instance;
    }


    /**
     * @param int $numId
     * @throws Throwable
     * @return bool
     */
    public static function checkAssertion(int $numId): bool
    {
        // Assertion::notEmpty($numId, 'Is empty');
        Assertion::integer($numId, 'Must be integer');

        return true;
    }


    /**
     * @return int
     */
    public function toInt(): int
    {
        return $this->numId;
    }


    private function __construct()
    {
    }
}
