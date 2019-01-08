<?php

declare(strict_types=1);

namespace AliceMigration\Management\Database;

class Database
{
    /** @var \AliceMigration\Management\Database\Connection $connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getConnection() : \Doctrine\DBAL\Connection
    {
        return $this->connection->getConnection();
    }
}
