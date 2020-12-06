<?php

use yii\db\Migration;

class m201206_141410_remove_error404_table extends Migration
{
    public function safeUp()
    {
        $this->dropTable('error404');
    }

    public function safeDown()
    {

    }
}
