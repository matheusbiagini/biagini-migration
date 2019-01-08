<?php

declare(strict_types=1);

namespace AliceMigration\Migration;

use AliceMigration\Management\Database\Database;

interface Migrate
{
    /** Run the migration command */
    public function up(Database $database) : void;

    /** Executes the migration rollback command */
    public function down(Database $database) : void;
}
