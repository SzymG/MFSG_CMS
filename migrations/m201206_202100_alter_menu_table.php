<?php

use yii\db\Migration;

/**
 * Class m201206_202100_alter_menu_table
 */
class m201206_202100_alter_menu_table extends Migration
{

    public function safeUp()
    {
        $this->dropColumn('menu', 'menu_sub');
        $this->addColumn('menu', 'menu_parent_id', 'INT(11) NULL');
    }

    public function safeDown()
    {
        $this->addColumn('menu', 'menu_sub', 'INT(11) NOT NULL');
        $this->dropColumn('menu', 'menu_parent_id');
    }
}
