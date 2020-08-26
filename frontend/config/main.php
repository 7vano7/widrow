<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
//    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php'
//    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language'=>'uk',
    'timeZone' => 'Europe/Kiev',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'aliases' => [
        '@admin_lte' => '@frontend/modules/admin/themes/lte',
        '@admin_lte_bower' => '@frontend/modules/admin/themes/lte/bower_components',
        '@admin_lte_plugins' => '@frontend/modules/admin/themes/lte/plugins',
    ],
    'components' => [
        'request' => [
            'baseUrl'=>'',
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey'=>'rfrfsafhyyumvbxbrshgydhtg',
            'class' => 'frontend\components\LanguageRequest'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => frontend\components\FrontendFormatter::class,
            'defaultTimeZone' => 'Europe/Kiev',
            'timeZone' => 'Europe/Kiev',
        ],
        'i18n' => [
            'translations' => [
                'site'=>[
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@frontend/messages',
//                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
                'head'=>[
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@frontend/messages',
//                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
                '*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@frontend/messages',
                    //'sourceLanguage' => 'ru',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                // 'google' => [
                //     'class' => 'yii\authclient\clients\Google',
                //     'clientId' => 'google_client_id',
                //     'clientSecret' => 'google_client_secret',
                // ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
//                    'clientId' => '607897912974633',
//                    'clientSecret' => '0c8227586a957b757d879b49477e8fe5',
                ],
//                'vkontakte' => [
//                    'class' => 'yii\authclient\clients\VKontakte',
//                    'clientId' => '6136565',
//                    'clientSecret' => 'tXYreOqyU4Mw58ruHReD',
//                ],
                // 'twitter' => [
                //     'class' => 'yii\authclient\clients\Twitter',
                //     'clientId' => '832486368341225473',
                //     'clientSecret' => 'Qq2aWR7vWeWQV0R1qrGOcG9ZG',
                // ],
                'twitter' => [
                    'class' => 'yii\authclient\clients\Twitter',
                    'attributeParams' => [
                        'include_email' => 'true'
                    ],
//                    'consumerKey' => 'Qq2aWR7vWeWQV0R1qrGOcG9ZG',
//                    'consumerSecret' => 'JUyAyA5YHxTzFlDOx2t0EJk2NXA6CuygE0Kn7PiU1Mcq3Llu33',
                ],
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class'=>'frontend\components\LanguageUrlManager',
            'rules' => [
                'category/addarticles'=>'/category/addarticles',
                'category/listarticles'=>'/category/listarticles',
                'category/<alias>'=>'/category/index',
                'article/<alias>'=>'article/view',
                'static/<alias>'=>'site/static',
                'search'=>'article/search',
                'login'=>'site/login',
                'signup'=>'site/signup',
                'search/<id>'=>'article/search',
            ],
        ],

    ],
    'modules' => [
        'admin' => [
            'class' => frontend\modules\admin\Module::class,
            'layout'=>'@frontend/modules/admin/views/layouts/main.php',
            'defaultRoute'=>'user',
//            'view' => [
//                'theme' => [
//                    'basePath' => '@frontend/modules/admin/themes/lte',
//                    'baseUrl' => '@web/modules/admin/themes/lte',
//                    'pathMap' => [
//                        '@app/views' => '@frontend/modules/admin/themes/lte/views',
//                        '@app/widgets' => '@frontend/modules/admin/themes/lte/views/widgets',
//                    ],
//                ],
//            ],
        ],
        'rbac' => [
            'class' => frontend\modules\rbac\Module::class,
            'layout'=>'@frontend/modules/admin/views/layouts/main.php',
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'],
            'roots' => [
                [
                    'path' => 'images/global',
                    'name' => 'Server'
                    ],
                [
                    'class' => 'mihaildev\elfinder\volume\UserPath',
                    'path'  => 'images/global/files_{id}',
                    'name'  => 'My Computer'
                ],
            ],
        ]
    ],
    'params' => $params,
];
