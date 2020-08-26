<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m190817_151600_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'category'=>$this->integer()->null()->defaultValue(null),
            'status'=>$this->string(50)->null()->defaultValue(null),
            'top'=>$this->integer()->null()->defaultValue(null),
            'image'=>$this->string()->null()->defaultValue(null),
            'gif'=>$this->string()->null()->defaultValue(null),
            'url'=>$this->string()->null()->defaultValue(null),
            'user_id'=>$this->integer()->null()->defaultValue(null),
            'created_at' => $this->dateTime()->null(),
            'updated_at' => $this->dateTime()->null(),
        ]);
        $this->createTable('{{%article_translation}}', [
            'id' => $this->primaryKey(),
            'article_id'=>$this->integer()->null()->defaultValue(null),
            'title'=>$this->string()->null()->defaultValue(null),
            'short_desc'=>$this->text()->null()->defaultValue(null),
            'content'=>$this->text()->null()->defaultValue(null),
            'lang'=>$this->string()->null()->defaultValue(null),
            'seo_title'=>$this->string()->null()->defaultValue(null),
            'seo_description'=>$this->text()->null()->defaultValue(null),
            'seo_keywords'=>$this->text()->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%article_translation}}');
    }
}
