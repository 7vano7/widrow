<?php

use yii\db\Migration;

/**
 * Class m180726_095722_create_lang
 */
class m180726_095722_create_lang extends Migration
{
    public function safeUp()
    {
        $this->createTable('language', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255)->null()->defaultValue(null),
            'iso_code'=>$this->string(255)->null()->defaultValue(null),
            'status'=>$this->string(255)->null()->defaultValue(null),
        ]);

        foreach($this->languages() as $lang) {
            $this->insert('{{%language}}', [
                'name' => $lang['name'],
                'iso_code' => $lang['iso_code'],
                'status' => $lang['status'],
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('language');
    }

    public function languages()
    {
        return [
            ['name'=>'Ukraine', 'iso_code'=>'uk', 'status'=>'active'],
            ['name'=>'English', 'iso_code'=>'en', 'status'=>'disable'],
        ];
    }
}
