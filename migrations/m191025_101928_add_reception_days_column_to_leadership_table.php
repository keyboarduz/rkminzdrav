<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%leadership}}`.
 */
class m191025_101928_add_reception_days_column_to_leadership_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%leadership}}', 'reception_days', $this->string()->null()->comment('Qabul kunlari'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%leadership}}', 'reception_days');
    }
}
