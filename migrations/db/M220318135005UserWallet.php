<?php

namespace app\migrations\db;

use app\db\Migration;
use yii\db\Query;

/**
 * @Migration
 */
class M220318135005UserWallet extends Migration
{
    private const TABLE = 'wallet';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id'          => $this->uuid()->notNull()->pkMark(),
            'currency_id' => $this->uuid()->notNull(),
            'value'       => $this->money(10, 2)->notNull()->defaultValue(0.0)->check('[[value]] >= 0.0'),
        ]);

        $this->addForeignKey(self::TABLE . '__fk01', self::TABLE, ['id'], 'user', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey(self::TABLE . '__fk02', self::TABLE, ['currency_id'], 'currency', ['id'], 'RESTRICT', 'CASCADE');

        $r = (new Query())->select('id')->from('currency')->where(['a_3' => 'RUR'])->scalar();
        $d = (new Query())->select('id')->from('currency')->where(['a_3' => 'USD'])->scalar();

        $ru = (new Query())->select('id')->from('user')->where(['login' => 'user_rub'])->scalar();
        $du = (new Query())->select('id')->from('user')->where(['login' => 'user_usd'])->scalar();

        $this->batchInsert(self::TABLE, ['id', 'currency_id', 'value'], [
            [
                'id'          => $ru,
                'currency_id' => $r,
                'value'       => '0.0',
            ],
            [
                'id'          => $du,
                'currency_id' => $d,
                'value'       => '0.0',
            ],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
