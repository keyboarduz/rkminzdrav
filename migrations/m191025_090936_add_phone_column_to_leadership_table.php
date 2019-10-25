<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%leadership}}`.
 */
class m191025_090936_add_phone_column_to_leadership_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%leadership}}', 'phone', $this->string()->comment("Telefon raqami"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%leadership}}', 'phone');
    }
}
