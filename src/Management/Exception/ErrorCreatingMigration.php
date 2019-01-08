<?php

declare(strict_types=1);

namespace AliceMigration\Management\Exception;

class ErrorCreatingMigration extends \RuntimeException implements \Throwable
{
    public function __construct(string $version)
    {
        parent::__construct("There was an error trying to create the migration with the version {$version}.");
    }
}
