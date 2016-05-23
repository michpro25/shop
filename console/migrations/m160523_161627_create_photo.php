<?php

use yii\db\Migration;

class m160523_161627_create_photo extends Migration
{
    public function up()
    {
        $this->createTable('{{%photo}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'file' => $this->string(),
            'sort' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('idx-photo-product_id', '{{%photo}}', 'product_id');
        $this->createIndex('idx-photo-sort', '{{%photo}}', 'sort');

        $this->addForeignKey('fk-photo-product_id', '{{%photo}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');

        $this->addColumn('{{%product}}', 'main_photo_id', $this->integer());

        $this->createIndex('idx-product-main_photo_id', '{{%product}}', 'main_photo_id');

        $this->addForeignKey('fk-product-main_photo_id', '{{%product}}', 'main_photo_id', '{{%photo}}', 'id', 'RESTRICT', 'RESTRICT');

    }

    public function down()
    {
        $this->dropForeignKey('fk-product-main_photo_id', '{{%product}}');

        $this->dropColumn('{{%product}}', 'main_photo_id');

        $this->dropTable('{{%photo}}');
    }
}
