<?php

use yii\db\Migration;

/**
 * Class m200612_165725_add_column_for_contact_table
 */
class m200612_165725_add_column_for_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%contact}}', 'phone', $this->string(30));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{%contact}}', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200612_165725_add_column_for_contact_table cannot be reverted.\n";

        return false;
    }
    */
}
