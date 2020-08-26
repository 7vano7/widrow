<?php

namespace frontend\modules\rbac\controllers;

use yii\rbac\Item;
use frontend\modules\rbac\base\ItemController;

/**
 * Class PermissionController
 *
 * @package yii2mod\rbac\controllers
 */
class PermissionController extends ItemController
{
    /**
     * @var int
     */
    protected $type = Item::TYPE_PERMISSION;

    /**
     * @var array
     */
    protected $labels = [
        'Item' => 'Permission',
        'Items' => 'Permissions',
    ];
}
