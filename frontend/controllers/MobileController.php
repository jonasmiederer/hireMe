<?php

namespace frontend\controllers;

use frontend\models\Job;
use frontend\models\Event;
use yii\helpers\BaseJson;

class MobileController extends \yii\web\Controller
{
    public function actionGetJobs($event_id = false)
    {
        if ($event_id != false) {
        
        $jobs = Job::find()
        ->where(['event_id' => $event_id])
        ->orderBy('id')
        ->all();
        return BaseJson::encode($jobs);

        }
        else {
    	 $jobs = Job::find()
        ->orderBy('id')
        ->all();
        return BaseJson::encode($jobs);
        }
    }

    public function actionGetEvents() {

    	$events = Event::find()
    	->orderBy('id')
    	->all();
        return BaseJson::encode($events);

    }

    public function actionCreateEvent($thisevent) {

    		$event = BaseJson::encode($thisevent);
    	$ev = new Event();
    	$ev->title = $event['title'];
    	$ev->description = $event['description'];
    	$ev->begin = $event['begin'];
    	$ev->end = $event['end'];
    	$ev->save();

    }

}
