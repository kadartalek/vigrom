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
            'value'       => $this->money(10, 2)->notNull(),
        ]);

        $this->addForeignKey(self::TABLE . '__fk01', self::TABLE, ['id'], 'user', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey(self::TABLE . '__fk02', self::TABLE, ['buy_id'], 'currency', ['id'], 'RESTRICT', 'CASCADE');

        $r = (new Query())->select('id')->from('currency')->where(['a_3' => 'RUR'])->scalar();
        $d = (new Query())->select('id')->from('currency')->where(['a_3' => 'USD'])->scalar();

        $this->batchInsert(self::TABLE, ['sell_id', 'buy_id', 'rate'], [
            [
                'sell_id' => $r,
                'buy_id'  => $d,
                'rate'    => '0.0093',
            ],
            [
                'sell_id' => $d,
                'buy_id'  => $r,
                'rate'    => '103.02',
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
