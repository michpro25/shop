<?php

use yii\db\Migration;

class m160523_162119_create_review extends Migration
{
    public function up()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'rating' => $this->integer(),
            'content' => $this->text(),
            'status' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('idx-review-product_id', '{{%review}}', 'product_id');
        $this->createIndex('idx-review-user_id', '{{%review}}', 'user_id');
        $this->createIndex('idx-review-status', '{{%review}}', 'status');

        $this->addForeignKey('fk-review-product_id', '{{%review}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-review-user_id', '{{%review}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%review}}');
    }
}
