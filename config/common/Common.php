<?php


namespace app\config\common;

use app\config\db\Db;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Finder\Finder;
use yii\debug\Module as DebugModule;
use yii\gii\Module as GiiModule;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;

class Common
{
    #[Pure] #[ArrayShape([
        'basePath'   => "false|string",
        'bootstrap'  => "string[]",
        'language'   => "string",
        'components' => "array",
        'aliases'    => "string[]",
        'params'     => "string[]",
    ])]
    public static function cfg(): array
    {
        $config = [
            'basePath'   => I_AM_GROOT,
            'bootstrap'  => ['log'],
            'language'   => 'ru-RU',
            'components' => [
                'log'    => [
                    'targets' => [
                        [
                            'class'  => FileTarget::class,
                            'levels' => ['error', 'warning'],
                        ],
                    ],
                ],
                'i18n'   => [
                    'translations' => [
                        'app*' => [
                            'class' => PhpMessageSource::class,
                        ],
                    ],
                ],
                'db'     => Db::cfg(),
                'finder' => [
                    'class' => Finder::class,
                ],
            ],
            'aliases'    => [
                '@web'     => '/',
                '@webroot' => '@app/www',
                '@runtime' => '@app/runtime',
                '@bower'   => '@vendor/bower-asset',
                '@npm'     => '@vendor/npm-asset',
            ],
            'params'     => Params::cfg(),
        ];

        if (YII_ENV_DEV) {
            $config['bootstrap']['gii']   = 'gii';
            $config['modules']['gii']     = [
                'class'       => GiiModule::class,
                'newFileMode' => 0664,
                'newDirMode'  => 0775,
            ];
            $config['bootstrap']['debug'] = 'debug';
            $config['modules']['debug']   = [
                'class'    => DebugModule::class,
                'dirMode'  => 0775,
                'fileMode' => 0664,
            ];
        }

        return $config;
    }
}
