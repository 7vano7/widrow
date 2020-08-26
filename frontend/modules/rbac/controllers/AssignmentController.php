<?php

namespace frontend\modules\rbac\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use frontend\modules\rbac\models\AssignmentModel;
use frontend\modules\rbac\models\search\AssignmentSearch;
    use frontend\modules\admin\models\User;
use yii\rbac\DbManager;


/**
 * Class AssignmentController
 *
 * @package yii2mod\rbac\controllers
 */
class AssignmentController extends Controller
{
    /**
     * @var \yii\web\IdentityInterface the class name of the [[identity]] object
     */
    public $userIdentityClass;

    /**
     * @var string search class name for assignments search
     */
    public $searchClass = [
        'class' => AssignmentSearch::class,
    ];

    /**
     * @var string id column name
     */
    public $idField = 'id';

    /**
     * @var string username column name
     */
    public $usernameField = 'username';

    /**
     * @var array assignments GridView columns
     */
    public $gridViewColumns = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->userIdentityClass === null) {
            $this->userIdentityClass = Yii::$app->user->identityClass;
        }

        if (empty($this->gridViewColumns)) {
            $this->gridViewColumns = [
                $this->idField,
                $this->usernameField,
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'assign' => ['post'],
                    'remove' => ['post'],
                ],
            ],
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['assign', 'remove'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    /**
     * List of all assignments
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('access.assignment.listview')) {
            throw new ForbiddenHttpException(Yii::t("access rules", "You haven't access to view this page"));
        }
        /* @var AssignmentSearch */
        $searchModel = Yii::createObject($this->searchClass);

        if ($searchModel instanceof AssignmentSearch) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $this->userIdentityClass, $this->idField, $this->usernameField);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'gridViewColumns' => $this->gridViewColumns,
        ]);
    }

    /**
     * Displays a single Assignment model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView(int $id)
    {
       if (!Yii::$app->user->can('access.assignment.view')) {
           throw new ForbiddenHttpException(Yii::t("access rules", "You haven't access to view this page"));
       }
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'usernameField' => $this->usernameField,
        ]);
    }

    /**
     * Assign items
     *
     * @param int $id
     *
     * @return array
     */
    public function actionAssign(int $id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $assignmentModel = $this->findModel($id);
//        $assignmentModel->assign($items);
        $user = User::findOne($id);

//        print_r($user);die;
//        foreach($items as $item)
//        {
//            if(in_array($item, $user->Role()))
//            {
//                if($user->role == $user::ROLE_ADVERTISER && $item != $user::ROLE_PUBLISHER && $item != $user::ROLE_ADVERTISER)
//                {
//                    $user->role = $item;
//                    $user->save();
//                }
//                elseif($user->role == $user::ROLE_PUBLISHER && $item != $user::ROLE_PUBLISHER)
//                {
//                    $user->role = $item;
//                    $user->save();
//                }
//            }
////            print_r($item);die;
//        }
        return $assignmentModel->getItems();
    }

    /**
     * Remove items
     *
     * @param int $id
     *
     * @return array
     */
    public function actionRemove(int $id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $assignmentModel = $this->findModel($id);
//        $assignmentModel->revoke($items, $id);
//        foreach($items as $item)
//        {
//            $user = User::findOne($id);
//            if(in_array($item, $user->Role()))
//            {
//
//                if($user->role == $user::ROLE_ADMIN && $item == $user::ROLE_ADMIN)
//                {
//
//                    $manager = new DbManager();
//                    $roles = $manager->getAssignments($id);
//                    if(array_key_exists($user::ROLE_ADVERTISER, $roles))
//                    {
//                        $user->role = $user::ROLE_ADVERTISER;
//                    }
//                    else
//                    {
//                        $user->role = $user::ROLE_PUBLISHER;
//                    }
//                    if(!$user->save())
//                    {}
//                }
//                elseif($user->role == $user::ROLE_ADVERTISER && $item == $user::ROLE_ADVERTISER)
//                {
//                    $user->role = $user::ROLE_PUBLISHER;
//                    $user->save();
//                }
////                elseif($user->role == $user::ROLE_ADVERTISER && $item == $user::ROLE_ADVERTISER)
//            }
////            print_r($item);die;
//        }
        return $assignmentModel->getItems();
    }

    /**
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return AssignmentModel the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        $class = $this->userIdentityClass;

        if (($user = $class::findIdentity($id)) !== null) {
            return new AssignmentModel($user);
        }

        throw new NotFoundHttpException(Yii::t('rbac', 'The requested page does not exist.'));
    }
}
