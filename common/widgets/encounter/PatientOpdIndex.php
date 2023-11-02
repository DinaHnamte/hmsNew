<?php

namespace common\widgets\encounter;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class PatientOpdIndex extends Widget
{
    public $dataProvider;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('patientOpdIndex', [
            'dataProvider' => $this->dataProvider,
        ]);
    }
}