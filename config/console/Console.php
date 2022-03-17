<?php

namespace app\config\console;

use app\config\common\Common;
use app\console\controllers\MigrateController;
use app\helpers\ArrayHelper;
use yii\console\controllers\ServeController;

class Console
{
    public static function cfg(): array
    {
        $config = [
            'id'                  => 'app-console',
            'controllerNamespace' => 'app\\console\\controllers',
            'controllerMap'       => [
                'migrate' => [
                    'class'               => MigrateController::class,
                    'migrationPath'       => null,
                    'migrationNamespaces' => ['app\\migrations\\db'],
                    'templateFile'        => '@app/views/migration.php',
                ],
                'serve'   => [
                    'class'   => ServeController::class,
                    'docroot' => '@webroot',
                ],
            ],
        ];

        return ArrayHelper::merge(Common::cfg(), $config);
    }
}
