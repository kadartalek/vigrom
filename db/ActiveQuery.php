<?php

namespace app\db;

use yii\db\Connection;

/**
 * @see \app\db\ActiveRecord
 */
class ActiveQuery extends \yii\db\ActiveQuery
{
    /**
     * @param string          $q
     * @param Connection|null $db
     *
     * @return int
     */
    public function countInt(string $q = '*', ?Connection $db = null): int
    {
        return (int)$this->count($q, $db);
    }
}
