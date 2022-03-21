<?php

namespace app\db;

use app\db\pgsql\Schema;

trait SchemaBuilderAdvancedTrait
{
    public function uuid($length = null): ColumnSchemaBuilder
    {
        return $this->getDb()->schema->createColumnSchemaBuilder(Schema::TYPE_UUID, $length);
    }
}
