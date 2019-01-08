<?php

declare(strict_types=1);

namespace Test\Management\Database;

use PHPUnit\Framework\TestCase;
use AliceMigration\Management\Database\Database;

class DatabaseTest extends TestCase
{
    use \Test\Management\Database\TraitConnection;

    private function getInstance() : Database
    {
        return new Database($this->getConnnection());
    }

    public function testShouldBeConnection() : void
    {
        $this->assertInstanceOf(\Doctrine\DBAL\Connection::class , $this->getInstance()->getConnection());
    }
}
