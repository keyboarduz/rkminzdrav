<?php

use yii\db\Migration;

/**
 * Class m191031_180756_add_type_document_to_document_table
 */
class m191031_180756_add_type_document_to_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%document}}', 'type_document', $this->smallInteger()->null());
        $this->renameColumn('{{%document}}', 'type', 'category');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%document}}', 'type_document');
        $this->renameColumn('{{%document}}', 'category', 'type');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191031_180756_add_type_document_to_document_table cannot be reverted.\n";

        return false;
    }
    */
}
