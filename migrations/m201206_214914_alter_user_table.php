<?php

use yii\db\Migration;

/**
 * Class m201206_214914_alter_user_table
 */
class m201206_214914_alter_user_table extends Migration
{

    public function safeUp()
    {
        $true_root = (new \yii\db\Query())
            ->select(['user_id'])
            ->from('user')
            ->where(['user_root' => 'y'])
            ->all();

        $true_active = (new \yii\db\Query())
            ->select(['user_id'])
            ->from('user')
            ->where(['user_active' => 'y'])
            ->all();

        $this->alterColumn('user', 'user_active', $this->tinyInteger(1)->notNull());
        $this->alterColumn('user', 'user_root', $this->tinyInteger(1)->notNull());
        $this->update('user', ['user_root' => 1], ['user_id' => $true_root]);
        $this->update('user', ['user_active' => 1], ['user_id' => $true_active]);
    }

    public function safeDown()
    {
        $true_root = (new \yii\db\Query())
            ->select(['user_id'])
            ->from('user')
            ->where(['user_root' => 1])
            ->all();

        $true_active = (new \yii\db\Query())
            ->select(['user_id'])
            ->from('user')
            ->where(['user_active' => 1])
            ->all();

        $false_root = (new \yii\db\Query())
            ->select(['user_id'])
            ->from('user')
            ->where(['user_root' => 0])
            ->all();

        $false_active = (new \yii\db\Query())
            ->select(['user_id'])
            ->from('user')
            ->where(['user_active' => 0])
            ->all();

        $this->alterColumn('user', 'user_active', 'CHAR(1) NOT NULL');
        $this->alterColumn('user', 'user_root', 'CHAR(1) NOT NULL');
        $this->update('user', ['user_root' => 'y'], ['user_id' => $true_root]);
        $this->update('user', ['user_active' => 'y'], ['user_id' => $true_active]);
        $this->update('user', ['user_root' => 'n'], ['user_id' => $false_root]);
        $this->update('user', ['user_active' => 'n'], ['user_id' => $false_active]);

        return false;
    }

}
