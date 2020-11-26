<?php

declare(strict_types=1);

namespace Api\Domain\Events\Common;

interface EventInterface
{
    public function serialize(): string;

    public static function eventName(): string;
}
