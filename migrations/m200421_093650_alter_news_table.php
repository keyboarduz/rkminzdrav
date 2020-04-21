<?php

use yii\db\Migration;

/**
 * Class m200421_093650_alter_news_table
 */
class m200421_093650_alter_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            ALTER TABLE news 
            CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200421_093650_alter_news_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200421_093650_alter_news_table cannot be reverted.\n";

        return false;
    }
    */
}
