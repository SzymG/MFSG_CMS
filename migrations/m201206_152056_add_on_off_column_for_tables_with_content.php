<?php

use yii\db\Migration;

/**
 * Class m201206_152056_add_on_off_column_for_tables_with_content
 */
class m201206_152056_add_on_off_column_for_tables_with_content extends Migration
{

    public function safeUp() {
        $this->addColumn('event', 'is_active', $this->tinyInteger(1)->notNull());
        $this->addColumn('page', 'is_active', $this->tinyInteger(1)->notNull());
        $this->addColumn('news', 'is_active', $this->tinyInteger(1)->notNull());
    }

    public function safeDown() {
        $this->dropColumn('event', 'is_active');
        $this->dropColumn('page', 'is_active');
        $this->dropColumn('news', 'is_active');
    }
}
