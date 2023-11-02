<?php

namespace common\widgets\regusers;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class RegUserIndex extends Widget
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