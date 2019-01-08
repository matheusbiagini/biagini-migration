<?php

declare(strict_types=1);

namespace Test\Management\Service;

use AliceMigration\Management\Service\Migrate;
use PHPUnit\Framework\TestCase;
use Test\Management\Configuration\TraitConfiguration;

class MigrateTest extends TestCase
{
    use TraitConfiguration;

    private function getInstance() : Migrate
    {
        return new Migrate($this->getConfiguration());
    }

    public function testShouldMigrateSuccessfully() : void
    {
        $migrate = $this->getInstance();

        $scenario1 = $migrate->migrate(false, false);
        $scenario2 = $migrate->migrate(true, false);
        $scenario3 = $migrate->migrate(true, true);
        $scenario4 = $migrate->migrate(false, true);

        $this->assertTrue($scenario1);
        $this->assertTrue($scenario2);
        $this->assertTrue($scenario3);
        $this->assertTrue($scenario4);
    }

    public function testShouldRemoveMigrationSuccessfully() : void
    {
        $migrate = $this->getInstance();
        $reverted = $migrate->revert('dollynho.php', true, true);

        $this->assertTrue($reverted);
    }
}
