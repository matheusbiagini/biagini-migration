<?php

declare(strict_types=1);

namespace AliceMigration\Management\Service;

use AliceMigration\Management\Configuration\Configuration;
use AliceMigration\Management\Database\Connection;
use AliceMigration\Management\Database\Database;
use AliceMigration\Management\Database\Version;
use Symfony\Component\Console\Output\OutputInterface;

class Migrate
{
    /** @var Configuration $configuration */
    private $configuration;

    /** @var OutputInterface $output */
    private $output;

    /** @var Connection $connection */
    private $connection;

    use TraitGetMigrations;

    public function __construct(Configuration $configuration, ?OutputInterface $output = null)
    {
        $this->configuration = $configuration;
        $this->output        = $output;
        $this->connection    = Connection::getInstance($this->configuration);
    }

    public function migrate(bool $rollback = false, bool $debugError = false) : bool
    {
        Version::generate($this->configuration);

        if (!empty($this->output)) {
            $this->output->writeln(sprintf("* Rollback %s.", $rollback === true ? 'activated' : 'disabled'));
            $this->output->writeln(sprintf("* Debug error %s.", $debugError === true ? 'activated' : 'disabled'));
        }

        $migrations = $this->getMigrations($this->configuration);

        if (!empty($this->output) && count($migrations) === 0) {
            $this->output->writeln("No migration to run.");
            return true;
        }

        $this->execute($migrations, $rollback, $debugError);

        return true;
    }

    public function revert(string $filename, bool $rollback = true, bool $removeFile = true) : bool
    {
        $path = $this->configuration->getPathMigrations() . $filename;

        if (!file_exists($path)) {
            if (!empty($this->output)) {
                $this->output->writeln("Filename not found in {$path}.");
            }
            return true;
        }

        $version = Version::getByVersion($this->configuration, $filename);

        if (count($version) === 0) {
            if (!empty($this->output)) {
                $this->output->writeln("Migration {$filename} not found in database.");
            }
            return false;
        }

        if ($rollback) {
            $this->executeDown($filename, false);
        }

        if ($removeFile) {
            unlink($path);
            if (!empty($this->output)) {
                $this->output->writeln("filename {$filename} deleted.");
            }
        }

        Version::deleteByVersion($this->configuration, $filename);

        if (!empty($this->output)) {
            $this->output->writeln("Successfully reverted migration.");
        }

        return true;
    }

    private function execute(array $migrations, bool $rollback = false, bool $debugError = false) : void
    {
        foreach ($migrations as $migrate) {
            if (strpos($migrate, '.php') === false) {
                continue;
            }

            if (!empty($this->output)) {
                $this->output->writeln("Migration {$migrate} running.");
            }

            $current = $this->executeUp($migrate, $debugError);

            if ($rollback === true) {
                if (!$current) {
                    $this->executeDown($migrate, $debugError);
                }
                continue;
            }
        }
    }

    private function executeDown(string $version, bool $debugError) : bool
    {
        try {
            $migrate = $this->getMigration($this->configuration->getNamespace(), $version);
            $migrate->down(new Database($this->connection));
            if (!empty($this->output)) {
                $this->output->writeln("Rollback trigger {$version} completed successfully.");
            }
            return true;
        } catch (\Throwable $exception) {
            if (!empty($this->output) && $debugError) {
                $this->output->writeln("
                    Rollback error: {$exception->getMessage()}. Error Tracer: {$exception->getTraceAsString()}
                ");
            }
            return false;
        }
    }

    private function executeUp(string $version, bool $debugError) : bool
    {
        try {
            $migrate = $this->getMigration($this->configuration->getNamespace(), $version);
            $migrate->up(new Database($this->connection));
            Version::create($this->configuration, $version);
            if (!empty($this->output)) {
                $this->output->writeln("Migration {$version} completed successfully.");
            }
            return true;
        } catch (\Throwable $exception) {
            if (!empty($this->output) && $debugError) {
                $this->output->writeln("
                    Migration error: {$exception->getMessage()}. Tracer: {$exception->getTraceAsString()}
                ");
            }
            return false;
        }
    }

    private function getMigration(string $namespace, string $version) : \AliceMigration\Migration\Migrate
    {
        $className = "\\{$namespace}\\" . str_replace('.php', '', $version);
        return new $className;
    }
}
