<?php

declare(strict_types=1);

namespace AliceMigration\Command\Management;

use AliceMigration\Command\Command;
use AliceMigration\Management\Service\Migrate;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RevertCommand extends Command implements CommandManagement
{
    protected function configure()
    {
        $this->setName('migrate:revert')
             ->setDescription('Revert the migration version')
             ->setHelp('Revert the migration version command')
             ->addArgument('filename', InputArgument::REQUIRED, 'Migration filename.')
             ->addArgument('rollback', InputArgument::OPTIONAL, 'Run migration rollback. Options: true or false.')
             ->addArgument('removeFile', InputArgument::OPTIONAL, 'Remove migration file. Options: true or false.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename   = $input->getArgument('filename');
        $rollback   = $input->getArgument('rollback') === 'true' ? true : false;
        $removeFile = $input->getArgument('removeFile') === 'true' ? true : false;
        $path       = $this->getConfiguration()->getPathMigrations();

        $output->writeln("Searching migration in {$path}{$filename}");

        $migrateService = new Migrate($this->getConfiguration(), $output);

        $migrateService->revert($filename, $rollback, $removeFile);
    }
}
