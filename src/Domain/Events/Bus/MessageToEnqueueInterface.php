<?php

declare(strict_types=1);

namespace Api\Domain\Events\Bus;

interface MessageToEnqueueInterface
{
    public function getMessage();
}
