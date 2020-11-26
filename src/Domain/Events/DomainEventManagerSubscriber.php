<?php

declare(strict_types=1);

namespace Api\Domain\Events;

use Api\Domain\Events\Common\EventInterface;
use Api\Domain\Exceptions\DomainEventException;

class DomainEventManagerSubscriber
{
    /** @var self|null */
    private static ?DomainEventManagerSubscriber $instance = null;

    private array $subscribers = [];


    /**
     * DomainEventPublisher constructor.
     */
    private function __construct()
    {
        $this->subscribers['*'] = [];
    }


    /**
     * Clone is not allowed.
     */
    public function __clone()
    {
        throw new DomainEventException('Clone is not supported');
    }


    /**
     * Singleton Name Constructor.
     * @return static
     */
    public static function instance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }


    /**
     * @param string $event
     * @param DomainEventSubscriberInterface[] $subscribers
     * @return static
     */
    public function addSubscribers(string $event = '*', array $subscribers = []): self
    {
        $this->initEventGroup($event);

        foreach ($subscribers as $subscriber) {
            $this->subscribers[$event][] = $subscriber;
        }

        return $this;
    }


    /**
     * @param DomainEventSubscriberInterface $subscriber
     * @param string $event
     */
    public function removeSubscriber(DomainEventSubscriberInterface $subscriber, string $event = '*'): void
    {
        foreach ($this->getEventSubscribers($event) as $key => $subs) {
            if ($subs === $subscriber) {
                unset($this->subscribers[$event][$key]);
            }
        }
    }


    public function removeAllSubscribers(): void
    {
        $this->subscribers = [];
        $this->initEventGroup();
    }


    /**
     * @param EventInterface $event
     * @param object|null $emitter
     */
    public function publish(EventInterface $event, object $emitter = null): void
    {
        foreach ($this->getEventSubscribers(\get_class($event)) as $subscriber) {
            $subscriber->handle($event, $emitter);
        }
    }


    /**
     * @param string $event
     */
    private function initEventGroup(string $event = '*'): void
    {
        if (!isset($this->subscribers[$event])) {
            $this->subscribers[$event] = [];
        }
    }


    /**
     * @param string $event
     * @return iterable
     */
    private function getEventSubscribers(string $event = '*'): iterable
    {
        $this->initEventGroup($event);

        $group = $this->subscribers[$event];
        $all   = $this->subscribers['*'];

        return array_merge($group, $all);
    }
}
