<?php

declare(strict_types=1);

namespace Test\Management\Configuration;

use AliceMigration\Management\Configuration\Configuration;

trait TraitConfiguration
{
    public function getConfiguration() : Configuration
    {
        $database = "alice_migration";
        $host = 'mysql';
        $user = 'root';
        $password = '123';
        $pathMigrations = getcwd() . "/src/PathMigrations/";
        $namespace = 'AliceMigration\PathMigrations';

        return new Configuration(
            new \PDO(
                sprintf("mysql:dbname=%s;host=%s;charset=utf8", $database, $host),
                $user,
                $password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            ),
            $pathMigrations,
            $namespace
        );
    }
}
