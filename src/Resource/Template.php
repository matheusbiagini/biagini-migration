<?php

declare(strict_types=1);

namespace AliceMigration\Resource;

class Template
{
    public static function getTemplate() : string
    {
        return '<?php

declare(strict_types=1);

namespace %s;

use AliceMigration\Management\Database\Database;
use AliceMigration\Migration\Migrate;

class %s implements Migrate
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
}';
    }
}
