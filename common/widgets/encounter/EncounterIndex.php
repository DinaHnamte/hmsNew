<?php

namespace common\widgets\encounter;
//use app\models\Encounter;
use yii\base\Widget;
use yii\helpers\Html;

class EncounterIndex extends Widget
{
    public $dataProvider;

    public function init()
    {           
        parent::init();
        //$this->model = model;
    }

    public function run()
    {
        return $this->render('encounter-index', [
            'dataProvider' => $this->dataProvider,
        ]);
    }
}