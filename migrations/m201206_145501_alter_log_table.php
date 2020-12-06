<?php

use yii\db\Migration;

/**
 * Class m201206_145501_alter_log_table
 */
class m201206_145501_alter_log_table extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('log', 'log_user_id', 'INT(11) NULL');
    }

    public function safeDown()
    {
        $this->alterColumn('log', 'log_user_id', 'INT(11) NOT NULL');
    }

}
