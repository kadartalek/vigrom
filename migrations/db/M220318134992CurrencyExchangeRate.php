<?php

namespace app\migrations\db;

use app\db\Migration;
use yii\db\Query;

/**
 * @Migration
 */
class M220318134992CurrencyExchangeRate extends Migration
{
    private const TABLE = 'currency_exchange_rate';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'sell_id' => $this->uuid()->notNull(),
            'buy_id'  => $this->uuid()->notNull(),
            'rate'    => $this->money(10, 4)->notNull()->check('([[rate]] > 0)'),
            'CHECK ([[sell_id]] <> [[buy_id]])',
        ]);

        $this->addPrimaryKey(self::TABLE . '__pk', self::TABLE, ['sell_id', 'buy_id']);

        $this->createIndex(self::TABLE . '__ix01', self::TABLE, ['sell_id']);
        $this->createIndex(self::TABLE . '__ix02', self::TABLE, ['buy_id']);

        $this->addForeignKey(self::TABLE . '__fk01', self::TABLE, ['sell_id'], 'currency', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey(self::TABLE . '__fk02', self::TABLE, ['buy_id'], 'currency', ['id'], 'CASCADE', 'CASCADE');

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
