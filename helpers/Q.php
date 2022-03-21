<?php

namespace app\helpers;

use yii\db\Expression;

class Q
{
    /**
     * @var Expression[]
     */
    private static array $_e = [];

    public static function e(string $expression): Expression
    {
        return self::$_e[$expression] ?? (self::$_e[$expression] = new Expression($expression));
    }
}
