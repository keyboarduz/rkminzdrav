<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%leadership}}`.
 */
class m191025_091436_add_email_column_to_leadership_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%leadership}}', 'email', $this->string()->null()->comment('Email'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%leadership}}', 'email');
    }
}
