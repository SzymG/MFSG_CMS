<?php

use yii\db\Migration;

/**
 * Class m201211_180058_alter_page_table
 */
class m201211_180058_alter_page_table extends Migration
{
    public function safeUp()
    {
        $true_column = (new \yii\db\Query())
            ->select(['page_id'])
            ->from('page')
            ->where(['page_main' => 'y'])
            ->all();

        $this->alterColumn('page', 'page_main', $this->tinyInteger(1)->notNull());
        $this->update('page', ['page_main' => 1], ['page_id' => $true_column]);
    }

    public function safeDown()
    {
        $true_column = (new \yii\db\Query())
            ->select(['page_id'])
            ->from('page')
            ->where(['page_main' => 1])
            ->all();

        $false_column = (new \yii\db\Query())
            ->select(['page_id'])
            ->from('page')
            ->where(['page_main' => 0])
            ->all();

        $this->alterColumn('page', 'page_main', 'CHAR(1) NOT NULL');
        $this->update('page', ['page_main' => 'y'], ['page_id' => $true_column]);
        $this->update('page', ['page_main' => 'n'], ['page_id' => $false_column]);

    }


}
