<?php /** @noinspection UndetectableTableInspection */

namespace app\db;

use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public static function find(): ActiveQuery
    {
        return Yii::createObject(ActiveQuery::class, [static::class]);
    }
}
