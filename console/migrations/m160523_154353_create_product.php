<?php

use yii\db\Migration;

class m160523_154353_create_product extends Migration
{
    public function up()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'price_old' => $this->decimal(10, 2),
            'count' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'seo_h1' => $this->string(),
            'seo_title' => $this->string(),
            'seo_content' => $this->text(),
        ]);

        $this->createIndex('idx-product-code', '{{%product}}', 'code', true);
        $this->createIndex('idx-product-status', '{{%product}}', 'status');
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}