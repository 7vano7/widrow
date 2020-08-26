<?php

namespace common\components;

use yii\base\BaseObject;
use DateTimeZone;
use DateTime;

class Date extends BaseObject
{
    private $_timeZone;

    public function __construct($config = [])
    {
        $configTimeZone = \Yii::$app->timeZone;

        if( !empty($configTimeZone) ){
            $this->setTimeZone($configTimeZone);
        }else{
            $this->setTimeZone($this->getDefaultTimeZone());
        }

        parent::__construct($config);
    }

    protected function objectTimeZone(){
        return new DateTimeZone($this->getTimeZone());
    }

    protected function getTimeZone(){
        return $this->_timeZone;
    }

    protected function setTimeZone($timeZone):void {
        $this->_timeZone = $timeZone;
    }

    protected function getDefaultTimeZone():string {
        return 'Europe/Moscow';
    }

    public function date($format = 'Y-m-d H:i:s'):string {
        return (new DateTime('now', $this->objectTimeZone()))->format($format);
    }

    public function now($format = 'Y-m-d H:i:s'):string {
        return $this->date($format);
    }
}
