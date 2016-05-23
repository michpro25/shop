<?php

use yii\db\Migration;

class m160523_152018_add_user_indexes extends Migration
{
    public function up()
    {
        $this->createIndex('idx-user-status', '{{%user}}', 'status');
    }

    public function down()
    {
        $this->dropIndex('idx-user-status', '{{%user}}');
    }
}
