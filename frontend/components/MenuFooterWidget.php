<?php
namespace frontend\components;

use yii\base\Widget;
use frontend\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class MenuFooterWidget extends Widget
{
    public $template;
    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $menu = Yii::$app->cache->get('menu');
        if($menu)
        {
            return $menu;
        }
        $list = Menu::find()->asArray()->with('menuLang')->where(['status'=>Menu::STATUS_ACTIVE])->all();
        if($list)
        {
            $menu = [];
            foreach($list as $item)
            {
                foreach ($item['menuLang'] as $langs)
                {
                    if($langs['lang'] == Yii::$app->language)
                    {
                        if($langs['submenu_id'])
                        {
                            $menu[$langs['submenu_id']] = $this->getMenu($langs['submenu_id'], $list);
                            $menu[$langs['menu_id']] = ['label' => $langs['menu_name'], 'url'=>[Url::to($item['url'] ? $item['url'] : '#')]];
                        }
                        else
                        {
                            if(!isset($menu[$langs['menu_id']]))
                                $menu[$langs['menu_id']] = ['label' => $langs['menu_name'], 'url'=>[Url::to($item['url'] ? $item['url'] : '#')]];
                        }
                    }
                }
            }
        }
        if($menu)
        {
            $this->template = $this->render('menu/menu_footer.php', ['menu'=>$menu]);
        }
        ob_get_clean();
        return $this->template;

    }

    public function getMenu($data, $list)
    {
       $menu = [];
            foreach ($list as $value) {
                if ($value['id'] == $data) {
                    foreach ($value['menuLang'] as $key)
                    {
                        if($key['lang'] == Yii::$app->language )
                            $menu = ['label' => $key['menu_name']];
                    }
                }
            }
        return $menu;
    }
}
