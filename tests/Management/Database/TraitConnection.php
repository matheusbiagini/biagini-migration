<?php

declare(strict_types=1);

namespace Test\Management\Database;

use AliceMigration\Management\Database\Connection;
use Test\Management\Configuration\TraitConfiguration;

trait TraitConnection
{
    use TraitConfiguration;

    public function getConnnection() : Connection
    {
        return new Connection($this->getConfiguration());
    }
}
