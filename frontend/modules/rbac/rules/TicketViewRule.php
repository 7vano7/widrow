<?php

namespace frontend\modules\rbac\rules;

use Yii;

class TicketViewRule extends BaseRule
{
    /**
     * @inheritdoc
     */
    public $name = 'rule.ticket.view';

    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     *
     * @return mixed
     */
    public function execute($user, $item, $params)
    {
        if( Yii::$app->user->can('ticket.control') ){
            return true;
        }

        return isset($params['ticket']) ? $params['ticket']->user_id === $user : false;
    }
}
