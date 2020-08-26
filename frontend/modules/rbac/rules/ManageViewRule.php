<?php

namespace frontend\modules\rbac\rules;

use Yii;
use common\models\User;

class ManageViewRule extends BaseRule
{
    /**
     * @inheritdoc
     */
    public $name = 'rule.manage.view';


    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     *
     * @return mixed
     */
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->role == User::ROLE_ADMIN || Yii::$app->user->identity->role == User::ROLE_MANAGER)
            {
                return true;
            }
            //print_r($params);die;
            if($params['manage']['user_id'] == Yii::$app->user->id)
            {
                return true;
            }
        }
        return false;
    }
}
