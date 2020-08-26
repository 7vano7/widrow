<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
//    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php'
//    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
<<<<<<< HEAD
        '@npm' => '@vendor/npm-asset',
=======
        '@npm'   => '@vendor/npm-asset',
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
<<<<<<< HEAD
        ],
=======
          ],
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
<<<<<<< HEAD
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=150356',
            'username' => '150356',
            'password' => 'cnfhjcnf2007',
            'charset' => 'utf8mb4',
        ],
=======
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'params' => $params,
];


