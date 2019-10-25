<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%general_information}}`.
 */
class m191023_112748_create_general_information_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%general_information}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%general_information}}');
    }
}
