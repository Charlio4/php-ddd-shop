<?php

declare(strict_types=1);

namespace Api\Infrastructure\Console;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

trait TraitLogger
{
    protected LoggerInterface $logger;


    /**
     * @param OutputInterface $output
     */
    protected function createLogger(OutputInterface $output): void
    {
        $verbosityLevelMap = $output->getVerbosity() <= OutputInterface::VERBOSITY_NORMAL
            ? []
            : [
                LogLevel::NOTICE => OutputInterface::VERBOSITY_VERBOSE,
                LogLevel::INFO   => OutputInterface::VERBOSITY_VERBOSE,
            ];

        $this->logger = new ConsoleLogger($output, $verbosityLevelMap);
    }
}
