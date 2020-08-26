<?php
namespace frontend\modules\admin\widgets;

use yii\base\Widget;

class HeaderWidget extends Widget
{
    public $user;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('@frontend/modules/admin/views/widgets/views/header/view', [
            'user' => $this->user
        ]);
    }
}