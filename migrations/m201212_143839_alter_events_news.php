<?php

use yii\db\Migration;

/**
 * Class m201212_143839_alter_events_news
 */
class m201212_143839_alter_events_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('event');
        $this->delete('news');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201212_143839_alter_events_news cannot be reverted.\n";

        return false;
    }
    */
}
