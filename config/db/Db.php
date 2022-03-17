<?php

namespace app\config\db;

use app\db\Connection;

class Db
{
    public static function cfg(): array
    {
        return [
            'class'    => Connection::class,
            'dsn'      => 'pgsql:host=' . DB_HOST . ';dbname=yii2',
            'username' => 'yii2_user',
            'password' => DB_PASSWORD,
            'charset'  => 'utf8',
        ];
    }
}

