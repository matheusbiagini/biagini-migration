<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$database = "alice_migration";
$host = 'mysql';
$user = 'root';
$password = '123';
$pathMigrations = getcwd() . "/src/PathMigrations/";
$namespace = 'AliceMigration\PathMigrations';

$configuration = new \AliceMigration\Management\Configuration\Configuration(
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

$migration = new \AliceMigration\Migration\Migration($configuration);
$migration->run();