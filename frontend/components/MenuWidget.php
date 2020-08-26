<?php

namespace frontend\components;

use yii\base\Widget;
use frontend\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class MenuWidget extends Widget
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
        if ($menu) {
            return $menu;
        }
        $list = Menu::find()->asArray()->with('menuLang')->where(['status' => Menu::STATUS_ACTIVE, 'is_menu'=>Menu::MENU_TRUE])->all();
        if ($list) {
            $menu = [];
            foreach ($list as $item) {
                foreach ($item['menuLang'] as $langs) {
                    if ($langs['lang'] == Yii::$app->language) {
                        if ($langs['submenu_id']) {
                            $menu = $this->getMenu($langs, $list, $menu, $item['url']);
                        } else {
                            $menu[$langs['menu_id']] = ['label' => $langs['menu_name'], 'url' => [Url::to($item['url'] ? $item['url'] : '#')]];
                        }
                    }
                }
            }
        }
        if ($menu) {

            $this->template = $this->render('menu/menu.php', ['menu' => $menu]);
            // Yii::$app->cache->set('menu', $template, 1800);
        }
        ob_get_clean();
        return $this->template;
    }

    public function getMenu($data, $list, $menu, $url)
    {
        if (isset($menu[$data['submenu_id']])) {
            $menu[$data['submenu_id']]['items'][] = [
                'label' => $data['menu_name'],
                'url' => [Url::to($url ? $url : '#')],
            ];
        } else {
            foreach ($list as $value) {
                if ($value['id'] == $data['submenu_id']) {
                    $menu[$data['submenu_id']] = [
                        'label' => $data['menu_name'],
                        // 'url'=>['#'],
                        'items' => [
                            'label' => $data['menu_name'],
                            'url' => [Url::to($url ? $url : '#')],
                        ],
                    ];
                }
            }
        }
        return $menu;
    }
}
