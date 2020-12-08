<?php

use yii\db\Migration;

/**
 * Class m201207_182907_relational_database_fixes
 */
class m201207_182907_relational_database_fixes extends Migration
{
    public function safeUp() {
        $this->delete('log');
        $this->addForeignKey('fk_log_user', 'log', 'log_user_id', 'user', 'user_id');
        $this->addColumn('user', 'user_password_hash1', 'VARCHAR(20) NOT NULL');
        $this->addColumn('user', 'user_password_hash2', 'VARCHAR(20) NOT NULL');
        $this->addColumn('user', 'user_password_time', 'DATETIME NOT NULL');
        $this->addColumn('user', 'user_password_time_used', 'DATETIME NOT NULL');
    }

    public function safeDown() {
        $this->dropForeignKey('fk_log_user', 'log');
        $this->dropTable('password');
    }
}
