<?php

namespace frontend\commands;

use frontend\models\CalendarLang;
use yii\base\Exception;
use yii\console\Controller;
use Yii;
use frontend\models\Calendar;
use frontend\models\EventsDay;

class EventCommand extends Controller
{
    /*
     * Get dayly events
     */
    public function setEvents()
    {
        try {
            EventsDay::deleteAll();
            $date = strftime('%Y-%m-%d');
            $models = Calendar::find()->with('calendarLang')->where(['<=', 'date_begin', $date])->andWhere(['>=', 'date_end', $date])->all();
            if ($models) {
                foreach ($models as $model) {
                    if ($model->calendarLang) {
                        foreach ($model->calendarLang as $calendar) {
                            $event = new EventsDay();
                            $event->lang = $calendar->lang;
                            $event->photo = $model->photo;
                            $event->status = $model->status;
                            $event->url = $model->url;
                            $event->title = $calendar->title;
                            if (!$event->save())
                                throw new Exception($event->getFirstErrors());
                        }
                    }
                }
            }
        } catch (Exception $e) {
            file_put_contents('error.log', $e->getMessage());
        }
    }

    /*
     * Get yearly eevents
     */
    public function doubleEvents()
    {
        $date = strftime('%Y-%m-%d');
        $models = Calendar::find()->with('calendarLang')->where(['type' => 0])->andWhere(['<=', 'date_wnd', $date])->all();
        if(!$models)
            return true;
        foreach ($models as $model)
        {
            $event = new Calendar();
            $event->attributes = $model->attributes;
            CalendarLang::deleteAll(['calendar_id'=>$model->id]);
            Calendar::find($model->id)->delete();
        }
    }
}