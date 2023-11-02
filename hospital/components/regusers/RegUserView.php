<?php

namespace hospital\components\widgets\regusers;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class RegUserView extends Widget
{
    public $model;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('view', [
            'model' => $this->model,
        ]);
    }
}