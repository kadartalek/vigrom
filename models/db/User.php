<?php

namespace app\models\db;

use app\db\ActiveRecord;
use app\queries\db\UserQuery;
use JetBrains\PhpStorm\ArrayShape;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $login
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find(): UserQuery
    {
        return Yii::createObject(UserQuery::class, [static::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id'], 'string'],
            [['login'], 'required'],
            [['login'], 'string', 'max' => 255],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    #[ArrayShape(['id' => "string", 'login' => "string"])]
    public function attributeLabels(): array
    {
        return [
            'id'    => 'ID',
            'login' => 'Login',
        ];
    }
}
