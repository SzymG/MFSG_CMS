<?php

use yii\db\Migration;

/**
 * Class m201206_150855_alter_menu_table
 */
class m201206_150855_alter_menu_table extends Migration
{
    public function safeUp() {
        $this->addColumn('menu', 'is_only_for_authorized', 'TINYINT(1) NOT NULL DEFAULT 0');
        $this->dropColumn('menu', 'menu_login');
    }

    public function safeDown() {
        $this->dropColumn('menu', 'is_only_for_authorized');
        $this->addColumn('menu', 'menu_login', 'CHAR(1) NOT NULL');
    }
}
