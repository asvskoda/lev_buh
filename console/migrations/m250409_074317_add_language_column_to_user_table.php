<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles adding column "language" to table `{{%user}}`.
 */
final class m250409_074317_add_language_column_to_user_table extends Migration
{
    private const TABLE_NAME = '{{%user}}';
    private const FIELD_LANGUAGE = 'language';

    /**
     * {@inheritdoc}
     */
    public function up(): void
    {
        $this->addColumn(
            self::TABLE_NAME,
            self::FIELD_LANGUAGE,
            $this->string(5)->defaultValue('uk')->comment('User preferred language')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down(): void
    {
        $this->dropColumn(self::TABLE_NAME, self::FIELD_LANGUAGE);
    }
}
