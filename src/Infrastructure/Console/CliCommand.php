<?php

declare(strict_types=1);

namespace Api\Infrastructure\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class CliCommand extends Command
{
    const FORMAT_DATE_TIME = 'd-m-Y H:i:s';
    const FORCE_OPTION     = 'force';


    private OutputInterface $output;

    /** @var bool */
    private $dryRun;


    use TraitEventWatcher;
    use TraitLogger;


    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $this->initWatcher();
        $this->printIniDateTime();
        $this->createLogger($output);
        $this->loadOptionForce($input);

        try {
            $run = parent::run($input, $output);

            $this->printStatsWatcher();

            return $run;
        } catch (\Exception $exception) {
            // ToDo: Create method to send exception to team developers
            // $this->sendException($exception);
            throw $exception;
        }
    }


    /**
     * @param InputInterface $input
     */
    private function loadOptionForce(InputInterface $input): void
    {
        if ($input->hasOption(self::FORCE_OPTION)) {
            $this->dryRun = (bool) !$input->getOption(self::FORCE_OPTION);

            if ($this->dryRun) {
                $this->logger->info('Dry run mode');
            }
        }
    }


    protected function addOptionForce(): void
    {
        $this->addOption(
            self::FORCE_OPTION,
            null,
            InputOption::VALUE_NONE,
            'Perform this action successful, resource will change'
        );
    }


    protected function isDryRun(): bool
    {
        if (null === $this->dryRun) {
            throw new \BadMethodCallException('Dry run is not defined, put "addOptionForce()" in your app::configure()');
        }

        return $this->dryRun;
    }


    protected function isQuietVerbose(): bool
    {
        return OutputInterface::VERBOSITY_QUIET == $this->output->getVerbosity();
    }


    protected function isVerbose(): bool
    {
        return $this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE;
    }


    protected function isVeryVerbose(): bool
    {
        return $this->output->getVerbosity() >= OutputInterface::VERBOSITY_VERY_VERBOSE;
    }


    protected function isDebug(): bool
    {
        return $this->output->getVerbosity() >= OutputInterface::VERBOSITY_DEBUG;
    }


    private function printIniDateTime(): void
    {
        if ($this->isQuietVerbose()) {
            return;
        }

        $this->output->writeln('Ini: <info>' . date(self::FORMAT_DATE_TIME) . '</info>');
    }


    private function printStatsWatcher(): void
    {
        $event = $this->stopWatcher();
        if ($this->isQuietVerbose()) {
            return;
        }

        if (true === $this->dryRun) {
            $this->output->writeln('<comment>Please run the operation with --force to execute</comment>');
        }

        $this->output->writeln('');
        $this->output->writeln('End: <info>' . date(self::FORMAT_DATE_TIME) . '</info>');
        $this->output->writeln('Total time: <comment>' . ($event->getDuration() / 1000) . '</comment> seg.');
        $this->output->writeln('Max. Memory used: <comment>' . ($event->getMemory() / 1024 / 1024) . '</comment> MB.');
    }
}
