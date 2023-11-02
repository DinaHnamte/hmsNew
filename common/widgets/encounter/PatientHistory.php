<?php

namespace common\widgets\encounter;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Encounter;

class PatientHistory extends Widget
{
    public $dataProvider;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
       
        return $this->render('patient-history', [
            'dataProvider' => $this->dataProvider,
        ]);
    }
}