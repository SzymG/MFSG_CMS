<?php

use yii\db\Migration;

/**
 * Class m201206_214914_alter_user_table
 */
class m201206_214914_alter_user_table extends Migration
{

    public function safeUp()
    {
        $this->alterColumn('user', 'user_active', $this->tinyInteger(1)->notNull());
        $this->alterColumn('user', 'user_root', $this->tinyInteger(1)->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn('user', 'user_active', 'CHAR(1) NOT NULL');
        $this->alterColumn('user', 'user_root', 'CHAR(1) NOT NULL');

        return false;
    }

}
