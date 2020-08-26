<?php

use yii\db\Migration;
use frontend\modules\admin\models\Language;

/**
 * Class m180910_074346_add_main_column_to_language
 */
class m180910_074346_add_main_column_to_language extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('language','main',$this->string(255)->null()->defaultValue((new Language())::STATUS_DISABLE));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('language','main');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180910_074346_add_main_column_to_language cannot be reverted.\n";

        return false;
    }
    */
}
