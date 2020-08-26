<?php

use yii\db\Migration;

/**
 * Class m180904_142528_edit_user_table
 */
class m180904_142528_edit_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('user','role',$this->string(255)->null()->defaultValue(null));
        $this->addColumn('user','active',$this->integer(11)->null()->defaultValue(null));
        $this->addColumn('user','activate_hash',$this->string(255)->null()->defaultValue(null));
        $this->alterColumn('user','status',$this->string(255)->null()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role');
        $this->dropColumn('user', 'active');
        $this->dropColumn('user', 'activate_hash');
        $this->alterColumn('user','status',$this->string(255)->null()->defaultValue(10));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180904_142528_edit_user_table cannot be reverted.\n";

        return false;
    }
    */
}
