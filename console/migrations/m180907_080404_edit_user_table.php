<?php

use yii\db\Migration;

/**
 * Class m180907_080404_edit_user_table
 */
class m180907_080404_edit_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user','created_at',$this->dateTime()->null()->defaultValue(null));
        $this->alterColumn('user','updated_at',$this->dateTime()->null()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user','created_at',$this->integer(11)->null()->defaultValue(null));
        $this->alterColumn('user','updated_at',$this->integer(11)->null()->defaultValue(null));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180907_080404_edit_user_table cannot be reverted.\n";

        return false;
    }
    */
}
