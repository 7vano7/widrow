<?php

namespace common\components;

use yii\rbac\DbManager;
use yii\db\Expression;
use yii\db\Query;

class AuthManager extends DbManager
{
    public function getParents($name):array
    {
        $query = (new Query())
            ->select(['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'])
            ->from([$this->itemTable, $this->itemChildTable])
            ->where(['child' => $name, 'name' => new Expression('[[parent]]')]);

        $parent = [];
        foreach ($query->all($this->db) as $row) {
            $parent[$row['name']] = $this->populateItem($row);
        }

        return $parent;
    }
}