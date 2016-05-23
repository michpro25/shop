<?php

use yii\db\Migration;

class m160523_170143_create_article extends Migration
{
    public function up()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'photo' => $this->string(),
            'content' => $this->text()->notNull(),
            'seo_h1' => $this->string(),
            'seo_title' => $this->string(),
            'seo_content' => $this->text(),
            'status' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('idx-article-slug', '{{%article}}', 'slug');
        $this->createIndex('idx-article-status', '{{%article}}', 'status');
        $this->createIndex('idx-article-page_id', '{{%article}}', 'page_id');

        $this->addForeignKey('fk-article-page_id', '{{%article}}', 'page_id', '{{%page}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%article}}');
    }
}
