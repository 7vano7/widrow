<?php

use yii\db\Migration;

/**
 * Class m190828_144135_add_image_field_to_menu
 */
class m190828_144135_add_image_field_to_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('menu', 'image', $this->string()->null()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('menu', 'image');
    }
}
