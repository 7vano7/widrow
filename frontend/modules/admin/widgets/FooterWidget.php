<?php
namespace frontend\modules\admin\widgets;

use yii\base\Widget;

class FooterWidget extends Widget
{
    public $user;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('@frontend/modules/admin/views/widgets/views/footer/view', [
            'user' => $this->user
        ]);
    }
}