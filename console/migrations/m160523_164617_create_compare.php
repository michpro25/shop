<?php

use yii\db\Migration;

class m160523_164617_create_compare extends Migration
{
    public function up()
    {
        $this->createTable('{{%compare}}', [
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-compare', '{{%compare}}', ['product_id', 'user_id']);

        $this->createIndex('idx-compare-product_id', '{{%compare}}', 'product_id');
        $this->createIndex('idx-compare-user_id', '{{%compare}}', 'user_id');

        $this->addForeignKey('fk-compare-product_id', '{{%compare}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-compare-user_id', '{{%compare}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%compare}}');
    }
}
