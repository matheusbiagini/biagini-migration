<?php

declare(strict_types=1);

namespace AliceMigration\Command;

use AliceMigration\Command\Management\CreateCommand;
use AliceMigration\Command\Management\MigrateCommand;
use AliceMigration\Command\Management\RevertCommand;
use AliceMigration\Management\Configuration\Configuration;

class Orchestrator
{
    private function getCommands() : array
    {
        return [
            CreateCommand::class,
            MigrateCommand::class,
            RevertCommand::class,
        ];
    }

    public function build(Configuration $configuration) : void
    {
        $console = new \Symfony\Component\Console\Application();

        foreach ($this->getCommands() as $command) {
            $console->add(new $command($configuration));
        }

        $console->setVersion('1.0.0');
        $console->run();
    }
}
