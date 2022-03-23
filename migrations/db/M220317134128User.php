<?php

namespace app\migrations\db;

use app\db\Migration;

/**
 * @Migration
 */
class M220317134128User extends Migration
{
    private const TABLE = 'user';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id'    => $this->uuid()->notNull()->pkMark()->defaultUuid(),
            'login' => $this->string()->unique()->notNull(),
        ]);

        $this->createIndex(self::TABLE . '__ix01', self::TABLE, ['login']);
        $this->insert(self::TABLE, ['login' => 'user_rub']);
        $this->insert(self::TABLE, ['login' => 'user_usd']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
