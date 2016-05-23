<?php

use yii\db\Migration;

class m160523_155307_create_category extends Migration
{
    public function up()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'lvl' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'seo_h1' => $this->string(),
            'seo_title' => $this->string(),
            'seo_content' => $this->text(),
        ]);

        $this->createIndex('idx-category-slug', '{{%category}}', 'slug');
        $this->createIndex('idx-category-status', '{{%category}}', 'status');

        $this->createTable('{{%product_category}}', [
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-product_category', '{{%product_category}}', ['product_id', 'category_id']);

        $this->createIndex('idx-product_category-product_id', '{{%product_category}}', 'product_id');
        $this->createIndex('idx-product_category-category_id', '{{%product_category}}', 'category_id');

        $this->addForeignKey('fk-product_category-product_id', '{{%product_category}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product_category-category_id', '{{%product_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'RESTRICT');

        $this->addColumn('{{%product}}', 'main_category_id', $this->integer());

        $this->createIndex('idx-product-main_category_id', '{{%product}}', 'main_category_id');

        $this->addForeignKey('fk-product-main_category_id', '{{%product}}', 'main_category_id', '{{%category}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk-product-main_category_id', '{{%product}}');

        $this->dropColumn('{{%product}}', 'main_category_id');

        $this->dropTable('{{%product_category}}');
        $this->dropTable('{{%category}}');
    }
}