<?php

namespace app\migrations\db;

use app\db\Migration;

/**
 * @Migration
 */
class M220318135015TransactionType extends Migration
{
    private const TABLE = 'transaction_type';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->string(6)->notNull()->pkMark(),
        ]);

        $this->batchInsert(self::TABLE, ['id'], [
            [
                'id' => 'debit',
            ],
            [
                'id' => 'credit',
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
