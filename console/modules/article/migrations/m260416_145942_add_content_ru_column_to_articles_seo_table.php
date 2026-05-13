<?php

namespace console\modules\article\migrations;

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%articles_seo}}`.
 */
final class m260416_145942_add_content_ru_column_to_articles_seo_table extends Migration
{
    private const TABLE_NAME = '{{%articles_seo}}';

    /**
     * {@inheritdoc}
     */
    public function up(): void
    {
        $this->addColumn(
            self::TABLE_NAME,
            'content_ru',
            $this->text()->comment('Содержимое статьи на русском языке')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down():void
    {
    }
}
