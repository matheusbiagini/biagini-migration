<?php

declare(strict_types=1);

namespace AliceMigration\Management\Service;

use AliceMigration\Management\Configuration\Configuration;
use AliceMigration\Management\Database\Version;
use AliceMigration\Management\Exception\ErrorCreatingMigration;

class CreateMigration
{
    /** @var Configuration $configuration */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function create(string $version) : bool
    {
        $filename = sprintf('%s/%s.php', $this->configuration->getPathMigrations(), $version);

        try {
            Version::generate($this->configuration);
            file_put_contents($filename, $this->template($version, $this->configuration->getNamespace()));
            chmod($filename, fileperms($filename) | 128 + 16 + 2);
            return true;
        } catch (\Throwable $exception) {
            throw new ErrorCreatingMigration($filename);
        }
    }

    private function template(string $className, string $namespace) : string
    {
        return sprintf(
            file_get_contents(getcwd().'/src/Resource/Template.class'),
            $namespace,
            $className
        );
    }
}
