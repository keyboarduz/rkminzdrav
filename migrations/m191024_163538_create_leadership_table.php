<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leadership}}`.
 */
class m191024_163538_create_leadership_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%leadership}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Ism sharifi'),
            'position' => $this->string()->notNull()->comment('Lavozimi'),
            'photo' => $this->string()->comment('Rasmi'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%leadership}}');
    }
}
