<?php

use yii\db\Migration;

/**
 * Class m180912_071359_add_google_auth_column_to_user
 */
class m180912_071359_add_google_auth_column_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','google_auth',$this->string(255)->null()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'google_auth');
    }
}
