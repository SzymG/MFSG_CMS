<?php

use yii\db\Migration;


class m201129_211133_alter_menu_table extends Migration
{

    public function safeUp()
    {
        $this->delete('menu');
    }

    public function safeDown()
    {

    }
}
