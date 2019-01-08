<?php

declare(strict_types=1);

namespace Test\Management\Service;

use AliceMigration\Management\Service\CreateMigration;
use PHPUnit\Framework\TestCase;
use Test\Management\Configuration\TraitConfiguration;

class CreateMigrationTest extends TestCase
{
    use TraitConfiguration;

    private function getInstance() : CreateMigration
    {
        return new CreateMigration($this->getConfiguration());
    }

    public function testShouldCreateMigration() : void
    {
        $version = "MigrateVersion" . time();
        $create = $this->getInstance()->create($version);
        $this->assertTrue($create);
        $this->clearTest($this->getConfiguration()->getPathMigrations() . $version . '.php');
    }

    private function clearTest(string $filename) : void
    {
        unlink($filename);
    }
}
