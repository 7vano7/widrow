<?php

namespace frontend\modules\admin\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use frontend\modules\admin\models\User;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function checkAccesses()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('delete', Yii::t('site', 'Not authorized'));
            $route = Url::toRoute('/site/login');
            return $this->redirect($route);
        }
        elseif (Yii::$app->user->identity->active === User::ACTIVE_FALSE)
        {
            throw new ForbiddenHttpException(Yii::t('user', 'Not activate'));
        }
        elseif(Yii::$app->user->identity->status === User::STATUS_BLOCKED)
        {
            throw new ForbiddenHttpException(Yii::t('user', 'Status blocked'));
        }
        else
        {
            return true;
        }
        return false;
    }
}
