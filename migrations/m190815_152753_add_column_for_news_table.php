<?php

use yii\db\Migration;

/**
 * Class m190815_152753_add_column_for_news_table
 */
class m190815_152753_add_column_for_news_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%news}}', 'image_url', $this->text()->notNull()->comment('Asosiy foto'));
    }

    public function down()
    {
        $this->dropColumn('{{%news}}', 'image_url');
    }

}
