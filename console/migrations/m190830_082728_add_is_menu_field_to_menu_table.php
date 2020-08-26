<?php

use yii\db\Migration;

/**
 * Class m190830_082728_add_is_menu_field_to_menu_table
 */
class m190830_082728_add_is_menu_field_to_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('menu', 'is_menu', $this->integer()->null()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('menu', 'is_menu');
    }
}
