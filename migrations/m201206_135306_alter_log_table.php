<?php

use yii\db\Migration;

/**
 * Class m201206_135306_alter_log_table
 */
class m201206_135306_alter_log_table extends Migration
{

    public function safeUp() {
        $this->addColumn('log', 'log_message', $this->string(512)->null());
    }

    public function safeDown() {
        $this->dropColumn('log', 'log_message');
    }
}
