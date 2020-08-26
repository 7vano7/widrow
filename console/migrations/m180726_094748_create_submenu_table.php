<?php

use yii\db\Migration;

/**
 * Handles the creation of table `submenu`.
 */
class m180726_094748_create_submenu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('submenu', [
            'id' => $this->primaryKey(),
            'status'=>$this->string(255)->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('submenu');
    }
}
