<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m180726_094444_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'url'=>$this->string()->null()->defaultValue(null),
            'status'=>$this->string(255)->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('menu');
    }
}
