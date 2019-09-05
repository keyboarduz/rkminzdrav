<?php

use yii\db\Migration;

/**
 * Class m190821_191748_add_column_for_news_table
 */
class m190821_191748_add_column_for_news_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%news}}', 'description', $this->string()->null());
    }

    public function down()
    {
        $this->dropColumn('{{%news}}', 'description');
    }

}
