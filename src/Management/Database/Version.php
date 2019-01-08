<?php

declare(strict_types=1);

namespace AliceMigration\Management\Database;

use AliceMigration\Management\Configuration\Configuration;

abstract class Version
{
    public static function generate(Configuration $configuration) : void
    {
        $connection = Connection::getInstance($configuration);

        $connection->getConnection()->exec(
            sprintf("
                CREATE TABLE IF NOT EXISTS %s (
                    id BIGINT NOT NULL AUTO_INCREMENT,
                    version VARCHAR(50) NULL,
                    create_date INT NULL,
                    PRIMARY KEY (id)
                );
            ", $configuration->getVersionTableName())
        );
    }

    public static function create(Configuration $configuration, string $version) : void
    {
        $connection = Connection::getInstance($configuration);

        $connection->getConnection()->exec(sprintf("
            INSERT INTO %s (version, create_date) VALUES ('%s', %s);
        ", $configuration->getVersionTableName(), $version, time()));
    }

    /**
     * @param \AliceMigration\Management\Configuration\Configuration $configuration
     * @param string                                                 $version
     * @return mixed[]
     */
    public static function getByVersion(Configuration $configuration, string $version) : array
    {
        $connection = Connection::getInstance($configuration);

        return $connection->getConnection()->fetchAll(
            sprintf("SELECT dbVersion.* FROM %s as dbVersion WHERE dbVersion.version = '%s'", $configuration->getVersionTableName(), $version)
        );
    }

    public static function deleteByVersion(Configuration $configuration, string $version) : void
    {
        $connection = Connection::getInstance($configuration);

        $connection->getConnection()->exec(
            sprintf("DELETE FROM %s WHERE version = '%s'", $configuration->getVersionTableName(), $version)
        );
    }
}
