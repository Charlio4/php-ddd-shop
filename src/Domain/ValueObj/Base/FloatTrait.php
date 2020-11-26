<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Base;

trait FloatTrait
{
    private float $num;


    /**
     * @param float $num
     * @return static
     */
    public static function fromNumber(float $num): self
    {
        $instance      = new static();
        $instance->num = $num;

        return $instance;
    }


    /**
     * @return float
     */
    public function toFloat(): float
    {
        return $this->num;
    }


    /**
     * @return float
     */
    public function toSpanishNotation(): float
    {
        return (float) number_format($this->num, 2, ',', '.');
    }


    private function __construct()
    {
    }
}
