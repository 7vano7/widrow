<?php

use yii\db\Migration;

/**
 * Class m190814_203448_add_position_field_to_menu
 */
class m190814_203448_add_position_field_to_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('menu', 'position', $this->integer()->null()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('menu', 'position');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190814_203448_add_position_field_to_menu cannot be reverted.\n";

        return false;
    }
    */
}
