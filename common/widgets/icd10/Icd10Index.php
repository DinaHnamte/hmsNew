<?php

namespace common\widgets\Idc10;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class Icd10Index extends Widget
{
    public $dataProvider;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('index', [
            'dataProvider' => $this->dataProvider,
        ]);
    }
}