<?php

namespace app\db\pgsql;

use app\db\ColumnSchemaBuilder;

class Schema extends \yii\db\pgsql\Schema
{
    public const TYPE_UUID = 'uuid';

    public function createColumnSchemaBuilder($type, $length = null): ColumnSchemaBuilder
    {
        return new ColumnSchemaBuilder($type, $length);
    }
}
