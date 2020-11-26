<?php

declare(strict_types=1);

namespace Api\Infrastructure\RabbitMQ;

use Api\Domain\Events\Bus\MessageToEnqueueInterface;
use PhpAmqpLib\Message\AMQPMessage;

class MessageMQ implements MessageToEnqueueInterface
{
    private AMQPMessage $message;


    public function __construct(array $values)
    {
        $this->message = new AMQPMessage(json_encode($values));
    }


    /**
     * @return AMQPMessage
     */
    public function getMessage(): AMQPMessage
    {
        return $this->message;
    }
}
