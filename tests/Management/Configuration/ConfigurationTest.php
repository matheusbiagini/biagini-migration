<?php

declare(strict_types=1);

namespace Test\Management\Configuration;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    use TraitConfiguration;

    public function testShouldBeInstanceOfPdo() : void
    {
        $configuration = $this->getConfiguration();
        $this->assertInstanceOf(\PDO::class, $configuration->getPdo());
    }

    public function testShouldBeNamespace() : void
    {
        $configuration = $this->getConfiguration();
        $this->assertEquals('AliceMigration\PathMigrations', $configuration->getNamespace());
    }

    public function testShouldBePathMigrations() : void
    {
        $configuration = $this->getConfiguration();
        $this->assertEquals(getcwd() . "/src/PathMigrations/", $configuration->getPathMigrations());
    }

    public function testShouldBeVersionTableName() : void
    {
        $configuration = $this->getConfiguration();
        $this->assertEquals("db_version", $configuration->getVersionTableName());
    }
}
