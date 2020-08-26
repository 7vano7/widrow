<?php

namespace frontend\components;

use yii\i18n\Formatter;

class FrontendFormatter extends Formatter
{
    public function load($formatClass)
    {
        return new $formatClass;
    }
}