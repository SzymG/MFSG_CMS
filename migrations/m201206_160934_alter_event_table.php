<?php

use yii\db\Migration;

/**
 * Class m201206_160934_alter_event_table
 */
class m201206_160934_alter_event_table extends Migration
{

    public function safeUp()
    {
        $this->dropColumn('event', 'event_author');
        $this->addColumn('event', 'event_date', 'datetime NOT NULL');
    }

    public function safeDown()
    {
        $this->addColumn('event', 'event_author', 'varchar(55) NOT NULL');
        $this->dropColumn('event', 'event_date');
    }
}
