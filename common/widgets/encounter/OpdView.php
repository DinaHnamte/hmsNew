<?php

namespace common\widgets\encounter;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class OpdView extends Widget
{
    public $model;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('OpdView', [
            'model' => $this->model,
        ]);
    }
}