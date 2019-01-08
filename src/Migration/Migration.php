<?php

declare(strict_types=1);

namespace AliceMigration\Migration;

use AliceMigration\Command\Orchestrator;
use AliceMigration\Management\Configuration\Configuration;

class Migration
{
    /** @var Configuration $configuration */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function run() : void
    {
        (new Orchestrator())->build($this->configuration);
    }
}
