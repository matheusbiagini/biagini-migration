<?php

declare(strict_types=1);

namespace AliceMigration\PathMigrations;

use AliceMigration\Management\Database\Database;
use AliceMigration\Migration\Migrate;

class MigrateVersion1547143302 implements Migrate
{
    /** {@inheritdoc} */
    public function up(Database $database) : void
    {
        //$database->getConnection()->executeQuery("");
    }

    /** {@inheritdoc} */
    public function down(Database $database) : void
    {
        //$database->getConnection()->executeQuery("");
    }
}