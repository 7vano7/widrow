<?php
namespace frontend\widgets;

use yii\base\Widget;

class LeftWidget extends Widget
{
    public $user;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('@frontend/views/widgets/views/left/view');
    }
}