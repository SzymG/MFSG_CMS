<?php

use yii\db\Migration;

/**
 * Class m201218_145056_alter_config_table
 */
class m201218_145056_alter_config_table extends Migration
{
    public function safeUp()
    {
        $this->delete('config', ['config_name' => 'smtp_class']);
        $this->delete('config', ['config_name' => 'smtp_encryption']);

        $this->execute('INSERT INTO `config` (`config_name`, `config_value`) VALUES
            (\'smtp_is_ssl\', \'\'),
            (\'smtp_address_from\', \'\'),
            (\'smtp_address_from_name\', \'\'),
            (\'smtp_noreply\', \'\');
            ');

    }

    public function safeDown()
    {
        $this->execute('INSERT INTO `config` (`config_name`, `config_value`) VALUES
            (\'smtp_class\', \'\'),
            (\'smtp_encryption\', \'\');
            ');

        $this->delete('config', ['config_name' => 'smtp_is_ssl']);
        $this->delete('config', ['config_name' => 'smtp_address_from']);
        $this->delete('config', ['config_name' => 'smtp_address_from_name']);
        $this->delete('config', ['config_name' => 'smtp_noreply']);
    }
}
