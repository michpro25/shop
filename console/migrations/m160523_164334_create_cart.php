<?php

use yii\db\Migration;

class m160523_164334_create_cart extends Migration
{
    public function up()
    {
        $this->createTable('{{%cart}}', [
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-cart', '{{%cart}}', ['product_id', 'user_id']);

        $this->createIndex('idx-cart-product_id', '{{%cart}}', 'product_id');
        $this->createIndex('idx-cart-user_id', '{{%cart}}', 'user_id');

        $this->addForeignKey('fk-cart-product_id', '{{%cart}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-cart-user_id', '{{%cart}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%cart}}');
    }
}
