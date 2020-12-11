<?php

use yii\db\Migration;

/**
 * Class m201211_180058_alter_page_table
 */
class m201211_180058_alter_page_table extends Migration
{
    public function safeUp()
    {

        $this->alterColumn('page', 'page_main', $this->tinyInteger(1)->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn('page', 'page_main', 'CHAR(1) NOT NULL');

    }


}
