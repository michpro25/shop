<?php

use yii\db\Migration;

class m160523_170917_create_article_comment extends Migration
{
    public function up()
    {
        $this->createTable('{{%article_comment}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'email' => $this->string(),
            'name' => $this->string(),
            'content' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('idx-article_comment-article_id', '{{%article_comment}}', 'article_id');
        $this->createIndex('idx-article_comment-user_id', '{{%article_comment}}', 'user_id');

        $this->addForeignKey('fk-article_comment-article_id', '{{%article_comment}}', 'article_id', '{{%article}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-article_comment-user_id', '{{%article_comment}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%article_comment}}');
    }
}