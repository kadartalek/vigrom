<?php

namespace app\db;

use app\helpers\Q;

class ColumnSchemaBuilder extends \yii\db\ColumnSchemaBuilder
{
    protected bool $isPk = false;

    public function pkMark(): static
    {
        $this->isUnique = false;
        $this->isPk     = true;

        return $this;
    }

    public function unique(): static
    {
        $this->isUnique = true;
        $this->isPk     = false;

        return $this;
    }

    protected function buildUniqueString(): string
    {
        return $this->isPk ? ' PRIMARY KEY' : parent::buildUniqueString();
    }

    public function defaultUuid(): static
    {
        return $this->defaultExpression(Q::e('uuid_generate_v7()'));
    }
}
