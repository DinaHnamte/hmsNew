<?php

namespace hospital\components\widgets\encounter;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class OpdIndex extends Widget
{
    public $dataProvider;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('OpdIndex', [
            'dataProvider' => $this->dataProvider,
        ]);
    }
}