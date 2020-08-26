<?php
namespace frontend\controllers;

use common\models\Language;
use yii\web\Controller;
use yii\helpers\Html;
use Yii;
Class HeadController extends Controller
{

    public function getUserLanguage() {
        if (!Yii::$app->session->has('lang')) {
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            if ($lang == 'us' || $lang == 'en') {
                $lang = 'ru';
            } elseif ($lang == 'uk') {
                $lang = 'ua';
            }
            Yii::$app->session->set('lang', $lang);
            $url = Yii::$app->request->url;
            if($lang && $lang != Language::getDefaultLang()->iso_code) {
                return $this->redirect('/'.$lang.$url);
            }
        }
    }
    /*
     * Get MetaTags
     */
    public function setMetaData($title, $description, $content)
    {
        if ($title) {
            $this->view->title = $title;
        } else {
            $this->view->title = $_SERVER['SERVER_NAME'];
        }
        if ($content != "") {
            $content = strip_tags($content);
        }
        if ($description != "") {
            $description = strip_tags($description);
        }
        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $content]);
        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $description]);
    }
}