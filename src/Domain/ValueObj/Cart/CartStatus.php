<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Cart;

use Assert\Assertion;

final class CartStatus
{
    const MAX_LENGTH = 40;

    const IN_PROGRESS = 'in_progress';
    const COMPLETED   = 'completed';

    private string $status;


    public static function fromStr(string $status): self
    {
        self::checkAssertion($status);

        $instance         = new static();
        $instance->status = $status;

        return $instance;
    }


    public static function checkAssertion(string $status): bool
    {
        Assertion::choice(
            $status,
            [
                self::IN_PROGRESS,
                self::COMPLETED,
            ]
        );

        return true;
    }


    public function isInProgress(): bool
    {
        return self::IN_PROGRESS === $this->status;
    }


    public function isCompleted(): bool
    {
        return self::COMPLETED === $this->status;
    }


    public static function createInProgress(): self
    {
        return self::fromStr(self::IN_PROGRESS);
    }


    public static function createCompleted(): self
    {
        return self::fromStr(self::COMPLETED);
    }


    public function toStr(): string
    {
        return $this->status;
    }


    public function __toString()
    {
        return $this->toStr();
    }


    private function __construct()
    {
    }
}
