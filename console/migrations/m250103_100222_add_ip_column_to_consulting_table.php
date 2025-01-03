<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Добавление столбца для хранения инфо об Ip
 */
final class m250103_100222_add_ip_column_to_consulting_table extends Migration
{
    private const TABLE_NAME = '{{%consulting_requests}}';
    private const ROW_NAME = 'ip';

    /**
     * @inheritDoc
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE_NAME, self::ROW_NAME, 'varchar(17)');
    }

    /**
     * @inheritDoc
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE_NAME, self::ROW_NAME);
    }
}
