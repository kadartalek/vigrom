<?php

namespace app\web\controllers;

use app\helpers\ArrayHelper;
use JetBrains\PhpStorm\ArrayShape;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\ErrorAction;

/**
 * @WebController
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge([
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ], []);
    }

    /**
     * {@inheritdoc}
     */
    #[ArrayShape(['error' => "string[]"])]
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return array
     */
    public function actionIndex(): array
    {
        return ['Hello'];
    }

    public function actionAdd(string $wallet, string $value, string $operation, string $reason): string
    {
        return bcadd('','');
    }

}
