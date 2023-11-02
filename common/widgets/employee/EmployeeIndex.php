<?php

namespace common\widgets\employee;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class EmployeeIndex extends Widget
{
    public $dataProvider;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('employee-index', [
            'dataProvider' => $this->dataProvider,
        ]);
    }
}