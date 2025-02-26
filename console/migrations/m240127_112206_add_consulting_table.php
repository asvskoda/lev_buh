<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Таблица запросов на консультацию
 */
final class m240127_112206_add_consulting_table extends Migration
{
    private const TABLE_NAME = '{{%consulting_requests}}';

    /**
     * @inheritDoc
     */
    public function safeUp(): void
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string(13)->notNull(),
            'question' => $this->text()->notNull(),
            'is_active' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->datetime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('now()'),
            'soft_delete' => $this->boolean()->notNull()->defaultValue(false),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function safeDown(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
