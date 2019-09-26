<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%organization}}`.
 */
class m190919_125445_create_organization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%organization}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull(),
            'photo' => $this->string(),
            'leader' => $this->string(),
            'address' => $this->text()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->text(),
            'site' => $this->string(),
            'category' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%organization}}');
    }
}
