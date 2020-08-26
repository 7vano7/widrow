<?php

use yii\db\Migration;

/**
 * Class m190829_194828_add
 */
class m190829_194828_add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('static_page', 'position', $this->integer()->null()->defaultValue(null));
        $this->addColumn('static_page', 'file', $this->text()->null()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('static_page', 'position');
        $this->dropColumn('static_page', 'file');
    }
}
