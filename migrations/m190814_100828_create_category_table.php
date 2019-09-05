<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m190814_100828_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('Kategiya nomi'),
            'description' => $this->text()->comment('Tavsif'),
        ]);

        $this->addForeignKey(
            '{{%fk-news-category_id}}',
            '{{%news}}',
            'category_id',
            '{{%category}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-news-category_id}}',
            '{{%news}}'
        );

        $this->dropTable('{{%category}}');
    }
}
