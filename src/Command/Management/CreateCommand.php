<?php

declare(strict_types=1);

namespace AliceMigration\Command\Management;

use AliceMigration\Command\Command;
use AliceMigration\Management\Service\CreateMigration;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command implements CommandManagement
{
    protected function configure()
    {
        $this->setName('migrate:create')
             ->setDescription('Creation of database migrations')
             ->setHelp('creation of database migrations command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $version = "MigrateVersion" . time();
        $migrate = new CreateMigration($this->getConfiguration());
        $migrate->create($version);
        $output->writeln("Generated new migration class to " . $this->getConfiguration()->getPathMigrations() . $version . '.php');
    }
}
