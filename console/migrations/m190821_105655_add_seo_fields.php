<?php

use yii\db\Migration;

/**
 * Class m190821_105655_add_seo_fields
 */
class m190821_105655_add_seo_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('menu_lang', 'seo_title', $this->string()->null()->defaultValue(null));
        $this->addColumn('menu_lang', 'seo_description', $this->text()->null()->defaultValue(null));
        $this->addColumn('menu_lang', 'seo_keywords', $this->text()->null()->defaultValue(null));

        $this->addColumn('static_page_translation', 'seo_title', $this->string()->null()->defaultValue(null));
        $this->addColumn('static_page_translation', 'seo_description', $this->text()->null()->defaultValue(null));
        $this->addColumn('static_page_translation', 'seo_keywords', $this->text()->null()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('menu_lang', 'seo_title');
       $this->dropColumn('menu_lang', 'seo_description');
       $this->dropColumn('menu_lang', 'seo_keywords');
       $this->dropColumn('static_page_translation', 'seo_title');
       $this->dropColumn('static_page_translation', 'seo_description');
       $this->dropColumn('static_page_translation', 'seo_keywords');
    }
}
