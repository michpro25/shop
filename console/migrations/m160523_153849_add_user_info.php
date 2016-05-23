<?php

use yii\db\Migration;

class m160523_153849_add_user_info extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'phone', $this->string());
        $this->addColumn('{{%user}}', 'address', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'address');
        $this->dropColumn('{{%user}}', 'phone');
    }
}
