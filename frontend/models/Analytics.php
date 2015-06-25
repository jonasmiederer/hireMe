<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class Analytics extends \yii\base\Model
{

    public function getJobs($id) {

        $jobs = Job::find()
        ->where(['company_id' => $id])
        ->orderBy('id')
        ->all();

        return $jobs;

    }

    public static function getUnreadJobs($id) {

        $jobs = Application::find()
        ->where(['company_id' => $id , 'read' => 0])
        ->orderBy('id')
        ->all();

        return count($jobs);


    }

    //Overview
    public function getApplier($id) {

    	 $applications = Application::find()
        ->where(['company_id' => $id, 'sent' => 1,])
        ->orderBy('id')
        ->all();
        return $applications;

    }

    public static function getUnreadApplicationsForJob($id) {

         $applications = Application::find()
        ->where(['company_id' => $id, 'sent' => 1, 'read' => 0])
        ->orderBy('id')
        ->all();
        return count($applications);
    }

    public function getInterviewRate($id) {

        $applier = $this->getApplier($id);

        $inteviewer = Application::find()
        ->where(['company_id' => $id, 'sent' => 1, 'state' => 'Vorstellungsgespräch'])
        ->orderBy('id')
        ->all();
        if (count($applier)==0) $rate = 0;
        else $rate = count($inteviewer)/count($applier)*100; 
        return $rate;
    } 
    public function getInterviewRateForJob($id) {

        $applier = $this->getAppliesForJob($id);

        $inteviewer = Application::find()
        ->where(['job_id' => $id, 'sent' => 1, 'state' => 'Vorstellungsgespräch'])
        ->orderBy('id')
        ->all();
        if (count($applier)==0) $rate = 0;
        else $rate = count($inteviewer)/count($applier)*100; 
        return $rate;

    }

    public function getCompany($id) {

        $company = Company::findOne($id);

        return $company->name;

    }
    //Detail
    public static function getAppliesForJob($id) {

    	 $applications = Application::find()
        ->where(['job_id' => $id, 'sent' => 1,])
        ->orderBy('id')
        ->all();
        Yii::trace("Applier for ".Job::findOne($id)->title.": ".count($applications));
        return $applications;

    }

    public function getAppliesForBtn($id) {

         $applications = Application::find()
        ->where(['btn_id' => $id, 'sent' => 1,])
        ->orderBy('id')
        ->all();

        return $applications;

    }
    //Overview
    public function getHired($id) {

    	 $hired = Application::find()
        ->where(['company_id' => $id , 'state' => 'Versendet'])
        ->orderBy('id')
        ->all();

        return $hired;
    }

    public function getBtnsForJob($id) {

        $btns = ApplyBtn::find()
        ->where(['job_id' => $id])
        ->orderBy('id')
        ->all();
        return $btns;
    }

     public static function getInterestRateForBtn($id) {

        $btn = ApplyBtn::findOne($id);
        if ($btn->clickCount == 0) $rate = 0;
        else $rate =  (count($btn->viewCount)/$btn->clickCount)*10;
        return $rate;

    }

       public static function getApplicationRateForBtn($id) {

        $btn = ApplyBtn::findOne($id);
        $btnApplies = Application::find()
        ->where(['btn_id' => $id, 'sent' => 1,])
        ->orderBy('id')
        ->all();
        if ($btn->clickCount == 0) $rate = 0;
        else $rate =  (count($btnApplies)/$btn->clickCount)*100;
        return $rate;
    }

      public static function getInterviewRateForBtn($id) {
        
        $btn = ApplyBtn::findOne($id);
        $applies = Application::find()
        ->where(['btn_id' => $id, 'sent' => 1])
        ->orderBy('id')
        ->all();

        $interviews = Application::find()
        ->where(['btn_id' => $id, 'sent' => 1, 'state' => 'Vorstellungsgespräch'])
        ->orderBy('id')
        ->all();
        if (count($applies) == 0) { $rate = 0;}
        else $rate =  (count($interviews)/count($applies))*100;
        return $rate;

    }

    //Overview
    public function getAllViewsAndClicks($id) {

    	$jobs = Job::find()
    	->where(['company_id' => $id])
        ->orderBy('id')
        ->all();

        $views = 0;
        $clicks = 0;

        for ($i=0; $i < count($jobs) ; $i++) { 
        	$tmpId = $jobs[$i]->id;

        	$btns = ApplyBtn::find()
		    	->where(['job_id' => $tmpId])
		        ->orderBy('id')
		        ->all();

		        for($x=0;$x<count($btns); $x++) {

		        	$tmpViews = $btns[$x]->viewCount;
		        	$tmpClicks = $btns[$x]->clickCount;
		        	$views+=$tmpViews;
		        	$clicks+=$tmpClicks;
		        }
        }

        $data = [];
        $data[0] = $views;
        $data[1] = $clicks;

        return $data;

    }

    //Detail
    public function getAllViewsAndClicksForJob($id) {

        $views = 0;
        $clicks = 0;

        	$btns = ApplyBtn::find()
		    	->where(['job_id' => $id])
		        ->orderBy('id')
		        ->all();

		        for($x=0;$x<count($btns); $x++) {

		        	$tmpViews = $btns[$x]->viewCount;
		        	$tmpClicks = $btns[$x]->clickCount;
		        	$views+=$tmpViews;
		        	$clicks+=$tmpClicks;
		        }
  

        $data = [];
        $data[0] = $views;
        $data[1] = $clicks;

        return $data;

    }

    
}

?>