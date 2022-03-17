<?php

namespace app\config\web;

use app\config\common\Common;
use app\helpers\ArrayHelper;
use app\models\db\User;

class Web
{
    public static function cfg(): array
    {
        $config = [
            'id'                  => 'basic',
            'controllerNamespace' => 'app\\web\\controllers',
            'viewPath'            => '@app/web/views',
            'components'          => [
                'request'      => [
                    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                    'cookieValidationKey' => 'KtRgSmAyt3EitqkTmb97vKIn2K9Um7ZH',
                ],
                'user'         => [
                    'identityClass'   => User::class,
                    'enableAutoLogin' => true,
                ],
                'errorHandler' => [
                    'errorAction' => 'site/error',
                ],
                'urlManager'   => [
                    'enablePrettyUrl' => true,
                    'showScriptName'  => false,
                    'rules'           => [
                        '<controller>/<action>' => '<controller>/<action>',
                    ],
                ],
            ],
        ];

        return ArrayHelper::merge(Common::cfg(), $config);
    }
}
