<?php

declare(strict_types=1);

namespace AliceMigration\Command;

use AliceMigration\Management\Configuration\Configuration;

class Command extends \Symfony\Component\Console\Command\Command
{
    /** @var Configuration $configuration */
    protected $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        parent::__construct();
    }

    protected function getConfiguration() : Configuration
    {
        return $this->configuration;
    }
}
