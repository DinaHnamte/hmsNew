<?php

namespace common\widgets\regusers;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class RegUserUpdate extends Widget
{
    public $model;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('employee-update', [
            'model' => $this->model,
        ]);
    }
}