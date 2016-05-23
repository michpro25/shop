<?php

use yii\db\Migration;

class m160523_164728_create_order extends Migration
{
    public function up()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'comment' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('idx-order-user_id', '{{%order}}', 'user_id');
        $this->createIndex('idx-order-status', '{{%order}}', 'status');

        $this->addForeignKey('fk-order-user_id', '{{%order}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'count' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-order_item-order_id', '{{%order_item}}', 'order_id');
        $this->createIndex('idx-order_item-product_id', '{{%order_item}}', 'product_id');

        $this->addForeignKey('fk-order_item-order_id', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-order_item-product_id', '{{%order_item}}', 'product_id', '{{%product}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');
    }
}