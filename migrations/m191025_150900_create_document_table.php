<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%document}}`.
 */
class m191025_150900_create_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%document}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Hujjat nomi'),
            'date_of_admission' => $this->date()->null()->comment('Qabul qilinish sanasi'),
            'type' => $this->smallInteger()->notNull()->comment('Hujjat turi'),
            'file' => $this->string()->null()->comment('Hujjat fayli nomi'),
            'description' => $this->text()->null()->comment('Hujjat tavsifi'),
            'content' => $this->text()->null()->comment('Hujjat kontenti'),
            'document_number' => $this->string()->null()->comment('Hujjat raqami'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%document}}');
    }
}
