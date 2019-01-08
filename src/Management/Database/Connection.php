<?php

declare(strict_types=1);

namespace AliceMigration\Management\Database;

use AliceMigration\Management\Configuration\Configuration;
use Doctrine\DBAL\DriverManager;

class Connection
{
    /** @var Configuration $configuration */
    private $configuration;

    /** @var Connection */
    private static $CONNECTION_INSTANCE;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public static function getInstance(Configuration $configuration) : self
    {
        if (self::$CONNECTION_INSTANCE === null) {
            self::$CONNECTION_INSTANCE = new self($configuration);
        }
        return static::$CONNECTION_INSTANCE;
    }

    /**
     * Return Dbal instance
     */
    public function getConnection() : \Doctrine\DBAL\Connection
    {
        return DriverManager::getConnection(
            ['pdo' => $this->configuration->getPdo()],
            new \Doctrine\DBAL\Configuration()
        );
    }

    public function getConfiguration() : Configuration
    {
        return $this->configuration;
    }
}
