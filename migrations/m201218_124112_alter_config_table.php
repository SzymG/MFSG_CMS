<?php

use yii\db\Migration;

/**
 * Class m201218_124112_alter_config_table
 */
class m201218_124112_alter_config_table extends Migration
{

    public function safeUp()
    {
        $this->execute('INSERT INTO `config` (`config_id`, `config_name`, `config_value`) VALUES
            (6, \'smtp_class\', \'\'),
            (7, \'smtp_host\', \'\'),
            (8, \'smtp_password\', \'\'),
            (9, \'smtp_port\', \'\'),
            (10, \'smtp_encryption\', \'\');
            ');
    }

    public function safeDown()
    {
        $config = Config::findOne(6);
        $config->delete();
        $config = Config::findOne(7);
        $config->delete();
        $config = Config::findOne(8);
        $config->delete();
        $config = Config::findOne(9);
        $config->delete();
        $config = Config::findOne(10);
        $config->delete();

    }

}
