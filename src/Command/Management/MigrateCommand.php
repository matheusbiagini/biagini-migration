<?php

declare(strict_types=1);

namespace AliceMigration\Command\Management;

use AliceMigration\Command\Command;
use AliceMigration\Management\Service\Migrate;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends Command implements CommandManagement
{
    protected function configure()
    {
        $this->setName('migrate:run')
             ->setDescription('Run system migrations')
             ->setHelp('Run system migrations command')
             ->addOption('env', 'e', InputOption::VALUE_OPTIONAL, 'Env.')
             ->addArgument('rollback', InputArgument::OPTIONAL, 'Failback execution. Options: true or false.')
             ->addArgument('debugError', InputArgument::OPTIONAL, 'Debug error. Options: true or false.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Start of migrations");

        $rollback   = $input->getArgument('rollback') === 'true' ? true : false;
        $debugError = $input->getArgument('debugError') === 'true' ? true : false;

        $migrateService = new Migrate($this->getConfiguration(), $output);
        $migrateService->migrate($rollback, $debugError);
    }
}
