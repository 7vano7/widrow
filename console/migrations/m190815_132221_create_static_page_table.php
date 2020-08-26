<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%static_page}}`.
 */
class m190815_132221_create_static_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%static_page}}', [
            'id' => $this->primaryKey(),
            'url'=>$this->string()->null()->defaultValue(null),
            'status'=>$this->string()->null()->defaultValue(null),
        ]);
        $this->createTable('{{%static_page_translation}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->null()->defaultValue(null),
            'content'=>$this->text()->null()->defaultValue(null),
            'lang'=>$this->string()->null()->defaultValue(null),
            'static_page_id'=>$this->integer()->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%static_page}}');
        $this->dropTable('{{%static_page_translation}}');
    }
}
