<?php

namespace app\config\db;

class TestDb
{
    public static function cfg(): array
    {
        $db = Db::cfg();

        $db['dsn'] = 'pgsql:host=' . DB_HOST . ';dbname=yii2_test';

        return $db;
    }
}
