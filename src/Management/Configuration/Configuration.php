<?php

declare(strict_types=1);

namespace AliceMigration\Management\Configuration;

use PDO;

class Configuration
{
    /** @var PDO $pdo */
    private $pdo;

    /** @var string $pathMigrations */
    private $pathMigrations;

    /** @var string $namespace */
    private $namespace;

    /** @var string $versionTableName */
    private $versionTableName;

    public function __construct(PDO $pdo, string $pathMigrations, string $namespace, string $versionTableName = "db_version")
    {
        $this->pdo              = $pdo;
        $this->pathMigrations   = $pathMigrations;
        $this->namespace        = $namespace;
        $this->versionTableName = $versionTableName;
    }

    public function getPdo() : PDO
    {
        return $this->pdo;
    }

    public function getPathMigrations() : string
    {
        return $this->pathMigrations;
    }

    public function getVersionTableName() : string
    {
        return $this->versionTableName;
    }

    public function getNamespace() : string
    {
        return $this->namespace;
    }
}
