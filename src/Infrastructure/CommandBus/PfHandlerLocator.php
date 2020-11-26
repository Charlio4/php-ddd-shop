<?php

declare(strict_types=1);

namespace Api\Infrastructure\CommandBus;

use League\Tactician\Exception\InvalidCommandException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Psr\Container\ContainerInterface;

class PfHandlerLocator implements HandlerLocator
{
    /** @var ContainerInterface */
    private $container;

    /** @var string */
    private $suffix;


    public function __construct(ContainerInterface $container, string $suffix = 'Handler')
    {
        $this->container = $container;
        $this->suffix    = $suffix;
    }


    /**
     * @param string $commandName
     * @return mixed|object
     */
    public function getHandlerForCommand($commandName)
    {
        $commandHandler = $this->getHandler($commandName);

        if (!$this->container->has($commandHandler)) {
            throw new InvalidCommandException('Command Handler not found');
        }

        return $this->container->get($commandHandler);
    }


    /**
     * @param string $commandName
     * @return string
     */
    private function getHandler(string $commandName): string
    {
        $command = explode('\\', $commandName);
        $name    = substr(end($command), 0, \strlen('Command') * -1);

        return $name . $this->suffix;
    }
}
