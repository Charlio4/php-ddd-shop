<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Base;

use Assert\Assertion;
use Throwable;

trait VarcharTrait
{
    /** @var string */
    protected $name;


    /**
     * @param string $str
     * @throws Throwable
     * @return self
     */
    protected static function fromString(string $str): self
    {
        self::checkAssertion($str);

        $instance       = new static();
        $instance->name = $str;

        return $instance;
    }


    /**
     * @param string $str
     * @throws Throwable
     * @return bool
     */
    public static function checkAssertion(string $str): bool
    {
        Assertion::notEmpty($str, 'Is empty');
        Assertion::string($str, 'Must be string');
        Assertion::maxLength($str, static::MAX_LENGTH, 'Is too long');

        return true;
    }


    /**
     * @return string
     */
    public function toStr(): string
    {
        return $this->name;
    }


    public function __toString(): string
    {
        return $this->toStr();
    }

    private function __construct()
    {
    }
}
