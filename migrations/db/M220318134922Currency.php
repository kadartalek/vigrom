<?php

namespace app\migrations\db;

use app\db\Migration;

/**
 * @Migration
 */
class M220318134922Currency extends Migration
{
    private const TABLE = 'currency';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id'  => $this->uuid()->notNull()->pkMark()->defaultUuid(),
            'a_3' => $this->char(3)->unique()->notNull(),
            'n_3' => $this->char(3)->unique()->notNull(),
        ]);

        $this->createIndex(self::TABLE . '__ix01', self::TABLE, ['a_3']);
        $this->createIndex(self::TABLE . '__ix02', self::TABLE, ['n_3']);

        $this->batchInsert(self::TABLE, ['a_3', 'n_3'], [
            [
                'a_3' => 'RUR',
                'n_3' => '810',
            ],
            [
                'a_3' => 'USD',
                'n_3' => '840',
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
