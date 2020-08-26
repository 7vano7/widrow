<?php

use yii\db\Migration;

/**
 * Class m190120_132812_add_social_to_user
 */
class m190120_132812_add_social_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'social_id', $this->string(255)->null()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'social_id');
    }
}
