<?php

use yii\db\Migration;

class m160523_165649_create_page extends Migration
{
    public function up()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'seo_h1' => $this->string(),
            'seo_title' => $this->string(),
            'seo_content' => $this->text(),
            'status' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('idx-page-slug', '{{%page}}', 'slug');
        $this->createIndex('idx-page-status', '{{%page}}', 'status');

        $this->addForeignKey('fk-page-parent_id', '{{%page}}', 'parent_id', '{{%page}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
