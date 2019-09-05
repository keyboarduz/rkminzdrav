<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m190814_090325_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'COMMENT="Sayt yangiliklari jadvali" CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->comment('Yangilik muallifi'),
            'category_id' => $this->integer()->comment('Yangilik kategoriyasi'),
            'title' => $this->string()->notNull()->comment('Mavzu'),
            'content' => $this->text()->notNull()->comment('Yangilik kontenti'),
            'status' => $this->integer()->defaultValue(10)->comment('Status'),
            'viewed' => $this->integer()->defaultValue(0)->comment('Ko\'rishlar soni'),
            'created_at' => $this->integer()->notNull()->comment('Yaratilgan vaqti'),
            'updated_at' => $this->integer()->notNull()->comment('O\'zgartirilgan vaqti'),
        ], $tableOptions);

        $this->createIndex(
            '{{%idx-news-author_id}}',
            '{{%news}}',
            'author_id'
        );

        $this->addForeignKey(
            '{{%fk-news-author_id}}',
            '{{%news}}',
            'author_id',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-news-category_id}}',
            '{{%news}}',
            'category_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-news-author_id}}',
            '{{%news}}'
        );

        $this->dropIndex(
            '{{%idx-news-author_id}}',
            '{{%news}}'
        );

        $this->dropIndex(
            '{{%idx-news-category_id}}',
            '{{%news}}'
        );

        $this->dropTable('{{%news}}');
    }
}
