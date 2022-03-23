<?php

namespace app\migrations\db;

use app\db\Migration;

/**
 * @Migration
 */
class M220318135025UserWalletHistory extends Migration
{
    private const TABLE = 'wallet_history';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id'                  => $this->uuid()->notNull()->pkMark()->defaultUuid(),
            'wallet_id'           => $this->uuid()->notNull(),
            'transaction_type_id' => $this->string(6)->notNull(),
            'value'               => $this->money(10, 2)->notNull()->defaultValue(0.0)->check('[[value]] > 0.0'),
            'reason'              => $this->string()->notNull()->check('CHAR_LENGTH([[reason]]) > 0'),
        ]);

        $this->addForeignKey(self::TABLE . '__fk01', self::TABLE, ['wallet_id'], 'wallet', ['id'], 'RESTRICT', 'CASCADE');
        $this->addForeignKey(self::TABLE . '__fk02', self::TABLE, ['transaction_type_id'], 'transaction_type', ['id'], 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
