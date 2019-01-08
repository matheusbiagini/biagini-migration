<?php

declare(strict_types=1);

namespace AliceMigration\Management\Service;

use AliceMigration\Management\Configuration\Configuration;
use AliceMigration\Management\Database\Connection;

trait TraitGetMigrations
{
    /**
     * @param Configuration $configuration
     * @return mixed[]
     */
    public function getMigrations(Configuration $configuration) : array
    {
        $executedScripts = array_map(
            function ($migrate) {
                return $migrate['version'];
            },
            $this->getMigrationsByDatabase(Connection::getInstance($configuration))
        );

        $dir      = $configuration->getPathMigrations();
        $fileList = scandir($dir);
        $fileList = array_filter($fileList, function ($file) {
            return $file !== '.' && $file !== '..';
        });

        return array_diff($fileList, $executedScripts);
    }

    /**
     * @param Connection $connection
     * @return mixed[]
     */
    private function getMigrationsByDatabase(Connection $connection) : array
    {
        $versionTableName = $connection->getConfiguration()->getVersionTableName();
        return $connection->getConnection()->fetchAll("SELECT * FROM {$versionTableName}");
    }
}
