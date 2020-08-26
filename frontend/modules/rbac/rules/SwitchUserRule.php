<?php

namespace frontend\modules\rbac\rules;

use Yii;
use common\models\User;

class SwitchUserRule extends BaseRule
{
    /**
     * @inheritdoc
     */
    public $name = 'rule.user.switch';

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
            //Only admin or manager can switch account

            $base_user_id = Yii::$app->session->get('user.base_user_id');

            $base_user_id = empty($base_user_id) ? $user : $base_user_id;

            $base_user = User::findOne($base_user_id);

            if( $base_user === null ){
                return false;
            }

            $base_user_role = $base_user->getRole();

            return $base_user_role === User::ROLE_ADMIN || $base_user_role === User::ROLE_MANAGER;
        }

        return false;
    }
}
