<?php

declare(strict_types=1);

namespace Api\Domain\Events\Bus;

interface PublisherMessageInterface
{
    /**
     * @param MessageToEnqueueInterface $message
     */
    public function publish(MessageToEnqueueInterface $message): void;
}
