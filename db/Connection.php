<?php

namespace app\db;

use app\db\pgsql\Schema;

/**
 * @property-read Schema $schema
 * @method Schema getSchema()
 */
class Connection extends \yii\db\Connection
{
    public function init(): void
    {
        $this->schemaMap['pgsql'] = Schema::class;
    }
}
