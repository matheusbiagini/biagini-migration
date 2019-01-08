<?php

declare(strict_types=1);

namespace Test\Management\Database;

use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    use TraitConnection;

    public function testShouldBeDbalConnection() : void
    {
        $connection = $this->getConnnection();
        $this->assertInstanceOf(Connection::class , $connection->getConnection());
    }
}
