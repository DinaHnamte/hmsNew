<?php

namespace common\widgets\employee;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class EmployeeView extends Widget
{
    public $model;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('employee-view', [
            'model' => $this->model,
        ]);
    }
}