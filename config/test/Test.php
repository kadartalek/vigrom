<?php

namespace app\config\test;

use app\config\common\Params;
use app\config\db;
use const I_AM_GROOT;

class Test
{
    public static function cfg()
    {
        /**
         * Application configuration shared by all test types
         */
        return [
            'id'         => 'basic-tests',
            'basePath'   => I_AM_GROOT,
            'aliases'    => [
                '@bower' => '@vendor/bower-asset',
                '@npm'   => '@vendor/npm-asset',
            ],
            'language'   => 'en-US',
            'components' => [
                'db'           => db\TestDb::cfg(),
                'mailer'       => [
                    'useFileTransport' => true,
                ],
                'assetManager' => [
                    'basePath' => __DIR__ . '/../www/assets',
                ],
                'urlManager'   => [
                    'showScriptName' => true,
                ],
                'user'         => [
                    'identityClass' => 'app\models\db\User',
                ],
                'request'      => [
                    'cookieValidationKey'  => 'test',
                    'enableCsrfValidation' => false,
                    // but if you absolutely need it set cookie domain to localhost
                    /*
                    'csrfCookie' => [
                        'domain' => 'localhost',
                    ],
                    */
                ],
            ],
            'params'     => Params::cfg(),
        ];
    }
}
