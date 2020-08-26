<?php

use yii\db\Migration;

/**
 * Class m180726_095052_create_menu_lang
 */
class m180726_095052_create_menu_lang extends Migration
{
    public function safeUp()
    {
        $this->createTable('menu_lang', [
            'id' => $this->primaryKey(),
            'menu_name'=>$this->string(255)->null()->defaultValue(null),
            'lang'=>$this->string(255)->null()->defaultValue(null),
            'menu_id'=>$this->integer(10)->null()->defaultValue(null),
            'submenu_id'=>$this->integer(10)->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('menu_lang');
    }
}
